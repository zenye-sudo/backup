<?php
session_start();
if(!isset($_SESSION['favorities'])){$_SESSION['favorities']=[];}

function is_ajax_request(){
    return isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"]=="XMLHttpRequest";
}
if(!is_ajax_request()){exit();}
$raw_id=isset($_POST['id']) ? $_POST['id'] : "Not" ;
if(preg_match("/container(\d+)/",$raw_id,$matches)){
    $num=$matches[1];
    if(!in_array($num,$_SESSION['favorities'])){
        $_SESSION['favorities'][]=$num;
    }
    echo "True";

}else{
    echo "False";
}
