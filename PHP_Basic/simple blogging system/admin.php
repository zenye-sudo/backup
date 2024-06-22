<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<?php
session_start();
include_once("sysgen/mySession.php");
include_once ("sysgen/postgenerator.php");

if(getSession("email")=="futurenetzenye@gmail.com"){
//    header("location:admin.php");
}else{
    header("location:index.php");
}

include_once ("include/admin.php");

?>

<script>
    var message=document.getElementById("message");
    var alertbtn=document.getElementById("alertbtn");
    alertbtn.onclick=function(){
        message.style.display="none";
    }

</script>
</body>
</html>