<?php
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND $_SERVER['HTTP_X_REQUESTED_WITH'] =="XMLHttpRequest";
}
if(!is_ajax_request()){echo "Con";};
$id=isset($_POST['id']) ? $_POST['id'] : "";
$db=new PDO("mysql:host=localhost;dbname=eimaung","root","");
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$result=$db->prepare("SELECT status FROM todolist WHERE id={$id}");
$result->execute();
$result->setFetchMode(PDO::FETCH_ASSOC);
$result1="";
if($result->fetchColumn()==1){
    $result1=$db->exec("UPDATE todolist SET status=0 WHERE id={$id}");
    echo "done";
}else{
    $result1=$db->exec("UPDATE todolist SET status=1 WHERE id={$id}");
    echo "task";
}