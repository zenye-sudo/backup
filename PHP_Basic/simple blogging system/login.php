<?php
session_start();
include_once ("sysgen/mySession.php");
include_once ("sysgen/membershipcheck.php");
$message="";
if(isset($_POST['submit'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $message=loginCheck($email,$password);
    if($message=="Login Fail!"){
        $message= "Login Fail!";
    }else if($message=="javascript checker fail!"){
        $message= "Authentication Fail!";
    }else{
        setSession("username",$message);
        setSession("email",$email);
        if(getSession("username")==="zenye123" && $email=="futurenetzenye@gmail.com"){
            header("location:admin.php");
        }else{
        header("location:index.php");
        }
    }
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
    <link rel="stylesheet" href="css/style.css">
    <style>
        #login{
            /*width:60%;*/
            border:1px solid black;
            margin-top:20px;
            margin-left:200px;
            padding:50px;
            margin-bottom:20px;
            border-radius:3px;
        }
        #email,#password{
            width:500px;
            height:30px;
            border:1px solid black;
            border-radius:3px;
            font-family:Cambria;
        }
        #submit{
            width:80px;
            height:40px;
            border:0;
            border-radius:5px;
            font-size:20px;
            color:white;
            background: #5487ff;
            float:right;
            margin-top:20px;
        }
        #lost{
            text-decoration:none;
            color:black;
            margin-top:20px;
            font-size:20px;
            display:inline-block;
        }
        #lost:hover{
            color:dodgerblue;
        }
    </style>
</head>
<body>
<!--Navigation Start-->
<div class="navcontainer">
    <nav>
        <img src=".\photos\download.png"  width="100px" height="75px">
        <ul id="ul">
            <li class="li"><a href="index.php">HOME</a></li>
            <li class="li"><a href="filternews.php?pid=1">POLITIC</a></li>
            <li class="li"><a href="filternews.php?pid=2">WARS</a></li>
            <li class="li"><a href="filternews.php?pid=3">IT NEWS</a></li>
            <li class="li"><a href="filternews.php?pid=4">SOCIAL</a></li>
            <li class="li" id="special"><a href="#">

                    <?php
                    if(checkSession("username")){
                        echo getSession("username");
                    }else{
                        echo "MEMBER";
                    }
                    ?>



                </a>
                <ul id="ul2">
                    <?php
                    if(checkSession("username")){
                        echo  "<li><a href=\"logout.php\">Logout</a></li>";
                    }else{
                        echo "<li><a href=\"login.php\">Login</a></li>
                    <li><a href=\"register.php\">Register</a></li>";
                    }
                    ?>
                </ul>
            </li>
        </ul>
    </nav>
</div>
<!--Navigation End-->
<!--Login Page Start-->
<div id="login" style="overflow:auto">
    <?php
    if(strlen($message)>0){
        echo "<div id='alertbar' style=\"position:absolute;transition:all 2s;top:-4px;left:0;display:block;width:100%;height:50px;background:#ffc16b;opacity:0.4;border-radius:7px;\">
        <a href=\"#\" id=\"alert\" style=\"text-decoration:none;font-family:Cambira;position:relative;font-size:23px;float:right;right:7px;bottom:2px;\">X</a>
        <h3 style='padding-left:20px;padding-top:12px;font-size:22px;color:red'>$message</h3>
    </div>";
    }
    ?>
    <h1 style="font-family:Cambria;text-align:center;color:red">Login To Get Special News!</h1><BR>
    <form action="<?php $_PHP_SELF ?>" method="POST">
        <label for="email" style="font-size:20px;">Email</label><br>
        <input style="font-size:20px;" type="email" name="email" id="email"><br><br>
        <label for="password" style="font-size:20px;">Password</label><br>
        <input style="font-size:20px;" type="password" name="password" id="password"><br>
        <a href="#" id="lost">Lost your password?</a>
        <input type="submit" name="submit" value="Login" id="submit">
    </form>
</div>
<!--Login Page End-->
<!--Footer Start-->
<div class="footer">
    <div class="first">
        <nav>
            <ul>
                <li><a href="#">HOME</a></li>
                <li><a href="#">NEWS</a></li>
                <li><a href="#">PRODUCTS</a></li>
                <li><a href="#">ABOUT</a></li>
            </ul>
        </nav>
    </div>

    <div class="second">
        <nav>
            <ul>
                <li><h2>Contact Imformation(TechCoder Myanmar)</h2>
                </li>
                <li><a href="#">-Thaedaw</a></li>
                <li><a href="#">-Myat Phone Shin Main Road,13</a></li>
                <li><a href="#">-Yangon</a></li>
                <li><a href="#">-Shwe Taung Kyar </a></li>
                <li><a href="#">-09-969313141,09-769458185</a></li>
            </ul>
        </nav>
    </div>

</div>
<!--Footer End-->
<script>
    var alert=document.querySelector("#alertbar");
    console.log(alert);
</script>
</body>
</html>