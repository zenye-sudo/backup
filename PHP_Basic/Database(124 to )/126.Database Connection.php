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
    	return errDubbger($db);
    }
}
function errDubbger($data){
    echo "<pre>".print_r($data,true)."</pre>";
}
dbConnect();


 ?>