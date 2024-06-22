<?php
 session_start();
 include_once ("sysgen/membershipcheck.php");
 include_once("sysgen/mySession.php");

$alert="";
 if(isset($_POST['submit'])){

     $username=$_POST['username'];
     $email=$_POST['email'];
     $password=$_POST['password'];
     $retype_password=$_POST['retype-password'];

     $ret=membershipcheck($username,$email,$password,$retype_password);
     switch($ret){
         case "Javascript checker Fail!":
             $alert="Authentication Fail!";
             break;
         case "Email is already in use!":
             $alert="Email is already in use!";
             break;
         case "Register Success":
             $alert="Registration Success!";
             setSession("username",$username);
             setSession("email",$email);
             if(getSession("username")==="zenye123" && $email=="futurenetzenye@gmail.com"){
                 header("location:admin.php");
             }else{
                 header("location:index.php");
             }
             break;
         case "Register Fail!":
             $alert="Registration Fail!";
             break;
         default;
             echo "I don't know";
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
            margin-top:25px;
            margin-left:200px;
            padding-top:50px;
            /*padding:50px;*/
            padding-left:50px;
            padding-right:50px;
            padding-bottom:50px;
            margin-bottom:20px;
            border-radius:3px;
        }
        #email,#password,#username,#retypepassword{
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
        #used{
            text-decoration:none;
            font-size:20px;
            display:inline-block;
            margin-top:20px;
            color:black;
        }
        #used:hover{
            color:blue;
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

<!--Register Page Start-->
<div id="login" style="overflow:auto">
    <?php

    if(strlen($alert)>0){
        echo "<div id=\"alertbar\" style=\"position:absolute;transition:all 2s;top:-4px;left:0;display:block;width:100%;height:50px;background:#ffc16b;opacity:0.4;border-radius:7px;\">
        <a href=\"#\" id=\"alert\" style=\"text-decoration:none;font-family:Cambira;position:relative;font-size:23px;float:right;right:7px;bottom:2px;\">X</a>
        <h3 style='padding-left:20px;padding-top:12px;font-size:22px;color:red'>$alert</h3>
    </div>";
    }
    ?>
    <h1 style="font-family:Cambria;text-align:center;color:darkred">Register To Be A Member!</h1><BR>
    <form action="<?php $_PHP_SELF ?>" method="POST">
        <label for="username" style="font-size:20px;">Username</label><br>
        <input style="font-size:20px;" type="text" name="username" id="username"><br><br>
        <label for="email" style="font-size:20px;">Email</label><br>
        <input style="font-size:20px;" type="email" name="email" id="email"><br><br>
        <label for="password" style="font-size:20px;">Password</label><br>
        <input style="font-size:20px;" type="password" name="password" id="password"><br><br>
        <label for="username" style="font-size:20px;">Retype-Password</label><br>
        <input style="font-size:20px;" type="password" name="retype-password" id="retypepassword"><br><br>
        <a href="login.php" id="used">Already have an account!</a>
        <input type="submit" name="submit" value="Register" id="submit">
    </form>
</div>
<!--Register Page End-->
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
<script type="text/javascript">
    var alertbtn=document.querySelector("#alert");
    var alertbar=document.querySelector("#alertbar");
    var username=document.querySelector("#username");
    console.log(alertbtn);
    alertbtn.onclick=function(){
        alertbar.style.display="none";
    };
</script>
</body>
</html>