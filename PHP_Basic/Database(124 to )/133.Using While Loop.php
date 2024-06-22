<?php 
define('DB_HOST','localhost');
define('DB_NAME','zenye');
define('DB_USER', 'root');
define('DB_PASS','');

function dbConnect(){
	$db=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    if(mysqli_connect_errno($db)>0){
    	exit('Connection Fail!');
    }else{
    	return $db;
    }
};
 function getDatas($query){
 $database=dbConnect();
 $getDatas=mysqli_query($database,$query);
 if(mysqli_num_rows($getDatas)>0){
 	while($row=mysqli_fetch_assoc($getDatas)){
       // echo "Id is ".$row['id']."<br>";
       echo "Name is ".$row['name']."<br>";
       // echo "Email is ".$row['email']."<br>";
       // echo "Password is ".$row['password']."<br>";
       echo '<hr>';
   }
 }
 };
 $query="SELECT DISTINCT(name) FROM users WHERE extra is NULL";
 getDatas($query);

 ?>