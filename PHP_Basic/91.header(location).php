<?php 
$querystring=$_SERVER['QUERY_STRING'];
// if($querystring=="zanye"){
// 	header('location:Json Encode.php');
// }else{
// 	echo "Please!Enter Query String value"
// }
switch($querystring){

	case 'zanye':
	header('Location:121.Json Encode.php');
	break;
	
	default:
	       echo "There is not file with that request sir!";


}


 ?>