<?php 

define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','zenye');

function dbConnect(){
	$dbConnect=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	if(mysqli_connect_errno($dbConnect)==0){
		// return $dbConnect;
		// echo "Connection Success!";
		return $dbConnect;
	}else{
		echo "Connection Fail!";
	}
};
dbConnect();
function checkout($query,$querys){
	foreach($querys as $item){
	$database=dbConnect();
	$quer="SELECT*FROM users WHERE name='$item'";
	// echo $quer."<br>";
	$replace=mysqli_query($database,$quer);	
	if(mysqli_num_rows($replace)>0){
		echo $item." is already exists!"."<br>";
	}else{
		$database=dbConnect();
		$adddatas=mysqli_multi_query($database,$query);
		echo $adddatas>0 ? "Upload Sucess!" :"Upload Fail!";
	}
};
}

$query="INSERT INTO users VALUES (0,'deedee','deedee@gmail.com','123');";
$query.="INSERT INTO users  VALUES (0,'meemee','meemee@gmail.com','123');";
$query.="INSERT INTO users  VALUES (0,'zeezee','zeezee@gmail.com','123');";
$query.="INSERT INTO users  VALUES (0,'geegee','geegee@gmail.com','123');";

$querys=array(
   'name'=>'deedee',
   'names'=>'meemee',
   'namew'=>'zeezee',
   'namea'=>'geegee'
);checkout($query,$querys);
 ?>
