<?php
if(isset($_COOKIE['user']) ){
}else{
    header("location:index.php");
}
require_once "connection.php";
if(isset($_FILES['file']['name'])){
    $name=$_FILES['file']['name'];
    $new_name=mt_rand(time(),time()).$name;
    move_uploaded_file($_FILES['file']['tmp_name'],"user/pp/".$new_name);
    $new_name_json=json_encode($new_name);
    $result=$db->prepare("update users SET pp='{$new_name_json}' where id={$_COOKIE['userid']}");
    $result->execute();
    echo $new_name;

}else if($_FILES['file1']['name']!=""){
    $name=$_FILES['file1']['name'];
    $new_name=mt_rand(time(),time()).$name;
    move_uploaded_file($_FILES['file1']['tmp_name'],"user/cp/".$new_name);
    $new_name_json=json_encode($new_name);
    $result=$db->prepare("update users SET cp='{$new_name_json}' where id={$_COOKIE['userid']}");
    $result->execute();
    echo $new_name;
}
