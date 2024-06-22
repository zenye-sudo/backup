<?php
sleep(2);
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest";
}
$length=isset($_POST['length']) ?  $_POST['length'] :"";
$width=isset($_POST['width']) ?  $_POST['width'] :"";
$height=isset($_POST['height']) ?  $_POST['height'] :"";
$errors=[];
if($length==""){$errors[]="length";};
if($width==""){$errors[]="width";};
if($height==""){$errors[]="height";};
if(!empty($errors)){
    echo json_encode(array("error"=>$errors));
    exit();
}
$volume=$length*$width*$height;
if(is_ajax_request()){
    echo json_encode(array("volume"=>$volume));
}