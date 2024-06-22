<?php
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] =="XMLHttpRequest";
}
if(!is_ajax_request()){exit;}
$name=isset($_POST['name']) ? $_POST['name'] : "";
$db=new PDO("mysql:host=localhost;dbname=eimaung","root","");
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
if($name!=""){
    $result=$db->exec("INSERT INTO todolist(name) VALUES('{$name}')");

}
