<?php
//sleep(2);
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
}
if(!is_ajax_request()){exit;};
require "connection.php";
$now=date("Y-m-d H:i:s A",time());
$typing_status=isset($_POST['typing_status']) ? $_POST['typing_status'] : "";
$myId=isset($_POST['myId']) ? $_POST['myId'] : "";
if($myId!=1 || $myId==""){
    $myId=$_COOKIE['useridKoMoney'];
}
$table=isset($_POST['table']) ? $_POST['table'] : "";
if($table!=""){
    $formula=$table;
    if($typing_status==1 || $typing_status==0){
        echo "Table is ".$formula." and MyId is ".$myId." and typing_status is ".$typing_status;
        $sql=$db->prepare("SELECT * FROM typingstatus WHERE user_id={$myId} and tn='{$formula}'");
        $sql->execute();
        echo "Row Count is ".$sql->rowCount();
        if($sql->rowCount()!= 0 ){
            if($typing_status==1){
                $query="UPDATE typingstatus SET tn='{$formula}',typing_status=1,typing_at='{$now}' WHERE user_id=:user_id AND tn='{$formula}'";
            }else{
                $query="UPDATE typingstatus SET tn='{$formula}',typing_status=0,typing_at='{$now}' WHERE user_id=:user_id AND tn='{$formula}'";
            }
            $sql2=$db->prepare($query);
            $sql2->execute(array(
                "user_id" => $myId
            ));
        } else{
            echo "Row Count is zero";
            $sql2=$db->prepare("INSERT INTO typingstatus(user_id,tn,typing_status,typing_at) VALUES({$myId},'{$formula}',{$typing_status},'{$now}')");
            $sql2->execute();
        }
    }else{
        echo "You can't fool me.";
    }
}

