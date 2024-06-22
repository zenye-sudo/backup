<?php 
define('DB_HOST','localhost');
define('DB_NAME','best');
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
// $query="CREATE TABLE IF NOT EXISTS  users(
// id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT ,
// name VARCHAR(225) NOT NULL,
// email VARCHAR(225) NOT NULL,
// password VARCHAR(225) NOT NULL,
// UNIQUE KEY(email)

// );";

// $query="CREATE TABLE IF NOT EXISTS subjects(
// id INT(10) NOT NULL AUTO_INCREMENT,
// name VARCHAR(225) NOT NULL,
// PRIMARY KEY(id)
// );";

// $query="CREATE TABLE IF NOT EXISTS turtorials(
// id INT(10) NOT NULL AUTO_INCREMENT,
// subjects_id INT(3) NOT NULL,
// title VARCHAR(225) NOT NULL,
// created_by INT(3) NOT NULL,
// PRIMARY KEY(id)
// );";

$query='CREATE TABLE IF NOT EXISTS turtorial_views(
id INT(10) NOT NULL PRIMARY KEY,
static_view INT(10) NOT NULL,
unique_view INT(10) NOT NULL
);';
$shortcut=mysqli_query(dbConnect(),$query);
echo $shortcut ? "Success" :"Fail!";


 ?>