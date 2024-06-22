<?php
$db=new PDO("mysql:host=localhost;dbname=techcoder","root","");
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
if($_GET['value']){
    $result=$db->prepare("select * from users where email=:email");
    $result->execute(array(
        "email"=>$_GET['value']
    ));
    if($result->rowCount()==0){
    }else{
        echo "Email is already Exits.";
    }
}