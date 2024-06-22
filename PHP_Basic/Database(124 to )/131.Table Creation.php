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
function tableCreation(){
 $database=dbConnect();
 $query="CREATE TABLE subjects(
  id INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,
  name VARCHAR(225) UNIQUE NOT NULL,
  create_at date,
  update_at date

);";
$result=mysqli_query($database,$query);
echo $result ? "Success" : "Fail!";
};
tableCreation();


 ?>