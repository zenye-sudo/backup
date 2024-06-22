<?php
require_once "connection.php";
date_default_timezone_set("Asia/Rangoon");
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
}
if(!is_ajax_request()){exit;};
$twod1=isset($_POST['twod1']) ? $_POST['twod1'] : "NO";
$twod2=isset($_POST['twod2']) ? $_POST['twod2'] : "NO";
$twod=$twod1.$twod2;
$threed=isset($_POST['threed']) ? $_POST['threed'] : "NO";
$date=isset($_POST['date']) ? $_POST['date'] : "NO";
$dateForThreed=date("Y-m-d",time());
$name=isset($_POST['name']) ? $_POST['name'] : "NO";
$choose=isset($_POST['choose']) ? $_POST['choose'] : "NO";
$channel=isset($_POST['type']) ? $_POST['type'] : "NO";
if($choose==0){
    $check=$db->prepare("select * from 2d where date='{$date}' AND name='{$name}'");
    $check->execute();
    if($check->rowCount()==0){
        $result=$db->prepare("insert into 2d(name,2d,channel,type,date) values('{$name}','{$twod}','{$channel}',0,'{$date}')");
        $result->execute();
        echo $twod;
    }
}else{
    $check=$db->prepare("select * from 2d where date='{$dateForThreed}' AND name='{$name}'");
    $check->execute();
    if($check->rowCount()==0){
        $result=$db->prepare("insert into 2d(name,2d,channel,type,date) values('{$name}','{$threed}','{$channel}',1,'{$dateForThreed}')");
        $result->execute();
        echo $twod;
    }
}
