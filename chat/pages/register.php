<?php
require_once "classes.php";
$users=new user();
if($_POST['username'] && $_POST['email'] && $_POST['password']){
    $users->setUserName($_POST['username']);
    $users->setUserEmail($_POST['email']);
    $users->setUserPassword($_POST['password']);
    $users->Register();
    header("location:../index.php?success=1");
}