<?php

define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','best');
function dbConnect(){
   $dbConnect=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
   if(mysqli_connect_errno($dbConnect)==0){
//       echo "Connection Successful!";
       return $dbConnect;
   }else{
       echo "Connection Fail!";
   }
};
$db=dbConnect();
function errDebugger($data){
    echo "<pre>".print_r($data,true)."</pre>";

}
function passGen($pass){
    $pass=md5($pass);
    $pass=sha1($pass);
    $pass=crypt($pass,$pass);
}
//function createTable(){
//    $db=dbConnect();
//    $users="CREATE TABLE IF NOT EXISTS users(
//id INT(10) PRIMARY KEY NOT NULL AUTO_INCREMENT,
//name VARCHAR(225) NOT NULL,
//creator_id INT(10) NOT NULL,
//email VARCHAR(224) NOT NULL,
//password VARCHAR(225) NOT NULL);"; mysqli_query($db,$users);
//    $subjects='CREATE TABLE IF NOT EXISTS subjects(
//id INT(10) PRIMARY KEY NOT NULL AUTO_INCREMENT,
//name VARCHAR(225) NOT NULL);';mysqli_query($db,$subjects);
//};
    $turtorials="CREATE TABLE IF NOT EXISTS turtorials(
id INT(10) PRIMARY KEY NOT NULL AUTO_INCREMENT,
subject_id INT(10) NOT NULL,
title VARCHAR(225) NOT NULL,
created_by INT(10) NOT NULL
);";mysqli_query($db,$turtorials);
//    $turtorials_view="CREATE TABLE IF NOT EXISTS turtorials_view(
// id INT(10) PRIMARY KEY NOT NULL AUTO_INCREMENT,
// static_view INT(100) NOT NULL,
// unique_view INT(100) NOT NULL
//);";mysqli_query($db,$turtorials_view);
//createTable();


function insertDatas(){
//  $users=json_decode(file_get_contents("json/users.json"));
//  $subjects=json_decode(file_get_contents("json/subjects.json"));
  $turtorials=json_decode(file_get_contents("json/turtorials.json"));
  foreach($users as $user){
      $db=dbConnect();
      $qry="INSERT INTO users(id,name,creator,email,password) VALUES($user->id,'$user->name',$user->creator,'$user->email','$user->password')";
      mysqli_query($db,$qry);
  };
  foreach($subjects as $subject){
    $qry="INSERT INTO subjects VALUES($subject->id,'$subject->name')";
    mysqli_query($db,$qry);
  };
  foreach($turtorials as $turtorial){
      $db=dbConnect();
      $name="SELECT name FROM subjects WHERE id=$turtorial->subject_id";
      $nameqry=mysqli_query($db,$name);
      $narmae="";
      foreach($nameqry as $item){
         $narmae=$item['name'];
      }
      $t=0;
      for($i=1;$i<20;$i++){
          $title=$narmae." ".++$t;
          $qry="INSERT INTO turtorials(subject_id,title,created_by) VALUES($turtorial->subject_id,'$title',$turtorial->creator_id);";
          mysqli_query($db,$qry);
      };

  };
//    $db=dbConnect();
//  $a="SELECT * FROM turtorials";
//  $result=mysqli_query($db,$a);
//  foreach($result as $item){
//      $b=$item['id'];
//      $static_view=mt_rand(100,10000);
//      $unique_view=mt_rand(19,34343);
//      $qry="INSERT INTO turtorials_view VALUES($b,$static_view,$unique_view)";
//      mysqli_query($db,$qry);
//  };

};
insertDatas();
?>
