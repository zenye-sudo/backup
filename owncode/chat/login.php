<?php
session_start();
require_once "connection.php";
//sleep(2);
$emaillogin=isset($_POST['emaillogin']) ? $_POST['emaillogin'] : "";
$passwordlogin=isset($_POST['passwordlogin']) ? $_POST['passwordlogin'] : "";
$emailloginerror=[];
$passwordloginerror=[];
if($emaillogin!="" && strlen($emaillogin)>=3){
    if(preg_match("/^[a-zA-Z0-9]+@[a-zA-Z]+\.[com|net|org]+$/",$emaillogin)){
        $emailloginerror=[];
    }else{
        $emailloginerror[]="Email must be contains @sign and dot character.";
    }
}else{
    $emailloginerror[]="Email is invalid";
}
if($passwordlogin!="" && strlen($passwordlogin)>=3){
    if(preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9]).+$/",$passwordlogin)){
        $passwordloginerror=[];
    }else{
        $passwordloginerror[]="Password must be contains at least a lowercase,uppercase,number,special charcter.";
    }
}else{
    $passwordloginerror[]="Password is invalid";
}
if($emailloginerror==[] && $passwordloginerror==[]) {
    $result=$db->prepare("SELECT * FROM users WHERE email=:email AND password=:password");
    $result->execute(array(
        "email"=>$emaillogin,
        "password"=>$passwordlogin
    ));
    if($result->rowCount()!=0){
        foreach($result as $key=>$value){
            $_SESSION['id']=$value['id'];
            $_SESSION['username']=$value['username'];
            setcookie("userid",$_SESSION['id'],time()+3600,'/','',0);
            setcookie("user",$_SESSION['username'],time()+3600,'/','',0);
        }
        echo json_encode(array("status"=>1));
            $checkExist=$db->prepare("select * from login_details where uid=:uid");
            $checkExist->execute(array(
                "uid"=>$_SESSION['id']
            ));
            if($checkExist->rowCount()==0){
                $login_details=$db->prepare("INSERT INTO login_details(uid) VALUES(:uid)");
                $login_details->execute(array(
                    "uid"=>$_SESSION['id']
                ));
            }
    }else{
        echo json_encode(array("status"=>0));
    }
}else{
    $totalerrors=[
        "email"=>$emailloginerror,
        "password"=>$passwordloginerror
    ];
    echo json_encode($totalerrors);
}