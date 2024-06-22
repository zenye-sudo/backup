<?php
require_once "classess.php";
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
}
if(!is_ajax_request()){exit;};
$uid1a=isset($_POST['uid1a']) ? $_POST['uid1a'] : "";
$uid2a=isset($_POST['uid2a']) ? $_POST['uid2a'] : "";
$uid1c=isset($_POST['uid1c']) ? $_POST['uid1c'] : "";
$uid2c=isset($_POST['uid2c']) ? $_POST['uid2c'] : "";
$acc=isset($_POST['acc']) ? $_POST['acc'] : "";
$del=isset($_POST['del']) ? $_POST['del'] : "";
$unfri=isset($_POST['unfri']) ? $_POST['unfri'] : "";
$uid=isset($_GET['uid']) ? $_GET['uid'] : "";
$uid1acc=isset($_POST['uid1acc']) ? $_POST['uid1acc'] : "";
$uid2acc=isset($_POST['uid2acc']) ? $_POST['uid2acc'] : "";
$uid1del=isset($_POST['uid1del']) ? $_POST['uid1del'] : "";
$uid2del=isset($_POST['uid2del']) ? $_POST['uid2del'] : "";
$uidc=isset($_POST['uidc']) ? $_POST['uidc'] : "";
$tn=isset($_POST['tn']) ? $_POST['tn'] : "";
if($uid1a!="" && $uid2a!=""){
    $addFriend=new AddFriend();
    $addFriend->setUid1($uid1a);
    $addFriend->setUid2($uid2a);
    $addFriend->setFo(0);
    $addFriend->addRequest();
}else if($uid1c!="" && $uid2c!=""){
    $addFriend=new AddFriend();
    $addFriend->setUid1($uid1c);
    $addFriend->setUid2($uid2c);
    $addFriend->cancelRequest();
    $addFriend->cancelRequest1();
}else if($acc!=""){
    $addFriend=new AddFriend();
    $addFriend->setUid1($acc);
    $addFriend->acceptFriend();
}else if($del!=""){
    $addFriend=new AddFriend();
    $addFriend->setUid1($del);
    $addFriend->requestDel();
}else if($unfri!=""){
    $addFriend=new AddFriend();
    $addFriend->setUid1($unfri);
    $addFriend->requestDel();
}else if($uid1acc!="" && $uid2acc!=""){
    $addFriend=new AddFriend();
    $addFriend->setUid1($uid1acc);
    $addFriend->setUid2($uid2acc);
    $addFriend->acceptFriend1();
}else if($uid1del!="" && $uid2del!=""){
    $addFriend=new AddFriend();
    $addFriend->setUid1($uid1del);
    $addFriend->setUid2($uid2del);
    $addFriend->deleteRequest1();
}else if($uidc!="" && $tn!=""){
    $addFriend=new AddFriend();
    $addFriend->setUid1($uidc);
    $addFriend->setUid2($tn);
    $addFriend->conservationDeleter();
}
