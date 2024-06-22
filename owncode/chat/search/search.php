<?php
//sleep(2);
require_once "../connection.php";
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
}
if(!is_ajax_request()){exit;}
$keywords=isset($_GET['keywords']) ? $_GET['keywords'] : "";
$own=isset($_GET['own']) ? $_GET['own'] : "";
$keywords=preg_replace("/[^\s@.a-zA-Z0-9]/i","",$keywords);
$result=$db->prepare("select * from users where (username LIKE ('%{$keywords}%') OR email LIKE('%{$keywords}%')) and id !={$own}");
$result->execute();
$array=[];
foreach ($result->fetchAll() as $item){
    $pp=json_decode($item['pp']);
    //For friend request status start
    $result1=$db->prepare("SELECT * FROM friends WHERE uid1=:uid1 AND uid2=:uid2");
    $result1->execute(array(
        "uid1"=>$_COOKIE['userid'],
        "uid2"=>$item['id']
    ));
    $data=$result1->fetch();
    //
    $result2=$db->prepare("SELECT * FROM friends WHERE uid2=:uid1 AND uid1=:uid2");
    $result2->execute(array(
        "uid1"=>$_COOKIE['userid'],
        "uid2"=>$item['id']
    ));
    $data2=$result2->fetch();

    $test=-1;
    if($data['friendship_offical']==NULL AND $data2['friendship_offical']==NULL){
        $test=-1;
    }else if($data['friendship_offical']==1 || $data2['friendship_offical']==1){
        $test=1;
    }else if($data2['uid2']==$_COOKIE['userid']){
        $test="accepter";
    } else {
        $test=0;
    }
    //For Friend status End
    $array[]=["uid"=>$item['id'],"username"=>$item['username'],"pp"=>$pp,"status"=>$test];
}
sort($array);
echo json_encode($array);