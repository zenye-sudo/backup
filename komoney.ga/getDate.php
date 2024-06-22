<?php
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
}
if(!is_ajax_request()){exit;};
date_default_timezone_set("Asia/Rangoon");
$twelve="".date("Y-m-d")."12:00:00 PM";
$twelvefive="".date("Y-m-d")."12:05:00 PM";
$twelve=strtotime($twelve);
$twelvefive=strtotime($twelvefive);
$fourthree="".date("Y-m-d")."04:30:00 PM";
$fourthreefive="".date("Y-m-d")."4:35:00 PM";
$fourthree=strtotime($fourthree);
$fourthreefive=strtotime($fourthreefive);
$array=[];
$array[]=['nowt'=>time(),'twelve'=>$twelve,'twelvefive'=>$twelvefive,'fourthree'=>$fourthree,'fourthreefive'=>$fourthreefive];
echo json_encode($array);