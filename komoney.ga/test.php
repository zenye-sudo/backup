<?php
require_once("connection.php");
// for($i=0;$i<=2000;$i++){
// 	$result=$db->prepare("insert into proof(username,method,amount,date) values(:username,:method,:amount,:date)");
// 	$result->execute(array(
//       "username"=>"Aung Myo Htut",
//       "method"=>"wave money",
//       "amount"=>"200000".$i,
//       "date"=>date("Y-m-d",time())
// 	));
// }
// $random="";
// for($i=1;$i<=500;$i++){
// $test=rand(0,1);
// if($test==0){
// $random="Wave Money";
// }else{
//      $random="Ok$";
// }

//      $result=$db->prepare("update proof set method='{$random}' where id={$i}");
//      $result->execute();
// }



// $array=[3000,3500,4000,4500,5000,5500,6000,6500,7000,7500,8000,8500,9000,10000,10500,11000,11500,12000,12500,13000,13500,14000,14500,15000,15500,16000,16500,17000,17500,18000,18500,19000,19500,20000,21000,22000,22500,23000,24000,25000,26000,27000,28000,29000,30000,31000,33000,34000,35000,40000,50000,60000,65000,70000,80000,100000,110000,120000,130000,140000,150000,160000,170000,180000,190000,200000,210000,220000,230000,240000,250000,260000,270000,280000,290000,300000,320000,330000,350000,360000,370000,390000,400000,420000,430000,460000,470000,500000,520000,550000,600000,620000,6300000,650000,700000,710000,720000,740000,760000,770000,800000,920000,950000,960000,970000,1000000];
// $len=106;
// for($i=1;$i<=500;$i++){
// $test=rand(0,106);
//      $result=$db->prepare("update proof set amount='{$array[$test]}' where id={$i}");
//      $result->execute();
// // }
// $array=[];
// $date=strtotime(date("Y-m-d"))+86400;
// for($i=1530466200;$i<=$date;$i+=86400){
// $date1=date("Y-m-d",$i);
// $array[]=$date1;
// }
// for($i=1415;$i<=1823;$i++){
//      $rand=rand(0,150);
//      $result=$db->prepare("update proof set date='{$array[$rand]}' where id={$i}");
//      $result->execute();
// }
// for($i=20;$i<=40;$i++){
//      $result=$db->prepare("select * from proof where id={$i}");
//      $result->execute();
//      $resultFetch=$result->fetch();
//           $result1=$db->prepare("insert into proof(username,method,amount,date) values(:username,:method,:amount,:date)");
//           $result1->execute(array(
//           "username"=>$resultFetch['username'],
//           "method"=>$resultFetch['method'],
//           "amount"=>$resultFetch['amount'],
//           "date"=>$resultFetch['date']
//           ));
$array=["Lin Thu","Myint Naing","Lin Linn","Ko Htet Phyo","Hein Arkar Htun","U Ag Wai","Pyay Phyoe ","Mg Ye","Zaw Zaw","Wai Zarni","Khant Myo","Aung Mg","Aung Zaw"];
$array1=["100000","120000","190000","140000","10000","179000","220000","10000","5000","7000","8000","4000","10000"];
for($i=0;$i<=13;$i++){
	$rand=rand(0,1);
	if($rand==0){
     $test="Wave Money";
	}else{
     $test="Ok$";
	}
	$result=$db->prepare("insert into proof(username,method,amount,date) values(:username,:method,:amount,:date)");
	$result->execute(array(
      "username"=>$array[$i],
      "method"=>$test,
      "amount"=>$array1[$i],
      "date"=>"2018-12-07"
	));
}
// $result1=$db->prepare("INSERT INTO `2d` (`name`, `channel`, `2d`, `type`, `date`) VALUES ('4:30', 'internet', '12', '0', '2018-12-03');");
// $result1->execute();