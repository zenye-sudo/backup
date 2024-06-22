<?php
function is_ajax_request(){return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
}
if (!is_ajax_request()) {exit;}; 
require_once("connection.php");
$pnum=isset($_POST['pnum']) ? (int)$_POST['pnum'] : "";
$bank=isset($_POST['bank']) ? $_POST['bank'] : "";
$amount=isset($_POST['amount']) ? (int)$_POST['amount'] : "";
if($pnum!="" && $bank!="" && $amount!=""){
	$currentBalance=$db->prepare("select rac from users where id={$_COOKIE['useridKoMoney']}");
$currentBalance->execute();
$currentBalanceFetch=$currentBalance->fetch();
$currentBalanceFetch=(int)$currentBalanceFetch['rac'];
$withdrawRomaining=$currentBalanceFetch-$amount;
if($amount>$currentBalanceFetch){
	echo "notEnough";
}else{
	$db->exec("update users set rac='{$withdrawRomaining}' where id={$_COOKIE['useridKoMoney']}");
$db->exec("INSERT INTO `dw` (`id`, `type`, `user_id`, `amount`, `bank`, `pnum`, `status`, `date`) VALUES (NULL, 'withdraw', {$_COOKIE['useridKoMoney']}, '{$amount}', '{$bank}', '{$pnum}', '0', NOW());") ;
    echo "enough";
}
}else{
	$one=$_COOKIE['useridKoMoney'];
    $two=1;
      /**
       * (x+1)*(x+1)
       * (y+1)*(y+1)
        */
/**Formula for table name*/
$onef1=$one+1;
$onef2=$onef1*$onef1;
$twof1=$two+1;
$twof2=$twof1*$twof1;
$formula=$onef2+$twof2;
/**Formula for table name*/
    $name=$_FILES['file']['name'];
    $new_name=mt_rand(time(),time()).$name;
    move_uploaded_file($_FILES['file']['tmp_name'],"SendImg/".$new_name);
    $new_name_json=json_encode($new_name);
    $result=$db->prepare("INSERT INTO `{$formula}`(uid,text,created_at) VALUES (:uid,:text,:created_at)");
    $result->execute(array(
       "uid"=>$_COOKIE['useridKoMoney'],
       "text"=>$new_name,
       "created_at"=>date("Y-m-d H:i:s",time())
    ));
	echo "Success File Upload!";
}


?>