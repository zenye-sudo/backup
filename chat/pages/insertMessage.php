<?php
session_start();
include "classes.php";
if(isset($_POST['text'])){
    $chat=new chat();
    $chat->setChatUserId($_SESSION['id']);
    $chat->setChatUserText($_POST['text']);
    $chat->InsertChat();
}