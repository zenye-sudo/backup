<?php
session_start();
require_once "classes.php";
$user=new user();
if($_POST['email'] && $_POST['password']){
    $user->setUserEmail($_POST['email']);
    $user->setUserPassword($_POST['password']);
    $user->Login();
//    echo $user->getUserName();
    if($user->Login()==1){
         $_SESSION['username']=$user->getUserName();
         $_SESSION['id']=$user->getUserId();
    }
}