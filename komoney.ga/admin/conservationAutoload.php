<?php
require_once "../connection.php";
function is_ajax_request(){
return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
}
if(!is_ajax_request()){exit;};
date_default_timezone_set("Asia/Rangoon");
function conservation_time_ago($dbData){
    $dbData=strtotime($dbData);
    $nowData=time();
    $dbDataY=date("Y",$dbData);
    $nowDataY=date("Y",$nowData);
    $dbDataM=date("M",$dbData);
    $nowDataM=date("M",$nowData);
    $dbDataD=date("d",$dbData);
    $nowDataD=date("d",$nowData);
    if($dbDataY==$nowDataY && $dbDataM==$nowDataM && $dbDataD==$nowDataD){
        return date("h:i A",$dbData);
    }else if($dbDataY==$nowDataY){
        return date("M d",$dbData);
    }else{
        return date("M d,Y",$dbData);
    }
}
/**for check active conservation start*/
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
/**for check active conservation end*/
$fnum=isset($_GET['fnum']) ? $_GET['fnum'] : "";
$fnum1=isset($_GET['fnum1']) ? $_GET['fnum1'] : "";
$tn=$db->prepare("select * from conservation where uid=:uid");
$tn->execute(array(
    "uid"=>$fnum
));
$conservationCount=$db->prepare("select count(*) from conservation where uid=:uid");
$conservationCount->execute(array(
    "uid"=>$fnum
));
$cc=$conservationCount->fetchColumn();
$conservationCount1=$db->prepare("select count(*) from conservation where uid=:uid");
$conservationCount1->execute(array(
    "uid"=>$fnum1
));
$ccc=$conservationCount1->fetchColumn();
$array=[];
$array1=[];
if($fnum1!=""){
    $array1[]=['conservationCount'=>$ccc];
    echo json_encode($array1);
}else{
    foreach($tn->fetchAll() as $item){
    $num1=($fnum+1)*($fnum+1);
    $total=$item['tn'];
    $cal=(sqrt($total-$num1))-1;
    $conservationUser=$db->prepare("select * from users where id=:id");
    $conservationUser->execute(array(
        "id"=>$cal
    ));
    $conservationUserData=$conservationUser->fetch();
    $retriveTable=$db->prepare("select * from `{$total}` ORDER BY id DESC LIMIT 1");
    $retriveTable->execute();
    $retriveTableData=$retriveTable->fetch();
    $retriveUnseen=$db->prepare("select * from `{$total}` where uid!={$fnum} and view=0");
    $retriveUnseen->execute();
    $pp=json_decode($conservationUserData['pp']);
        /**for conservation date format start*/
        $retrieveConservation2=$db->prepare("select * from `{$item["tn"]}` ORDER BY id DESC");
        $retrieveConservation2->execute();
        $retrieveConservation2Data=$retrieveConservation2->fetch();
        $dd="";
        $tnDbDate=$retrieveConservation2Data['created_at'];
        $cvDbDate=$item['created_at'];
        if($tnDbDate!=""){
            $dd=conservation_time_ago($tnDbDate);
        }else{
            $dd=conservation_time_ago($cvDbDate);
        }
        /**for check active conservation start*/
        $checkActive=$db->prepare("select * from login_details where uid={$cal}");
        $checkActive->execute();
        $checkActiveData=$checkActive->fetch();
        $str="";
            if(user_time_ago($checkActiveData['last_activity'])=="Just now"){
                $str="display:block";
            }else{
                $str="display:none";
            }
        /**for check active conservation end*/
        /**for conservation date format End*/
    $array[]=["pp"=>$pp,"tn"=>$total,"username"=>$conservationUserData['username'],"unseen"=>$retriveUnseen->rowCount(),"tnUser"=>$retriveTableData['uid'],"tnText"=>substr($retriveTableData['text'],0,25),"tnRowCount"=>$retriveTable->rowCount(),"cal"=>$cal,"conservationCount"=>$cc,"cdf"=>$dd,"nb"=>$str];
}
echo json_encode($array);
}
