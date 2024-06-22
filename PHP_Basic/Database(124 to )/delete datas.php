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
function deleteDatas(){
	$database=dbConnect();
	// for($i=94;$i<=118;$i++){

	$query="DELETE FROM users WHERE name='geegee'";
	$deleteDatas=mysqli_query($database,$query);
	
	// }
	echo $deleteDatas ? "Deleted" :"Delete Fail!.<BR>";

}
// dbConnect();
deleteDatas();



 ?>