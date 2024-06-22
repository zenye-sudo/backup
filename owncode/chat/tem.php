<?php
session_start();
if(isset($_COOKIE['user']) ){
}else{
    header("location:index.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/fontawesome-free-5.0.11/fontawesome-free-5.0.11/web-fonts-with-css/css/fontawesome-all.css">
    <style>
    </style>
</head>
<body>
<!--FOr joining php and javascript start-->
<input type="text" id="sessionuser" value="<?php if($_COOKIE['userid']){echo $_COOKIE['userid']; }else{echo "other";} ?>" style="display:none;">
<!--FOr joining php and javascript ENd-->
<div class="card">
    <div class="card-header p-0" style="background-color: #7798ff;color:white;font-family:Cambria">
        <a href="homeChat.php" style="float:right;padding-right:14px;padding-top:10px;color:white;text-decoration:none">Home</a>
        <p class=" m-0" style="padding-left:14px;">Aung Myat Thu</p>
        <small class="m-0" style="padding-left:14px;">just now</small>
    </div>
    <div class="card-block" style="height:530px;overflow:auto" id="body">
        <div id="otheruser" style="'+fr+'">
            <span style="'+fr+'">
                <small class="text-muted" style="position:relative;bottom:3px;left:28px;">aung myat thu</small><br>
                <img src="user/pp/this.jpg" alt="" style="width:22px;height:22px;border-radius:10px;">
                <p style="display:inline;background-color:#6869ff;border-radius:14px;padding:8px;color:white;font-family:Cambria">Hello Good morning Friend</p>
            </span>
        </div>
    </div>
    <div class="card-footer p-0 position-static border-0" style="height:30px;overflow:hidden;">
        <div class="row">
            <textarea name="" class="col-9" rows="1" id="text"></textarea>
            <button class="btn-outline-primary" style="line-height:10px;text-align:center" id="msgbtn"><i class="fab fa-facebook-messenger"></i></button>
            <button class="btn-outline-primary" style="line-height:10px;text-align:center" id="imgbtn"><i class="fa fa-camera"></i></button>
            <button class="btn-outline-primary" style="line-height:10px;text-align:center" id="addbtn"><i class="fa fa-angle-double-down"></i></button>
        </div>
    </div>
</div>
<script src="../bootstrap/js/jquery-3.3.1.min.js"></script>
<script src="../bootstrap/js/popper.min.js"></script>
<script src="../bootstrap/script/tether.js"></script>
<script src="../bootstrap/script/bootstrap.min.js"></script>
</body>
</html>