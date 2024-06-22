<?php 
session_start();
include('include.html');

echo "This is Home page."."<br>"."<br>";
if(isset($_POST['submit'])){
	$username=$_POST['username'];
	$password=$_POST['password'];
	if($username=="zanye" && $password=="123"){
      $_SESSION['username']=$username;
      $_SESSION['password']=$password;
	}else{
		echo "You are not invaild user.";
	}
}
 
 ?>
 <form action="<?php $_PHP_SELF ?>" method="post">
 	<input type="text" name="username"><br><br>
 	<input type="password" name="password"><br><br>
 	<input type="submit" name="submit">

 </form>
 