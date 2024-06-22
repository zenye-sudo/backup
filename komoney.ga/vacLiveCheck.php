<?php
//sleep(1);
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
}
if(!is_ajax_request()){exit;};
require_once ("connection.php");
$targetDate=isset($_GET['targetDate']) ? $_GET['targetDate'] : "NO";
$type=isset($_GET['type']) ? $_GET['type'] : "NO";
$num=isset($_GET['num']) ? $_GET['num'] : "NO";
$price=isset($_GET['price']) ? $_GET['price'] : "NO";
$id=isset($_GET['id']) ? $_GET['id'] : "NO";
$targetDateDate=strtotime($targetDate);
$targetDateTime=date("H:i:s",$targetDateDate);
$targetDateDate=date("Y-m-d",$targetDateDate);
if($targetDateTime=="16:35:00"){
    $targetDateTime="4:30";
}else if($targetDateTime=="12:05:00"){
    $targetDateTime="12:00";
}else if($targetDateTime=="15:35:00"){
    $targetDateTime="3:30";
}
if($type=="twod"){
   $type=0;
}else if($type=="threed"){
   $type=1;
}
$check=$db->prepare("select * from 2d where date='{$targetDateDate}' and type={$type} and name='{$targetDateTime}'");
$check->execute();
$checkFetch=$check->fetch();
if($type==0){ //For twod
    if($check->rowCount()==0){
        $close=$db->prepare("update vac set status=0,wl='l',close=1 where id={$id}");
        $close->execute();
        echo "Closed";
    }else{
        if($num==$checkFetch['2d']){
            $update=$db->prepare("UPDATE vac set status=0,wl='w',close=0 WHERE id={$id}");
            $update->execute();
            $pricePrize=$price*100;
            $gettingBalance=$db->prepare("select vac from users where id={$_COOKIE['useridKoMoney']} and username='{$_COOKIE['usernameKoMoney']}'");
            $gettingBalance->execute();
            $gettingBalanceFetch=$gettingBalance->fetch();
            $newVacBalance=(float)$pricePrize+(float)$gettingBalanceFetch['vac'];
            $updateNewBalance=$db->prepare("update users set vac='{$newVacBalance}' where id={$_COOKIE['useridKoMoney']} and username='{$_COOKIE['usernameKoMoney']}'");
            $updateNewBalance->execute();
            echo $newVacBalance;
        }else{
            $update=$db->prepare("UPDATE vac set status=0,wl='l',close=0 WHERE id={$id}");
            $update->execute();
            echo "Lose";
        }
    }
}else{        //For threeed
    $tot1=(int)$num+1;
    $tot2=(int)$num-1;
    if($check->rowCount()==0){
        $close=$db->prepare("update vac set status=0,wl='l',close=1 where id={$id}");
        $close->execute();
        echo "Closed";
    }else{
        if($num==$checkFetch['2d']){
            $update=$db->prepare("UPDATE vac set status=0,wl='w',close=0 WHERE id={$id}");
            $update->execute();
            $pricePrize=$price*1000;
            $gettingBalance=$db->prepare("select vac from users where id={$_COOKIE['useridKoMoney']} and username='{$_COOKIE['usernameKoMoney']}'");
            $gettingBalance->execute();
            $gettingBalanceFetch=$gettingBalance->fetch();
            $newVacBalance=(float)$pricePrize+(float)$gettingBalanceFetch['vac'];
            $updateNewBalance=$db->prepare("update users set vac='{$newVacBalance}' where id={$_COOKIE['useridKoMoney']} and username='{$_COOKIE['usernameKoMoney']}'");
            $updateNewBalance->execute();
            echo $newVacBalance;
        }else if($tot1==$checkFetch['2d'] || $tot2==$checkFetch['2d']){
            $update=$db->prepare("UPDATE vac set status=0,wl='t',close=0 WHERE id={$id}");
            $update->execute();
            $pricePrize=$price*100;
            $gettingBalance=$db->prepare("select vac from users where id={$_COOKIE['useridKoMoney']} and username='{$_COOKIE['usernameKoMoney']}'");
            $gettingBalance->execute();
            $gettingBalanceFetch=$gettingBalance->fetch();
            $newVacBalance=(float)$pricePrize+(float)$gettingBalanceFetch['vac'];
            $updateNewBalance=$db->prepare("update users set vac='{$newVacBalance}' where id={$_COOKIE['useridKoMoney']} and username='{$_COOKIE['usernameKoMoney']}' " );
            $updateNewBalance->execute();
            echo "Tot".$newVacBalance;
        }else{
            $update=$db->prepare("UPDATE vac set status=0,wl='l',close=0 WHERE id={$id}");
            $update->execute();
            echo "Lose";
        }
    }
}