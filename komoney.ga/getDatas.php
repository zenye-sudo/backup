<?php
//sleep(1);
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
}
if(!is_ajax_request()){exit;};
require("connection.php");
$date=$_GET['date'] ? $_GET['date'] : "NO";
$result=$db->prepare("select * from 2d where date='{$date}' ");
$result->execute();
$arr=[];
foreach($result->fetchAll() as $items){
        $arr[]=['name'=>$items['name'],'channel'=>$items['channel'],'twod'=>$items['2d'],'type'=>$items['type']];
}
echo json_encode($arr);