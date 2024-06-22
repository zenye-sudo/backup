<?php
//sleep(1);
require_once "../../connection.php";
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
}
if(!is_ajax_request()){exit;}
$array=[];
$testMy=0;
$keywords=isset($_GET['keywords']) ? $_GET['keywords'] : "";
$dataPage=isset($_GET['dataPage']) ? $_GET['dataPage'] : "";
$own=isset($_GET['own']) ? $_GET['own'] : "";
$keywords=preg_replace("/[^\s@.a-zA-Z0-9]/i","",$keywords);
$result=$db->prepare("select * from users where (username LIKE ('%{$keywords}%') OR email LIKE('%{$keywords}%')) and id !={$own}");
$result->execute();
$blank=$result->rowCount();
$blank1="";
if($result->rowCount()>20){
    $totalCount=$result->rowCount();
    $testMy=(int)$dataPage+20;
    if($totalCount>$testMy){
        $result=$db->prepare("select * from users where (username LIKE ('%{$keywords}%') OR email LIKE('%{$keywords}%')) and id !={$own} LIMIT {$dataPage},20 ");
        $result->execute();
    }else{
     $romainingItem=$totalCount-$dataPage;
        $result=$db->prepare("select * from users where (username LIKE ('%{$keywords}%') OR email LIKE('%{$keywords}%')) and id !={$own} LIMIT {$dataPage},{$romainingItem} ");
        $result->execute();
        $blank1="LoadMore";
//        $blank="LoadMoreEnd";
    }

}
if($result->rowCount()!=0){
    foreach ($result->fetchAll() as $item){
        $pp=json_decode($item['pp']);
        //For friend request status start
        $result1=$db->prepare("SELECT * FROM friends WHERE uid1=:uid1 AND uid2=:uid2");
        $result1->execute(array(
            "uid1"=>$_COOKIE['useridKoMoney'],
            "uid2"=>$item['id']
        ));
        $data=$result1->fetch();
        //
        $result2=$db->prepare("SELECT * FROM friends WHERE uid2=:uid1 AND uid1=:uid2");
        $result2->execute(array(
            "uid1"=>$_COOKIE['useridKoMoney'],
            "uid2"=>$item['id']
        ));
        $data2=$result2->fetch();

        $test=-1;
        if($data['friendship_offical']==NULL AND $data2['friendship_offical']==NULL){
            $test=-1;
        }else if($data['friendship_offical']==1 || $data2['friendship_offical']==1){
            $test=1;
        }else if($data2['uid2']==$_COOKIE['useridKoMoney']){
            $test="accepter";
        } else {
            $test=0;
        }
        //For Friend status End
        $array[]=["uid"=>$item['id'],"username"=>$item['username'],"pp"=>$pp,"status"=>$test,"dataPage"=>$testMy,"blank"=>"normal"];
    }
}
if($blank==0){
    $array[]=["blank"=>"noSearchResult"];
}else if($blank1=="LoadMore"){
    $array[]=['blank'=>"loadMoreEnd"];
}
sort($array);
echo json_encode($array);


