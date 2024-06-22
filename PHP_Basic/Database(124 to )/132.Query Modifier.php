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
function write($query){
	$database=dbConnect();
	// $query='SELECT*FROM users';
	$write=mysqli_query($database,$query);
	foreach($write as $item){
     // foreach($item as $items){
      echo "Id is ".$item['id']."<br>";
      echo "Name is ".$item['name']."<br>";
      echo "Password is ".$item['password']."<br>";
      echo "email is ".$item['email']."<br>";
      echo "<hr>";
     // }
	};
}
function queryModifier(){
$database=dbConnect();
$query="SELECT*FROM users ORDER BY id DESC";
$query="SELECT*FROM users ORDER BY name";

$query="SELECT*FROM users WHERE id>1";
$query="SELECT*FROM users LIMIT 2,2";

// $queryModifier=mysqli_query($database,$query);
write($query);
};
queryModifier();
// write();
 ?>