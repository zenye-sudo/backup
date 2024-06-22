<?php
require_once "connection.php";
$gettingList=$db->prepare("SELECT * FROM `vac` WHERE user_id={$_COOKIE['useridKoMoney']} and status=1 and NOW()>targetDate");
$gettingList->execute();
foreach($gettingList->fetchAll() as $key=>$value){
    $twod=$value['num'];
    $price=$value['price'];
    $date0=$value['targetDate'];
    $date=strtotime($date0);
    $Date=date("Y-m-d",$date);
    $Time=date("H:i:s A",$date);
    if($Time=="12:05:00 PM"){
      $check=$db->prepare("select 2d from 2d where date='{$Date}' and name='12:00' and type=0 and channel='internet'");
      $check->execute();
      $checkFetch=$check->fetch();
      if($check->rowCount()==0){
          $close=$db->prepare("update vac set status=0,wl='l',close=1 where targetDate=:targetDate and user_id={$_COOKIE['useridKoMoney']} and num='{$twod}' and price='{$price}' and type='twod' and status=1 and wl='l'");
          $close->execute(array(
             "targetDate"=>$date0
          ));
      }else{
      if($twod==$checkFetch['2d']){
          $update=$db->prepare("UPDATE vac set status=0,wl='w',close=0 WHERE targetDate=:targetDate and user_id={$_COOKIE['useridKoMoney']} and num='{$twod}' and price='{$price}' and type='twod' and status=1 and wl='l'");
          $update->execute(array(
              "targetDate"=>$date0
          ));
          $pricePrize=$price*100;
          $gettingBalance=$db->prepare("select vac from users where id={$_COOKIE['useridKoMoney']} and username='{$_COOKIE['usernameKoMoney']}'");
          $gettingBalance->execute();
          $gettingBalanceFetch=$gettingBalance->fetch();
          $newVacBalance=(float)$pricePrize+(float)$gettingBalanceFetch['vac'];
          $updateNewBalance=$db->prepare("update users set vac='{$newVacBalance}' where id={$_COOKIE['useridKoMoney']} and username='{$_COOKIE['usernameKoMoney']}'");
          $updateNewBalance->execute();
      }else{
          $update=$db->prepare("UPDATE vac set status=0,wl='l',close=0 WHERE targetDate=:targetDate and user_id={$_COOKIE['useridKoMoney']} and num='{$twod}' and price='{$price}' and type='twod' and status=1 and wl='l'");
          $update->execute(array(
              "targetDate"=>$date0
          ));
      }
      }
    }else if($Time=="16:35:00 PM"){
       $check=$db->prepare("select 2d from 2d where date='{$Date}' and name='4:30' and type=0 and channel='internet'");
       $check->execute();
       $checkFetch=$check->fetch();
       if($check->rowCount()==0){
           $close=$db->prepare("update vac set status=0,wl='l',close=1 where targetDate=:targetDate and user_id={$_COOKIE['useridKoMoney']} and num='{$twod}' and price='{$price}' and type='twod' and status=1 and wl='l'");
           $close->execute(array(
               "targetDate"=>$date0
           ));
       }else{
           if($twod==$checkFetch['2d']){
               $update=$db->prepare("UPDATE vac set status=0,wl='w',close=0 WHERE targetDate=:targetDate and user_id={$_COOKIE['useridKoMoney']} and num='{$twod}' and price='{$price}' and type='twod' and status=1 and wl='l'");
               $update->execute(array(
                   "targetDate"=>$date0
               ));
               $pricePrize=$price*100;
               $gettingBalance=$db->prepare("select vac from users where id={$_COOKIE['useridKoMoney']} and username='{$_COOKIE['usernameKoMoney']}'");
               $gettingBalance->execute();
               $gettingBalanceFetch=$gettingBalance->fetch();
               $newVacBalance=(float)$pricePrize+(float)$gettingBalanceFetch['vac'];
               $updateNewBalance=$db->prepare("update users set vac='{$newVacBalance}' where id={$_COOKIE['useridKoMoney']} and username='{$_COOKIE['usernameKoMoney']}' " );
               $updateNewBalance->execute();
           }else{
                $update=$db->prepare("UPDATE vac set status=0,wl='l',close=0 WHERE targetDate=:targetDate and user_id={$_COOKIE['useridKoMoney']} and num='{$twod}' and price='{$price}' and type='twod' and status=1 and wl='l'");
                $update->execute(array(
                 "targetDate"=>$date0
                ));
           }
       }

    }else if($Time=="15:35:00 PM"){
        $check=$db->prepare("select 2d from 2d where date='{$Date}' and name='3:30' and type=1 and channel='internet'");
        $check->execute();
        $checkFetch=$check->fetch();
        $tot1=(int)$twod+1;
        $tot2=(int)$twod-1;
        if($check->rowCount()==0){
            $close=$db->prepare("update vac set status=0,wl='l',close=1 where targetDate=:targetDate and user_id={$_COOKIE['useridKoMoney']} and num='{$twod}' and price='{$price}' and type='threed' and status=1 and wl='l'");
            $close->execute(array(
                "targetDate"=>$date0
            ));
        }else{
            if($twod==$checkFetch['2d']){
                $update=$db->prepare("UPDATE vac set status=0,wl='w',close=0 WHERE targetDate=:targetDate and user_id={$_COOKIE['useridKoMoney']} and num='{$twod}' and price='{$price}' and type='threed' and status=1 and wl='l'");
                $update->execute(array(
                    "targetDate"=>$date0
                ));
                $pricePrize=$price*1000;
                $gettingBalance=$db->prepare("select vac from users where id={$_COOKIE['useridKoMoney']} and username='{$_COOKIE['usernameKoMoney']}'");
                $gettingBalance->execute();
                $gettingBalanceFetch=$gettingBalance->fetch();
                $newVacBalance=(float)$pricePrize+(float)$gettingBalanceFetch['vac'];
                $updateNewBalance=$db->prepare("update users set vac='{$newVacBalance}' where id={$_COOKIE['useridKoMoney']} and username='{$_COOKIE['usernameKoMoney']}' " );
                $updateNewBalance->execute();
            }else if($tot1==$checkFetch['2d'] || $tot2==$checkFetch['2d']){
                $update=$db->prepare("UPDATE vac set status=0,wl='t',close=0 WHERE targetDate=:targetDate and user_id={$_COOKIE['useridKoMoney']} and num='{$twod}' and price='{$price}' and type='threed' and status=1 and wl='l'");
                $update->execute(array(
                    "targetDate"=>$date0
                ));
                $pricePrize=$price*100;
                $gettingBalance=$db->prepare("select vac from users where id={$_COOKIE['useridKoMoney']} and username='{$_COOKIE['usernameKoMoney']}'");
                $gettingBalance->execute();
                $gettingBalanceFetch=$gettingBalance->fetch();
                $newVacBalance=(float)$pricePrize+(float)$gettingBalanceFetch['vac'];
                $updateNewBalance=$db->prepare("update users set vac='{$newVacBalance}' where id={$_COOKIE['useridKoMoney']} and username='{$_COOKIE['usernameKoMoney']}' " );
                $updateNewBalance->execute();
            }else{
                $update=$db->prepare("UPDATE vac set status=0,wl='l',close=0 WHERE targetDate=:targetDate and user_id={$_COOKIE['useridKoMoney']} and num='{$twod}' and price='{$price}' and type='threed' and status=1 and wl='l'");
                $update->execute(array(
                    "targetDate"=>$date0
                ));
            }
        }

    }


}
?>
<script>
    function test1(){
        var hey2="<?php
            $test1=$db->prepare("select vac from users where id={$_COOKIE['useridKoMoney']}");
            $test1->execute();
            $test1Fetch=$test1->fetch();
            echo $test1Fetch['vac'];
            ?>";
        $(".vacbalance").text(hey2);
    }
    setTimeout(test1,1000);
</script>
