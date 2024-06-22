<?php 
session_start();
// session_destroy();
  //same to this function.
  unset($_SESSION['username']);
  unset($_SESSION['password']);
include('include.html');
echo "This is Logout Page.";
 ?>