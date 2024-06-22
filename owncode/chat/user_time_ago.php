<?php
require_once "connection.php";
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest";
}
if(!is_ajax_request()){exit;};
date_default_timezone_set("Asia/Rangoon");
function user_time_ago($dbData){
    $dbData=strtotime($dbData);
    $now=time();
    $seconds=$now-$dbData;
    $minutes=round($seconds/60);
    $hours=round($seconds/(60*60));
    $days=round($seconds/(60*60*24));
    $weeks=round($seconds/(7*60*60*24));
    $months=round($seconds/(((365+365+365+366)/5/12)*60*60*24));
    $years=round($seconds/(((365+365+365+366)/5)*60*60*24));
    if($seconds<=60){
        return "Just now";
    }else if($minutes<=60){
        if($minutes==1){
            return "one minute ago";
        }else{
            return $minutes." minutes ago";
        }
    }else if($hours<=24){
        if($hours==1){
            return "An hour ago";
        }else{
            return $hours." hours ago";
        }
    }else if($days<=7){
        if($days==1){
            return "Yesterday";
        }else{
            return $days." days ago";
        }
    }else if($weeks<=4.3){
        if($weeks==1){
            return "A week ago";
        }else{
            return $weeks." weeks ago";
        }
    }else if($months<=12){
        if($months==1){
            return "A month ago";
        }else{
            return $months." months ago";
        }
    }else{
        if($years==1){
            return "One year ago";
        }else {
            return $years." years ago";
        }
    }
}
$two=isset($_GET['two']) ? $_GET['two'] : "";

$userAgo=$db->prepare("select * from login_details where uid={$two}");
$userAgo->execute();
$userAgoData=$userAgo->fetch();
echo user_time_ago($userAgoData['last_activity']);;
