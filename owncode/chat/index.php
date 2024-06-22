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
        *{
            font-family:Cambria;
        }
        #alertbar{
            display:none;
        }
        body{
            background-color: #dbd9e4;
        }
    </style>

</head>
<body>
<div class="container-fluid position-fixed" style='width:100%;height:100%;background-color:rgba(0,0,0,0.4);z-index: 1;display:none' id="loading">
    <div class="text-center" style="margin-top:200px;">
        <img src="img/loading.gif" alt="Loading..." style="padding:1px auto">
        <p style="color:white">Loading...</p>
    </div>
</div>
  <div class="container-fluid alert alert-warning alert-dismissible pr-2" id="alertbar" role="alert" style="position:fixed;z-index: 1">
  </div>
<div class="container pt-md-5 pt-4">
    <div class="row">
         <div id="login" class="col-md-5 ml-md-5 mr-md-5 mb-4" >
    <h3 style="border-bottom:2px solid blue;padding-bottom:14px">Login for Chat</h3>
    <form action="register.php" method="post">
          <div class="form-group">
              <label for="email">Email:</label>
              <div style="position:relative;float:right;top:40px;right:3px;display:none">
                  <i class="fa fa-check-circle text-success"></i>
              </div>
              <input type="email" name="email" id="email1" class="form-control input">
              <small class="form-text  text-danger" style="display:none;" id="email1error"></small>
          </div>
        <div class="form-group">
             <label for="password">Password:</label>
            <div style="position:relative;float:right;top:40px;right:3px;display:none">
                <i class="fa fa-check-circle text-success"></i>
            </div>
             <input type="password" name="email" id="password1" class="form-control input">
            <small class="form-text  text-danger" style="display:none;" id="password1error"></small>
        </div>
        <button class="btn btn-outline-primary" id="login0">Login</button>
        <span class="float-right mt-2"><a href="#" style="text-decoration:none">Forgot your password?</a></span>
    </form>
</div>
         <div id="register" class="col-md-5">
    <h3 style="border-bottom:2px solid blue;padding-bottom:14px">Register for Chat</h3>
    <form action="register.php" method="post">
        <div class="form-group">
          <label for="username">Username:</label>
            <div style="position:relative;float:right;top:40px;right:3px;display:none">
                <i class="fa fa-check-circle text-success"></i>
            </div>
          <input type="text" name="username" id="username" class="form-control input">
            <small class="form-text  text-danger" style="display:none;" id="usernameerror"></small>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
            <div style="position:relative;float:right;top:40px;right:3px;display:none">
                <i class="fa fa-check-circle text-success"></i>
            </div>
          <input type="text" name="email" id="email" class="form-control input">
            <small class="form-text  text-danger" style="display:none;" id="emailerror"></small>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
            <div style="position:relative;float:right;top:40px;right:3px;display:none">
                <i class="fa fa-check-circle text-success"></i>
            </div>
          <input type="password" name="password" id="password" class="form-control input">
            <small class="form-text  text-danger" style="display:none;" id="passworderror"></small>
        </div>
        <div class="form-group">
          <label for="repassword">Retype-Password:</label>
            <div style="position:relative;float:right;top:40px;right:3px;display:none">
                <i class="fa fa-check-circle text-success"></i>
            </div>
          <input type="password" name="repassword" id="repassword" class="form-control input">
            <small class="form-text  text-danger" style="display:none;" id="repassworderror"></small>
        </div>
        <button class="btn btn-outline-primary" id="register0">Register</button>
        <span class="float-right mt-2"><a href="#">Already have an account!</a></span>
    </form>
</div>
    </div>
</div>

<script src="../bootstrap/js/jquery-3.3.1.min.js"></script>
<script src="../bootstrap/js/popper.min.js"></script>
<script src="../bootstrap/script/tether.js"></script>
<script src="../bootstrap/script/bootstrap.min.js"></script>
<script>
    var input=document.getElementsByClassName("input");
    var registerbtn=document.getElementById("register0");
    var loginbtn=document.getElementById("login0");
    var alert=document.getElementById("alertbar");
    var loading=document.getElementById("loading");
    for(var i=0;i<input.length;i++){
        input[i].addEventListener("focusout",function(){
            var thi=this;
            var id=this.id;
            var value=this.value;
            if(id=="username"){
             if(/^[a-zA-Z0-9\_\s]+$/.test(value)){
                 thi.style.border="1px solid green";
                 thi.previousElementSibling.style.display="block";
                 document.getElementById("usernameerror").style.display="none";
             }else{
                 thi.style.border="1px solid red";
                 thi.previousElementSibling.style.display="none";
                 document.getElementById("usernameerror").style.display="block";
                 document.getElementById("usernameerror").innerHTML="Username must not contains special characters";
             }
            }else if(id=="email"){
                if(/^[a-zA-Z0-9\_]+@[a-zA-Z0-9]+\.[com|net|org]+$/.test(value)){
                    var request=new XMLHttpRequest();
                    request.open("GET","checkEmail.php?checkemail="+value,true);
                    request.setRequestHeader("X-Requested-With","XMLHttpRequest");
                    request.onreadystatechange=function(){
                        if(request.readyState==4 && request.status==200){
                            if(request.responseText=="Email is already exits"){
                                thi.style.border="1px solid red";
                                thi.previousElementSibling.style.display="none";
                                document.getElementById("emailerror").style.display="block";
                                document.getElementById("emailerror").innerHTML="Email is already exits!";
                            }
                        }
                    };
                    request.send();
                    thi.style.border="1px solid green";
                    thi.previousElementSibling.style.display="block";
                    document.getElementById("emailerror").style.display="none";
                }else{
                    thi.style.border="1px solid red";
                    thi.previousElementSibling.style.display="none";
                    document.getElementById("emailerror").style.display="block";
                    document.getElementById("emailerror").innerHTML="Invaild Email!";
                }
            }else if(id=="password"){
                if(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9]).+$/.test(value)){
                    thi.style.border="1px solid green";
                    thi.previousElementSibling.style.display="block";
                    document.getElementById("passworderror").style.display="none";
                }else{
                    thi.style.border="1px solid red";
                    thi.previousElementSibling.style.display="none";
                    document.getElementById("passworderror").style.display="block";
                    document.getElementById("passworderror").innerHTML="Password must be contains a lowercase,uppercase,number and special characters at leaset!";
                }
            }else if(id=="repassword"){
                var passwordvalue=document.getElementById("password").value;
                if(value==""){
                    value="replace";
                }else{
                    value=value;
                }
                if(passwordvalue==value){
                    thi.style.border="1px solid green";
                    thi.previousElementSibling.style.display="block";
                    document.getElementById("repassworderror").style.display="none";
                }else{
                    thi.style.border="1px solid red";
                    thi.previousElementSibling.style.display="none";
                    document.getElementById("repassworderror").style.display="block";
                    document.getElementById("repassworderror").innerHTML="Passwords are not match!";
                }
            }else if(id=="email1"){
                if(/^[a-zA-Z0-9\_]+@[a-zA-Z0-9]+\.[com|net|org]+$/.test(value)){
                    thi.style.border="1px solid green";
                    thi.previousElementSibling.style.display="block";
                    document.getElementById("email1error").style.display="none";
                }else{
                    thi.style.border="1px solid red";
                    thi.previousElementSibling.style.display="none";
                    document.getElementById("email1error").style.display="block";
                    document.getElementById("email1error").innerHTML="Invaild Email!";
                }
            }else if(id=="password1"){
                if(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9]).+$/.test(value)){
                    thi.style.border="1px solid green";
                    thi.previousElementSibling.style.display="block";
                    document.getElementById("password1error").style.display="none";
                }else{
                    thi.style.border="1px solid red";
                    thi.previousElementSibling.style.display="none";
                    document.getElementById("password1error").style.display="block";
                    document.getElementById("password1error").innerHTML="Password must be contains a lowercase,uppercase,number and special characters at leaset!";
                }
            }
        });
    }
    registerbtn.onclick=function(event){
        event.preventDefault();
        var username0=document.getElementById("username").value;
        var email0=document.getElementById("email").value;
        var password0=document.getElementById("password").value;
        var repassword0=document.getElementById("repassword").value;
        var request=new XMLHttpRequest();
        loading.style.display="block";
        request.open("POST","register.php",true);
        request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        request.setRequestHeader("X-Requested-With","XMLHttpRequest");
        request.onreadystatechange=function(){
            if(request.readyState==4 && request.status==200){
                loading.style.display="none";
                var result=request.responseText;
                console.log(result);
                var json=JSON.parse(result);
                if(json.success==1){
                    document.getElementById("email1").value=email0;
                    document.getElementById("password1").value=password0;
                    alert.innerHTML="Registration Success!Now Click Login<span class=\"float-right\" data-dismiss=\"alert\" style=\"cursor:pointer;font-size:19px;\" id=\"alert1\">X</span>\n";
                    alert.classList.remove("alert-warning");
                    alert.classList.add("alert-success");
                    alert.style.display="block";
                }else{
                    if(json.username.length==1){
                        document.getElementById("usernameerror").previousElementSibling.style.border="1px solid red";
                        document.getElementById("usernameerror").style.display="block";
                        document.getElementById("usernameerror").innerHTML=json.username;
                    }
                    if(json.email.length==1){
                        document.getElementById("emailerror").previousElementSibling.style.border="1px solid red";
                        document.getElementById("emailerror").style.display="block";
                        document.getElementById("emailerror").innerHTML=json.email;
                    }
                    if(json.password.length==1){
                        document.getElementById("passworderror").previousElementSibling.style.border="1px solid red";
                        document.getElementById("passworderror").style.display="block";
                        document.getElementById("passworderror").innerHTML=json.password;
                    }
                    if(json.repassword.length==1){
                        document.getElementById("repassworderror").previousElementSibling.style.border="1px solid red";
                        document.getElementById("repassworderror").style.display="block";
                        document.getElementById("repassworderror").innerHTML=json.repassword;
                    }
                }
            }
        };
        request.send("username="+username0+"&email="+email0+"&password="+password0+"&repassword="+repassword0);
    };
    loginbtn.onclick=function(event){
    event.preventDefault();
        var request=new XMLHttpRequest();
        var email1=document.getElementById("email1");
        var password1=document.getElementById("password1");
        loading.style.display="block";
        request.open("POST","login.php",true);
        request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        request.setRequestHeader("X-Requested-With","XMLHttpRequest");
        request.onreadystatechange=function(){
            if(request.readyState==4 && request.status==200){
                loading.style.display="none";
                var result=request.responseText;
                var json=JSON.parse(result);
                if(json.status==1 || json.status==0){
                   if(json.status==1){
                       window.location.href="homeChat.php";
                   }else{
                       alert.innerHTML="Incorrect email or password!<span class=\"float-right\" data-dismiss=\"alert\" style=\"cursor:pointer;font-size:19px;\" id=\"alert1\">X</span>\n";
                       alert.style.display="block";
                   }
                }else{
                   if(json.email.length==1){
                       document.getElementById("email1error").previousElementSibling.style.border="1px solid red";
                       document.getElementById("email1error").style.display="block";
                       document.getElementById("email1error").innerHTML=json.email;
                   }
                    if(json.password.length==1){
                        document.getElementById("password1error").previousElementSibling.style.border="1px solid red";
                        document.getElementById("password1error").style.display="block";
                        document.getElementById("password1error").innerHTML=json.password;
                    }
                }
            }
        };
        request.send("emaillogin="+email1.value+"&passwordlogin="+password1.value);
    }
</script>
</body>
</html>