<?php
require_once "connection.php";
//For Check Email Start
$checkemail=isset($_GET['checkemail']) ? $_GET['checkemail']  : "";
if(isset($_GET["checkemail"])){
    $result=$db->prepare('SELECT * FROM users WHERE email=:email');
    $result->execute(array(
        'email'=>$_GET['checkemail']
    ));
    if($result->rowCount()!=0){
        echo "Email is already exits";
    }
}
//For check Email End