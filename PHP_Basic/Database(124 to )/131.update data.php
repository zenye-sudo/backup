<?php 
define("DB_HOST", "localhost");
define("DB_NAME", "zenye");
define("DB_USER", "root");
define("DB_PASS", "");

function dbConnect(){
	$dbConnect=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	if(mysqli_connect_errno($dbConnect)==0){
		return $dbConnect;
	}else{
		echo "Connection Fail!";
	}
}
function updataDatas(){
$database=dbConnect();
$query="UPDATE users SET name='yezen' WHERE name='zenye'";
$updataDatas=mysqli_query($database,$query);
echo $updataDatas?"Success":"Fail!";
};
updataDatas();

 ?>