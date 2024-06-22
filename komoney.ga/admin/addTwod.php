<?php
require_once("../connection.php");
$name=$_POST['name'];
$channel=$_POST['channel'];
$twod=$_POST['twod'];
$type=$_POST['type'];
$date=$_POST['date'];
if($name!="" && $channel!="" && $twod!="" && $type!="" && $date!=""){
$result=$db->prepare("select * from 2d where date=:date");
$result->execute(array(
 "date"=>$date
));
$resultFetch=$result->fetch();
if($resultFetch['2d']==""){
	$result1=$db->prepare("insert into 2d(name,channel,2d,type,date) values(:name,:channel,:2d,:type,:date)");
	$result1->execute(array(
     "name"=>$name,
     "channel"=>$channel,
     "2d"=>$twod,
     "type"=>$type,
     "date"=>$date
	));
    header("location:admin.php");
}
}
