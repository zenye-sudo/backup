<?php
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
}
if(!is_ajax_request()){
    exit;
}
$array=[];
$uid=isset($_GET['uid']) ? $_GET['uid'] :"";
$db=new PDO("mysql:host=localhost;dbname=techcoder","root","");
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$result=$db->prepare("select * from users where id=".$uid."");
$result->execute();
$result->setFetchMode(PDO::FETCH_ASSOC);
foreach($result->fetchAll() as $item){
    foreach ($item as $key=>$value){
        $array[]=[$key=>$value];
    }
}
echo (json_encode($array));