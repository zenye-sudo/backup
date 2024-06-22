<?php 
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'zenye');

function dbConnect(){
	$connect=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	if(mysqli_connect_errno($connect)>0){
		exit($connect);
	}else{
		return $connect;
	}
}
// function getData($query){
// 	$database=dbConnect();
// 	$getdata=mysqli_query($database,$query);
// 	foreach($getdata as $item){
// 		echo $item['id']."<br>";
// 	}
// }
dbConnect();
// $query='SELECT*FROM users';
// getData($query);
function getData($query){
	$database=dbConnect();
    $result=mysqli_query($database,$query);	
    foreach($result as $item){
    	
    		echo "ID is ".$item['id']."<br>";
    		echo "NAME is ".$item['name']."<br>";
    		echo "EMAIL is ".$item['email']."<br>";
    		echo "PASSWORD is ".$item['password']."<br>";

    }
}
$query="SELECT*FROM users WHERE id=1";
getData($query);


 ?>