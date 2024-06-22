<?php
//sleep(2);
require_once "connection.php";
$username=isset($_POST['username']) ? $_POST['username'] :"";
$email=isset($_POST['email']) ? $_POST['email'] : "";
$password=isset($_POST['password']) ? $_POST['password'] : "";
$repassword=isset($_POST['repassword']) ? $_POST['repassword'] : "";
$usernameerror=[];
$emailerror=[];
$passworderror=[];
$repassworderror=[];
if($username!="" && strlen($username)>4){
    if(preg_match("/^[a-zA-Z0-9\s]+$/",$username)){
        $usernameerror=[];
    }else{
        $usernameerror[]="Username must not contains special charcters";
    }
}else{
    $usernameerror[]="Username must be contains at least four characters";
}

if($email!="" && strlen($email)>4){
    if(preg_match("/^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[com|net|org]+$/",$email)){
        $emailerror=[];
    }else{
        $emailerror[]="Email must be contains special charcters @ and .";
    }
}else{
    $emailerror[]="Email must be contains at least four characters";
}
if($password!="" && strlen($password)>4){
    if(preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9]).+$/",$password)){
        $passworderror=[];
    }else{
        $passworderror[]="Password must be contains at least a lowercase,uppercase,number and special charcter!";
    }
}else{
    $passworderror[]="Password must be contains at least four characters";
}

if($repassword!="" && strlen($repassword)>4){
    if($password==$repassword){
        $repassworderror=[];
    }else{
        $repassworderror[]="The two passwords are not match!";
    }
}else{
    $repassworderror[]="The two passwords are not match!";
}
if($usernameerror==[] && $emailerror==[] && $passworderror==[] && $repassworderror==[]){
    $result=$db->prepare("INSERT INTO users(username,email,password) VALUES(:username,:email,:password)");
    $result->execute(array(
        "username"=>$username,
        "email"=>$email,
        "password"=>$password
    ));
    echo json_encode(array("success"=>1));
}else
{
    $totalerrors=[
        "username"=>$usernameerror,
        "email"=>$emailerror,
        "password"=>$passworderror,
        "repassword"=>$repassworderror
    ];
    echo json_encode($totalerrors);
}
