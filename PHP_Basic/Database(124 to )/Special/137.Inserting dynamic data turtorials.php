<?php 
define('DB_HOST','localhost');
define('DB_USER','root'); 
define('DB_PASS',''); 
define('DB_NAME','best');
function dbConnect(){
 $dbConnect=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
 if(mysqli_connect_errno($dbConnect)==0){
	
	 errDeggber($dbConnect);
	return $dbConnect;
 }else{
	echo "Fail!";
 }
 };
$db=dbConnect();
function errDeggber($data){
   echo "<pre>".print_r($data,true)."</pre>";
 };


//Inserting Users
$users=json_decode(file_get_contents("json/users.json"));
foreach ($users as $user){
    $qry="INSERT INTO users VALUES ($user->id,'$user->name','$user->creator','$user->email','$user->password')";
    mysqli_query($db,$qry);
}

//Inserting subjects
 $subjects=json_decode(file_get_contents("json/subjects.json"));
 foreach($subjects as $subject){
//  $query="INSERT INTO subjects (name) VALUES ('$subject->name')";
//  mysqli_query(dbConnect(),$query);
};

//Iserting Turtorials
$turtorials=json_decode(file_get_contents("json/turtorials.json"));
foreach($turtorials as $turtorial){
    $query="SELECT name FROM subjects WHERE id=$turtorial->subject_id";
    $name="";
    $result=mysqli_query($db,$query);
    foreach($result as $row){
     $name=$row['name'];
    }
    $t=0;


  for($i=$turtorial->start_id;$i<=$turtorial->end_id;$i++){
      $title=$name."".$t++;
    $qry="INSERT INTO turtorials (subjects_id,title,created_by) VALUES ($turtorial->subject_id,'$title',$turtorial->creator_id)";
    $result=mysqli_query(dbConnect(),$qry);
  }

}

//Inserting Turtorial_views
$qrys="SELECT*FROM turtorials";
$result=mysqli_query($db,$qrys);
foreach($result as $item){
   $id=$item['id'];
   $static_view=mt_rand(10000,100000000);
   $unique_view=mt_rand(100,10000);
   $qryey="INSERT INTO turtorial_views VALUES ($id,'$static_view','$unique_view')";
   mysqli_query($db,$qryey);
};
?>