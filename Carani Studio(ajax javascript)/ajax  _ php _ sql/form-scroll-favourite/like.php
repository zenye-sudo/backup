<?php
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] =="XMLHttpRequest";
}

if(!is_ajax_request()){exit;}
$db=new PDO("mysql:host=localhost;dbname=cs(infinite scroll and like)","root","");
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$pid=isset($_POST['pid']) ? $_POST['pid'] : "";
$uid=isset($_POST['uid']) ? $_POST['uid'] : "";
$pid1=isset($_POST['pid1']) ? $_POST['pid1'] : "";
if(isset($_POST['uid']) && isset($_POST['pid']) && isset($_POST['pid1'])){
    $result1=$db->prepare("SELECT * FROM likecs WHERE uid='{$uid}' AND pid={$pid}");
    $result1->execute();
    $result1->setFetchMode(PDO::FETCH_ASSOC);
    if($result1->fetchColumn()==""){
        $db->exec("INSERT INTO likecs(uid,pid) VALUES ('{$uid}',{$pid})");
        $likecounter1=$db->prepare("SELECT COUNT(*) FROM likecs WHERE pid={$pid1}");
        $likecounter1->execute();
        $likecounter1->setFetchMode(PDO::FETCH_ASSOC);
        echo $likecounter1->fetchColumn();
//        echo "Liked";
    }else{
        echo "You had been liked";
    }
}

