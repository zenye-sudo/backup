<?php
//sleep(2);
function is_ajax_request(){
return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
}
if(!is_ajax_request()){exit;};
require_once "connection.php";
$data=$_POST['data'];
$decode=json_decode($data);
//For Check Balance Start
$totalBetPrice=$decode->totalPrice;
$virtualBalance=$db->prepare("select vac from users where id={$_COOKIE['useridKoMoney']}");
$virtualBalance->execute();
//For Check Balance end
$virtualBalanceFetch=$virtualBalance->fetch();
if($decode->time=="15:35:00") {
    if($totalBetPrice<$virtualBalanceFetch['vac']){
        $confirmVocherTime=$decode->time;
        $confirmVocherDate=$decode->date;
//For Authanticate date and time start
        $nowTimestampDate=date("Y-m-d",time());
        $nowTimestampDate=strtotime($nowTimestampDate);
        $betTimestampDate=strtotime($confirmVocherDate);
        $nowTimestampTime=time();
        $betTimestampTime=$confirmVocherDate." ".$confirmVocherTime;
        $betTimestampTime=strtotime($betTimestampTime);
//For Authanticate date and time end
        if($betTimestampDate<$nowTimestampDate || $betTimestampTime<$nowTimestampTime){
            if($betTimestampDate<$nowTimestampDate){
                echo "Wrong Date!Please change date!";
            }else if($betTimestampTime<$nowTimestampTime){
                echo "Wrong Time!Pleae Change time!";
            }
        }else {

                if($nowTimestampTime<$betTimestampTime-600){
                    foreach ($decode->list as $key => $value) {
                        $insertConfirmVocher = $db->prepare("insert into vac(user_id,num,price,type,status,wl,fromDate,targetDate) VALUES (:user_id,:num,:price,:type,:status,:wl,NOW(),:targetDate)");
                        $insertConfirmVocher->execute(array(
                            "user_id" => $_COOKIE['useridKoMoney'],
                            "num" => $decode->list->$key->threed,
                            "price" => $decode->list->$key->price,
                            "type"=>"threed",
                            "status" => 1,
                            "wl"=>"l",
                            "targetDate" => $confirmVocherDate . " " . $confirmVocherTime
                        ));
                    }

                    $nowVirtualBalance=$virtualBalanceFetch['vac']-$totalBetPrice;
                    $updateBalance=$db->prepare("UPDATE users set vac='{$nowVirtualBalance}' WHERE id={$_COOKIE['useridKoMoney']}");
                    $updateBalance->execute();
                    echo $nowVirtualBalance;
                }else{
                    echo "Daing close!";
                }

        }
    }else{
        echo "Your balance is not enough!";
    }
}else{

    if($totalBetPrice<$virtualBalanceFetch['vac']){
        $confirmVocherTime=$decode->time;
        $confirmVocherDate=$decode->date;
//For Authanticate date and time start
        $nowTimestampDate=date("Y-m-d",time());
        $nowTimestampDate=strtotime($nowTimestampDate);
        $betTimestampDate=strtotime($confirmVocherDate);
        $nowTimestampTime=time();
        $betTimestampTime=$confirmVocherDate." ".$confirmVocherTime;
        $betTimestampTime=strtotime($betTimestampTime);
//For Authanticate date and time end
        if($betTimestampDate<$nowTimestampDate || $betTimestampTime<$nowTimestampTime){
            if($betTimestampDate<$nowTimestampDate){
                echo "Wrong Date!Please change date!";
            }else if($betTimestampTime<$nowTimestampTime){
                echo "Wrong Time!Pleae Change time!";
            }
        }else {
            if($decode->time=="16:35:00"){
                if ($nowTimestampTime < $betTimestampTime - 2400) {
                    foreach ($decode->list as $key => $value) {
                        $insertConfirmVocher = $db->prepare("insert into vac(user_id,num,price,type,status,wl,fromDate,targetDate) VALUES (:user_id,:num,:price,:type,:status,:wl,NOW(),:targetDate)");
                        $insertConfirmVocher->execute(array(
                            "user_id" => $_COOKIE['useridKoMoney'],
                            "num" => $decode->list->$key->twod,
                            "price" => $decode->list->$key->price,
                            "type" => "twod",
                            "status" => 1,
                            "wl" => 'l',
                            "targetDate" => $confirmVocherDate . " " . $confirmVocherTime
                        ));
                    }
                    $nowVirtualBalance = $virtualBalanceFetch['vac'] - $totalBetPrice;
                    $updateBalance = $db->prepare("UPDATE users set vac='{$nowVirtualBalance}' WHERE id={$_COOKIE['useridKoMoney']}");
                    $updateBalance->execute();
                    echo $nowVirtualBalance;
                } else {
                    echo "Daing close!";
                }
            }else if($decode->time=="12:05:00") {
                if ($nowTimestampTime < $betTimestampTime - 600) {
                    foreach ($decode->list as $key => $value) {
                        $insertConfirmVocher = $db->prepare("insert into vac(user_id,num,price,type,status,wl,fromDate,targetDate) VALUES (:user_id,:num,:price,:type,:status,:wl,NOW(),:targetDate)");
                        $insertConfirmVocher->execute(array(
                            "user_id" => $_COOKIE['useridKoMoney'],
                            "num" => $decode->list->$key->twod,
                            "price" => $decode->list->$key->price,
                            "type" => "twod",
                            "status" => 1,
                            "wl" => 'l',
                            "targetDate" => $confirmVocherDate . " " . $confirmVocherTime
                        ));
                    }
                    $nowVirtualBalance = $virtualBalanceFetch['vac'] - $totalBetPrice;
                    $updateBalance = $db->prepare("UPDATE users set vac='{$nowVirtualBalance}' WHERE id={$_COOKIE['useridKoMoney']}");
                    $updateBalance->execute();
                    echo $nowVirtualBalance;
                } else {
                    echo "Daing close!";
                }
            }

        }
    }else{
        echo "Your balance is not enough!";
    }

}
