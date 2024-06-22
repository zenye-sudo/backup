<?php
//sleep(1);
session_start();
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest";
}
if(!is_ajax_request()){
    exit;
}
//Checking Information Start
$username=isset($_POST['username']) ? $_POST['username'] : "";
$email=isset($_POST['email']) ? $_POST['email'] : "";
$password=isset($_POST['password']) ? $_POST['password'] : "";
$repassword=isset($_POST['repassword']) ? $_POST['repassword'] : "";
$usernameerrors=[];
$emailerrors=[];
$passworderrors=[];
$repassworderrors=[];
$servererrors=[];
if($username!="" && !strlen($username)<4){
    global $username;
    if(preg_match("/^[a-zA-Z0-9]+$/",$username)){
        $usernameerrors=[];
    }else{
        $usernameerrors[]="Username is must not contains special characters";
    }
}else{
    $usernameerrors[]="Username is must be at least 6 characters";
}
if($email!=""){
    if(preg_match("/^\w+\@\w+.[com|net|net]+$/",$email)){
        $emailerrors=[];
    }else{
        $emailerrors[]="Email is Something wrong!";
    }
}else{
    $emailerrors[]="Please enter your email!";
}
if($password!=""){
     if(preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^\w]).+$/",$password)){
      $passworderrors=[];
     }else{
         $passworderrors[]="Password must be at least a special character,Uppercase,Lowercas,number";
     }
}else{
    $passworderrors[]="Please enter your password!";
}
if($repassword!=""){
    if($repassword==$password){
        $repassworderrors=[];
    }else{
        $repassworderrors="Passwords are not match!";
    }
}else{
    $repassworderrors[]="Please reenter your password";
}
//For Alrady Exits Email Start
$db=new PDO("mysql:host=localhost;dbname=techcoder","root","");
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$result=$db->prepare("SELECT * FROM users WHERE email='".$email."'");
$result->execute();
$result->setFetchMode(PDO::FETCH_ASSOC);
if($email!=""){
    if($result->fetchColumn()>0){
        $servererrors[]="Email is already exists";
    }else{
        $servererrors=[];
    }
}
//For Alrady Exits Email End
//Checking Information End


//Showing User INterface Errors Start
    $total=[];
    $total[]=["uerrors"=>$usernameerrors];
    $total[]=["eerrors"=>$emailerrors];
    $total[]=["perrors"=>$passworderrors];
    $total[]=["rerrors"=>$repassworderrors];
    $total[]=["serrors"=>$servererrors];

//Showing User INterface Errors End

//For Adding Datas To databases
if($usernameerrors==[] && $emailerrors==[] && $passworderrors==[] && $repassworderrors==[] && $servererrors==[]){
    $result=$db->exec("INSERT INTO users(name,email,password,created_at) VALUES ('".$username."','".$email."','".$password."',NOW())");
    echo json_encode(array("success"=>$result));
    $_SESSION['username']=$username;
}else{
    echo json_encode($total);
}
//For Adding Datas To databases
