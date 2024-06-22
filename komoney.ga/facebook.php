<?php
//sleep(3);
require_once "connection.php";
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest";
}
$uid=isset($_GET['uid']) ? $_GET['uid'] : "";
$otherUid=isset($_GET['otherUid']) ? $_GET['otherUid'] : "";
$data_table=isset($_GET['data_table']) ? $_GET['data_table'] : "";
if($data_table==""){
    if($uid!=1){
        $one=$_COOKIE['useridKoMoney'];
        $two=$otherUid;
    }else{
        $one=1;
        $two=$otherUid;
    }
    $onef1=$one+1;$onef2=$onef1*$onef1;$twof1=$two+1;$twof2=$twof1*$twof1;
    $tn=$onef2+$twof2;
}else{
    $tn=$data_table;
    $one=$_COOKIE['useridKoMoney'];
}

$id=isset($_GET['nextId']) ? $_GET['nextId'] : "";
$result=$db->prepare("select * from `{$tn}` where (id={$id} and uid!={$one})");
$result->execute();
//echo "Table name is ".$tn." and id is ".$id." and uid is ".$uid;
$array=[];
//echo $result->rowCount();
//echo "Tn is ".$tn." And Next Id is ".$id." and uid is ".$uid;
if($result->rowCount()!=0){
    $result=$result->fetch();
    $result1=$db->prepare("select * from users where id={$result['uid']}");
    $result1->execute();
    $result1=$result1->fetch();
    $array[]=['id'=>$result['id'],'uid'=>$result['uid'],'text'=>$result['text'],'created_at'=>$result['created_at'],'pp'=>json_decode($result1['pp']),'username'=>$result1['username']];
}
/*********For typing message start*******************/
if($otherUid!="" && $otherUid!="NaN"){
    if($uid!=""){
        $one=1;
    }else{
        $one=$_COOKIE['useridKoMoney'];
    }
    $two=$otherUid;
    $onef1=$one+1;
    $onef2=$onef1*$onef1;
    $twof1=$two+1;
    $twof2=$twof1*$twof1;
    $formula=$onef2+$twof2;
    $checkTyping=$db->prepare("select * from typingstatus where tn='{$formula}' and user_id={$otherUid} and typing_status=1");
    $checkTyping->execute();
    $checkTypingFetch=$checkTyping->fetch();
    if($checkTyping->rowCount()!=0){
        $checkTypingUser=$db->prepare("select * from users where id={$checkTypingFetch['user_id']}");
        $checkTypingUser->execute();
        $checkTypingUserFetch=$checkTypingUser->fetch();
        $array[]=['typingNowId'=>$checkTypingFetch['user_id'],'typingNowUsername'=>$checkTypingUserFetch['username'],'typingNowPp'=>json_decode($checkTypingUserFetch['pp'])];
    }else{
        $array[]=['error'=>'error'];

    }
}else{
    $checkTyping=$db->prepare("select * from typingstatus where tn='{$tn}' and typing_status=1 and user_id!={$_COOKIE['useridKoMoney']}");
    $checkTyping->execute();
    if($checkTyping->rowCount()!=0){
       foreach($checkTyping->fetchAll() as $key=>$value){
           $checkTypingUser=$db->prepare("select * from users where id={$value['user_id']}");
           $checkTypingUser->execute();
           $checkTypingUserFetch=$checkTypingUser->fetch();
           $array[]=['typingNowId'=>$value['user_id'],'typingNowUsername'=>$checkTypingUserFetch['username'],'typingNowPp'=>json_decode($checkTypingUserFetch['pp'])];
       }
    }else{
        $array[]=['error'=>'error','rowCount'=>$checkTyping->rowCount()];
    }
//    if($checkTyping->rowCount()==0){
//        $array[]=['error'=>'error'];
//    }else{
//        foreach($checkTyping->fetchAll() as $key=>$value){
//            $array[]=['typingNowId'=>$checkTypingFetch['user_id'],'typingNowUsername'=>$checkTypingUserFetch['username'],'typingNowPp'=>json_decode($checkTypingUserFetch['pp'])];
//        }
//    }
}
/****************For typing message end********************/

echo json_encode($array);
