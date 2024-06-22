<?php 
define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASS","");
define("DB_NAME","zenye");
// function passgenerator($pass){
//    $pass=md5($pass);
//    $pass=sha1($pass);
//    $pass=crypt($pass,$pass);
//    return $pass;
// };
function dbConnect(){
 $dbConnect=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
 if(mysqli_connect_errno($dbConnect)==0){
 
 	return $dbConnect;
 	// echo "Success!";
 }else{
 	echo "Fail!";
 }
};
// $pass=passgenerator(123);
function insertData(){
	$database=dbConnect();
	$query="INSERT INTO users VALUES ('0','mgmg','mgmg@gmail.com','123')";
	$insertData=mysqli_query($database,$query);
	echo $insertData>0 ? "Success ".mysqli_insert_id($database):"Fail!";
}
function getDatas(){
	$database=dbConnect();
	$query="SELECT*FROM users";
	$getDatas=mysqli_query($database,$query);
	foreach($getDatas as $getData){
    echo $getData['name']."<br>";
	}
}
function uniquedatainsert(){
 $database=dbConnect();
 $name='aung aung';
 $query="SELECT*FROM users WHERE name='$name'";
 $name=mysqli_query($database,$query);
  if(mysqli_num_rows($name)>0){
  	echo "Username is already exists.";
  }else{
  	$database=dbConnect();
  	$query="INSERT INTO users (id,name,email,password) VALUES(0,'aung aung','aungaung@gmail.com','123')";
  	$addusername=mysqli_query($database,$query);
  	echo $addusername>0 ? "had been upload." :"Fial Upload";
  }
};
// dbConnect();
// insertData();
// getDatas();
uniquedatainsert();


 ?>