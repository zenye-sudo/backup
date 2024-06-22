<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/fontawesome-free-5.0.11/fontawesome-free-5.0.11/web-fonts-with-css/css/fontawesome-all.css">
</head>
<body class="bg-success">
<?php
require_once "include/session.php";
require_once "include/dbconnect.php";
require_once "include/navbar.php";
?>
<?php
$alert="";
if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $repassword=$_POST['repassword'];
    $country=$_POST['country'];
    $auto=new FormInsert($username,$email,$password,$repassword,$country);
    $alert=$auto->__construct($username,$email,$password,$repassword,$country);
    switch ($alert){
        case "Registration Successful!":
            $session=new MySession("username",$username,"email",$email);
            header("location:index.php");
            $auto->InsertForm("$username","$email","$password","$country");
            break;
    }
    echo '<div class="alert alert-warning container" id="hide">'.$alert.'<span class="float-right"><a href="" data-dimiss="#hide">X</a></span></div>';

}
?>
<!--Register Form Start-->
<div class="container col-md-6 mt-lg-5 mb-lg-5">

    <div class="container card border-0 pb-lg-2 pb-4">
        <div class=" card-header bg-dark">
            <h4 class="text-white">Register For More Features</h4>
        </div>

        <div class="card-block mr-lg-4 ">
            <form action="<?php $_PHP_SELF ?>" method="post" class=" ml-lg-5">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" placeholder="Username" id="username" class="form-control">
                    <small class="form-text text-muted">username must be contain special character</small>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="password" id="password" class="form-control">
                    <small class="form-text text-muted">password must be contain lowercase,uppercase,number and special charcters.</small>
                </div>
                <div class="form-group">
                    <label for="repassword">Retype-Password</label>
                    <input type="password" name="repassword" placeholder="Retype Password" id="repassword" class="form-control">
                </div>
                <div class="form-group">
                    <label for="country">Select your country</label>
                    <select name="country"  id="country" class="form-control">
                        <option value="1">Myanmar</option>
                        <option value="2">USA</option>
                        <option value="3">Japan</option>
                        <option value="4">Korea</option>
                    </select>
                </div>
                <span><a href="login.php">Already have an account?</a></span>
                <button name="submit" class="btn btn-outline-primary float-right">Login</button>
            </form>
        </div>
    </div>
</div>
<!--Register Form End-->
<?php
require_once "include/footer.php";
?>
<script src="bootstrap/script/jquery-3.3.1.min.js"></script>
<script src="bootstrap/script/jquery-3.3.1.slim.min.js"></script>
<script src="bootstrap/script/popper.min.js"></script>
<script src="bootstrap/script/tether.js"></script>
<script src="bootstrap/script/bootstrap.min.js"></script>
</body>
</html>