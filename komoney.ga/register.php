<?php
//sleep(2);
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
}
if(!is_ajax_request()){exit;};
require_once "connection.php";
date_default_timezone_set("Asia/Rangoon");
$username=isset($_POST['username']) ? $_POST['username'] :"";
$email=isset($_POST['email']) ? $_POST['email'] : "";
$password=isset($_POST['password']) ? $_POST['password'] : "";
$repassword=isset($_POST['repassword']) ? $_POST['repassword'] : "";
$usernameerror=[];
$emailerror=[];
$passworderror=[];
$repassworderror=[];
if($username!="" && strlen($username)>1){
    if(preg_match("/^[a-zA-Z0-9\s]+$/",$username)){
        $usernameerror=[];
    }else{
        $usernameerror[]="Special Charactersပါလို့မရပါ!";
    }
}else{
    $usernameerror[]="အနည္းဆံုးစာလံုးေရ2လံုးပါရမည္!";
}

if($email!="" && strlen($email)>4){
    if(preg_match("/^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[com|net|org]+$/",$email)){
        $emailerror=[];
    }else{
        $emailerror[]="Emailမွာ@signႏွင့္.signပါသင့္တယ္!";
    }
}else{
    $emailerror[]="အနည္းဆံုးစာလံုးေရ4လံုးပါရမည္!";
}
if($password!="" && strlen($password)>3){
    // if(preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9]).+$/",$password)){
    //     $passworderror=[];
    // }else{
    //     $passworderror[]="Password must be contains at least a lowercase,uppercase,number and special charcter!";
    // }
    $passworderror=[];
}else{
    $passworderror[]="Passwordအနည္းဆံုးစာလံုးေရ4လံုးပါရမည္!";
}

if($repassword!="" && strlen($repassword)>2){
    if($password==$repassword){
        $repassworderror=[];
    }else{
        $repassworderror[]="အေပၚက Passwordနွင့္မတူညီပါ!";
    }
}else{
    $repassworderror[]="အေပၚက Passwordနွင့္မတူညီပါ!";
}
if($usernameerror==[] && $emailerror==[] && $passworderror==[] && $repassworderror==[]){
    $result=$db->prepare("INSERT INTO users(username,email,password,vac,rac) VALUES(:username,:email,:password,:vac,:rac)");
    $result->execute(array(
        "username"=>$username,
        "email"=>$email,
        "password"=>$password,
        "vac"=>"100000.00",
        "rac"=>"0.00"
    ));
    $result1=$db->prepare("SELECT * FROM users WHERE email=:email AND password=:password");
    $result1->execute(array(
        "email"=>$email,
        "password"=>$password
    ));
    if($result1->rowCount()!=0){
        foreach($result1 as $key=>$value){
            $_SESSION['useridKoMoney']=$value['id'];
            setcookie("useridKoMoney",$value['id'],(time()+3600*24*31*12*10),'/','',0);
            setcookie("usernameKoMoney",$value['username'],(time()+3600*24*31*12*10),'/','',0);
        }
    }
    echo json_encode(array("success"=>1));
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
    /********For insert login activity end ***************/
    /********For insert 2d3d Group start /**********/
                $checkUserr=$db->prepare("select id from users where email='{$email}'");
    $checkUserr->execute();
    $checkUserrFetch=$checkUserr->fetch();
    $checkUserrFetchId=$checkUserrFetch['id'];
                                                            $checkRole=$db->prepare("SELECT count(*) FROM conservation where uid={$checkUserrFetchId} AND tn='2d3dgroup'");
                                $checkRole->execute();
                                if($checkRole->fetchColumn()!=1){
                                  $add2d3dGroup=$db->prepare("INSERT INTO conservation(uid,tn,created_at) VALUES ({$checkUserrFetchId},'2d3dgroup',NOW())");
                                  $add2d3dGroup->execute();
                                }
    /********For insert 2d3d Group start /**********/
    /*********For insert Money Deposit Conservation Start*****/
    $one=1;
$two=$checkUserrFetchId;
$onef1=$one+1;
$onef2=$onef1*$onef1;
$twof1=$two+1;
$twof2=$twof1*$twof1;
$formula=$onef2+$twof2;
    $createTable=$db->prepare("
CREATE TABLE IF NOT EXISTS `{$formula}`(
`id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
`uid` INT(11) NOT NULL,
`text` VARCHAR (255) NOT NULL,
`view` INT(11) NOT NULL,
`created_at` TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP
)
");
    $createTable->execute();
    $db->exec("INSERT INTO conservation(uid,tn,created_at) VALUES ({$two},'{$formula}',NOW())");
    $db->exec("INSERT INTO conservation(uid,tn,created_at) VALUES (1,'{$formula}',NOW())");
    /*********For insert Money Deposit Conservation end*****/

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
