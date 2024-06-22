<?php 
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'lessons');
function errDebugger($data){
   echo "<pre>".print_r($data,true)."</pre>";
};
function dbConnect(){
$dbConnect=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
if(mysqli_connect_errno($dbConnect)==0){
	errDebugger($dbConnect);
	return $dbConnect;
}else{
	echo "Connection Fail!";
}
};
dbConnect();

function insertDatas(){
  $qry="INSERT INTO coder VALUES(0,'ZANYE','DSLFHS','SDHFOS',)"
};


 ?>