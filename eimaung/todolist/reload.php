<?php
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
}
if(!is_ajax_request()){exit;}
$db=new PDO("mysql:host=localhost;dbname=eimaung","root","");
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$result=$db->prepare("SELECT * FROM todolist");
$result->execute();
$result->setFetchMode(PDO::FETCH_ASSOC);
$array=[];
foreach($result as $item){
  $array[]=[$item['id'],$item['name'],$item['status']];
}
echo json_encode($array);
