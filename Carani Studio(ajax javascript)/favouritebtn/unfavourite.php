<?php
session_start();
if(!isset($_SESSION['favorities'])){$_SESSION['favorities']=[];}

function is_ajax_request(){
    return isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"]=="XMLHttpRequest";
}
function array_remove($num,$array){
$index=array_search($num,$array);
array_splice($array,$index,1);
return $array;
}
if(!is_ajax_request()){exit();}
$raw_id=isset($_POST['id']) ? $_POST['id'] : "Not" ;
if(preg_match("/container(\d+)/",$raw_id,$matches)){
    $num=$matches[1];
    if(in_array($num,$_SESSION['favorities'])){
        $_SESSION['favorities']=array_remove($num,$_SESSION['favorities']);
    }
    echo "True";

}else{
    echo "False";
}
