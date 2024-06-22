<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #messages{
            width:500px;
            height:434px;
            overflow:auto;
        }
        #container{
            width:500px;
            height:500px;
            margin:20px auto;
            border:1px solid black;
        }
        #user{
            font-size:18px;
            color:green;
            font-family:Cambria;
        }
    </style>

</head>
<body>
<h2 style="text-align:center;">Welcome <span style="color:green"><?php echo $_SESSION['username'] ?></span></h2>
<div id="container">
    <div id="messages">
        
    </div>
    <textarea name="text" id="text" cols="68.8" rows="4"></textarea>
</div>
<script src="../js/jquery-3.3.1.min.js"></script>
<script>
    document.getElementById("text").addEventListener("keyup",function(event){
        if(event.keyCode==13){
            var request=new XMLHttpRequest();
            request.open("POST","insertMessage.php",true);
            request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            request.setRequestHeader("X-Requested-With","XMLHttpRequest");
            request.onreadystatechange=function(){
                if(request.status==200 && request.responseText==4){
                    $("#messages").load("displayMessage.php");
                    document.getElementById("text").value="";
                }
            };
            request.send('text='+document.getElementById("text").value);
            document.getElementById("text").value="";
        }
    });
    setInterval(function(){
        $("#messages").load("displayMessage.php");
    },100);
    $("#messages").load("displayMessage.php");

</script>
</body>
</html>
