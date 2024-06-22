<?php
//sleep(2);
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
}
if(!is_ajax_request()){exit;};
session_start();
require_once "connection.php";
date_default_timezone_set("Asia/Rangoon");
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
    $resultFetch=$result->fetch();
    if($result->rowCount()!=0){
        if($emaillogin=="wackyzenye@gmail.com" && $resultFetch['id']==1 ){
            setcookie("KoMoneyEmail",md5($resultFetch['email']),(time()+3600*24*30),'/','',0);
            setcookie("KoMoneyPassword",md5($resultFetch['password']),(time()+3600*24*30),'/','',0);
            echo json_encode(array('special'=>1));
            /********For insert login activity start ***************/
            $checkExist=$db->prepare("select * from login_details where uid=:uid");
            $checkExist->execute(array(
                "uid"=>1
            ));
            if($checkExist->rowCount()==0){
                $login_details=$db->prepare("INSERT INTO login_details(uid,last_activity) VALUES(:uid,:last_activity)");
                $login_details->execute(array(
                    "uid"=>1,
                    "last_activity"=>date("Y-m-d H:i:s A",time())
                ));
            }
            /********For insert login activity end ***************/
        }else{
            $_SESSION['useridKoMoney']=$resultFetch['id'];
            setcookie("useridKoMoney",$resultFetch['id'],(time()+3600*24*31*12*10),'/','',0);
            setcookie("usernameKoMoney",$resultFetch['username'],(time()+3600*24*31*12*10),'/','',0);
            echo json_encode(array("status"=>1,"username"=>$resultFetch['username'],"balance"=>$resultFetch['vac']));

            /********For insert login activity start ***************/
            $checkExist=$db->prepare("select * from login_details where uid=:uid");
            $checkExist->execute(array(
                "uid"=>$_SESSION['useridKoMoney']
            ));
            if($checkExist->rowCount()==0){
                $login_details=$db->prepare("INSERT INTO login_details(uid,last_activity) VALUES(:uid,:last_activity)");
                $login_details->execute(array(
                    "uid"=>$_SESSION['useridKoMoney'],
                    "last_activity"=>date("Y-m-d H:i:s A",time())
                ));
            }
            /********For insert login activity start ***************/
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