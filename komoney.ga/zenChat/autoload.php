<?php
require_once "classess.php";
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
}
if(!is_ajax_request()){exit;};
$uid2=isset($_GET['uid2']) ? $_GET['uid2'] : "";
$uid=isset($_GET['uid'])  ? $_GET['uid'] : "";
$uidx=isset($_GET['uidx']) ? $_GET['uidx'] : "";
$result=$db->prepare("SELECT * FROM friends WHERE uid2=:uid2 AND friendship_offical='0'");
$result1=$db->prepare("SELECT * FROM friends WHERE (uid2=:uid2 OR uid1=:uid2) AND friendship_offical='1'");
$fc=$db->prepare("select count(*) from friends where (uid2=:uid2 OR uid1=:uid2) and friendship_offical='1'");
$ac=$db->prepare("select count(*) from friends where uid2=:uid2 and friendship_offical='0'");
$activeF=$db->prepare("select users.id,users.username,users.pp from users inner join login_details on login_details.uid=users.id where login_details.last_activity>DATE_SUB(NOW(),INTERVAL 10 SECOND) AND users.id!={$_COOKIE['useridKoMoney']}");

$result->execute(array(
    "uid2"=>$uid2
));
$result1->execute(array(
    "uid2"=>$uid2
));
$fc->execute(array(
    "uid2"=>$uid
));
$ac->execute(array(
    "uid2"=>$uidx
));
$activeF->execute();
$array=[];
$array1=[];
$array2=[];
foreach ($result->fetchAll() as $item){
    $result01=$db->prepare("select * from users where id=:id");
    $acceptCount=$db->prepare("SELECT COUNT(*) FROM friends WHERE uid2=:uid2 AND friendship_offical='0'");
    $result01->execute(array(
        "id"=>$item['uid1']
    ));
    $acceptCount->execute(array(
        "uid2"=>$uid2
    ));
    $data=$result01->fetch();
    $pp=json_decode($data['pp']);
    $array[]=["id1"=>$item['id'],"id"=>$data['id'],"username"=>$data['username'],"pp"=>$pp,"countt"=>$acceptCount->fetchColumn()];
}
foreach ($result1->fetchAll() as $item){
    $result11=$db->prepare("select * from users where (id=:id OR id=:id1)");
    $friendCount=$db->prepare("SELECT COUNT(*) FROM friends WHERE (uid2=:uid2 OR uid1=:uid2) AND friendship_offical='1'");
    $result11->execute(array(
        "id"=>$item['uid1'],
        "id1"=>$item['uid2']
    ));
    $friendCount->execute(array(
        "uid2"=>$uid2
    ));
    foreach($result11->fetchAll() as $data){
        if($data['id']!=$uid2){
            $pp=json_decode($data['pp']);
            $FriendCount=$friendCount->rowCount()+1;
            $array1[]=["id1"=>$item['id'],"id"=>$data['id'],"username"=>$data['username'],"pp"=>$pp,"countt"=>$FriendCount];
        }
    }
}
//For active Friend start
$count=0;
foreach($activeF->fetchAll() as $item){
    $checkFriend=$db->prepare("select * from friends where ((uid1=:one AND uid2=:two) OR (uid1=:two AND uid2=:one)) AND (friendship_offical='1')");
    $checkFriend->execute(array(
        "one"=>$item['id'],
        "two"=>$_COOKIE['useridKoMoney']
    ));
    $pp=json_decode($item['pp']);
    $checkFriend1=$db->prepare("select COUNT(*) from friends where ((uid1=:one AND uid2=:two) OR (uid1=:two AND uid2=:one)) AND (friendship_offical='1')");
    $checkFriend1->execute(array(
        "one"=>$item['id'],
        "two"=>$_COOKIE['useridKoMoney']
    ));
    $count=$count+$checkFriend1->fetchColumn();
    if($checkFriend->rowCount()>0){
        $array2[]=["id"=>$item['id'],"username"=>$item['username'],"pp"=>$pp];
    }
}
//For active friend end
echo json_encode(array("accept"=>$array,"friends"=>$array1,"activeFriend"=>$array2,"friendCount"=>$fc->fetchColumn(),"acceptCount"=>$ac->fetchColumn(),"activeFriendCount"=>$count));

