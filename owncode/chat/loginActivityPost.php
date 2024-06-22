<?php
require_once "connection.php";
date_default_timezone_set("Asia/Rangoon");
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest";
}
if(!is_ajax_request()){exit;}
$uid=$_POST['uid']? $_POST['uid'] : "";
if($uid!=""){
$db=new PDO("mysql:host=localhost;dbname=groupChat","root","");
$result=$db->prepare("update login_details set last_activity=:last_activity where uid=:uid");
$result->execute(array(
    "uid"=>$uid,
    "last_activity"=>date("Y-m-d H:i:s",time())
));
}
