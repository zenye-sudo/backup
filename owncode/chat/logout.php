<?php
setcookie("user",$_SESSION['username'],time()-3600,'/','',0);
session_destroy();
header("location:index.php");