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
<body>
<?php
require_once "include/session.php";
require_once "include/navbar.php";
?>

<?php
function login($email,$password){
    $password=md5($password);
    $password=sha1($password);
    $password=crypt($password,$password);
    $db=new PDO("mysql:host=localhost;dbname=techcoder","root","");
    $result=$db->prepare("SELECT * FROM users WHERE email='$email' AND password='$password'");
    $result->execute();
    $result->setFetchMode(PDO::FETCH_ASSOC);
    if($result->fetchColumn()!=NULL){
        return "Login Successful!";
    }else{
        return "Login Fail!";
    }
}
if(isset($_POST['submit'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $result=login($email,$password);
    $alert="";
    switch ($result){
        case "Login Successful!":
            $result=$db->prepare("SELECT name FROM users WHERE email='$email'");
            $result->execute();
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $session=new MySession("username",$result->fetchColumn(),"email",$email);
            header("location:index.php");
            break;
        case "Login Fail!":
            $alert="Login Fail!";
            break;
    }
    echo '<div class="alert alert-warning container" id="hide">'.$alert.'<span class="float-right"><a href="" data-dimiss="#hide">X</a></span></div>';
}
?>
<!--Login Form Start-->
<div class="container col-md-6 mt-lg-5 mb-lg-5">

 <div class="container card border-0 pb-lg-5 pb-4 pt-lg-4">
     <div class=" card-header bg-dark">
         <h4 class="text-white">Login For More Features</h4>
     </div>

   <div class="card-block mr-lg-4 ">
       <form action="<?php $_PHP_SELF ?>" method="post" class=" ml-lg-5">
           <div class="form-group">
               <label for="email">Email</label>
               <input type="text" name="email" placeholder="Email" id="email" class="form-control">
           </div>
           <div class="form-group">
               <label for="password">Password</label>
               <input type="password" name="password" placeholder="password" id="password" class="form-control">
           </div>
           <span><a href="register.php">Forgot your password?</a></span>
           <button class="btn btn-outline-primary float-right" name="submit">Login</button>
       </form>
   </div>
 </div>
</div>
<!--Login Form End-->
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