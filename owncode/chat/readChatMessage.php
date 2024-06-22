<?php
require_once "classess.php";
session_start();
if(isset($_COOKIE['user']) ){
}else{
    header("location:index.php");
}
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest";
}
function message_time_ago($dbData){
    $dbData=strtotime($dbData);
    $nowData=time();
    $dbDataY=date("Y",$dbData);
    $nowDataY=date("Y",$nowData);
    $dbDataM=date("M",$dbData);
    $nowDataM=date("M",$nowData);
    $dbDataD=date("d",$dbData);
    $nowDataD=date("d",$nowData);
    if($dbDataY==$nowDataY && $dbDataM==$nowDataM && $dbDataD==$nowDataD){
        return date("h:i A",$dbData);
    }else if($dbDataY==$nowDataY){
        return date("M d \a\\t h:i A",$dbData);
    }else{
        return date("M d,Y \a\\t h:i A",$dbData);
    }
}
if(!is_ajax_request()){exit;};
$table_name=$_GET['tn'] ? $_GET['tn'] : "";
$retrieveTableDatas=$db->prepare("select * from `{$table_name}`");
$retrieveTableDatas->execute();
$array=[];
foreach($retrieveTableDatas->fetchAll() as $item){
  $retrieveUserDatas=$db->prepare("select * from users where id={$item["uid"]}");
  $retrieveUserDatas->execute();
  $data=$retrieveUserDatas->fetch();
  $pp=json_decode($data['pp']);
  $array[]=["id"=>$item['uid'],"username"=>$data['username'],"pp"=>$pp,"text"=>$item['text'],"created_at"=>message_time_ago($item['created_at'])];
}
echo json_encode($array);
