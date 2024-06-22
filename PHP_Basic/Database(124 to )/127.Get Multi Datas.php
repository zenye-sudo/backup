<?php 
define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASS","");
define("DB_NAME","zenye");

function dbConnect(){
 $connect=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
 if(mysqli_connect_errno($connect)>0){
 	exit("Connection Fail!");
 }else{
 	return $connect;
 }
};
function errDeg($data){
	echo "<pre>".print_r($data,true)."</pre>";
}
function getData($qury){
	$database=dbConnect();
  $getdatas=mysqli_query($database,$qury);
  foreach($getdatas as $item){
    echo "Id is ".$item['id']."<br>";
    echo "Name is ".$item['name']."<br>";
    echo "Email is ".$item['email']."<br>";
    echo "<hr>";
  }
};
$qury="SELECT*FROM users";
// dbConnect();
getData($qury);




 ?>