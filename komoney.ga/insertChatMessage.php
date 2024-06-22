<?php
//sleep(2);

require_once "classess.php";
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['username']) || isset($_COOKIE['useridKoMoney']) ){
}else{
    header("location:index.php");
}
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest";
}
if(!is_ajax_request()){exit;};
//if(!is_ajax_request()){exit;};
$user=isset($_POST['user']) ? $_POST['user'] : "";
$text=isset($_POST['text']) ? $_POST['text'] : "";
$table=isset($_POST['table']) ? $_POST['table'] : "";
//$imgSend=isset($_POST['imgSend']) ? $_POST['imgSend'] : "asdf";
if($text!=""){
//    $text=preg_replace("/[><]/","",$text);
    $chat=new chat();
    $chat->setUser($user);
    $chat->setText($text);
    $chat->setTable($table);
    $chat->insertMessage();

}else if(isset($_FILES['imgSend']['name'])){
    $imgSend=new chat();
    $imgSend->setTable($table);
    $imgSend->setUser($user);
    echo $_FILES['imgSend']['tmp_name'];
    $imgSend->setImgSend($img_name=$_FILES['imgSend']['name']);
    $imgSend->setTmp($img_tmpName=$_FILES['imgSend']['tmp_name']);
    $imgSend->ImgSend();
}


