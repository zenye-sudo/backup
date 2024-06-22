
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
    .span{
        color:red;
        font-size:15px;
    }
        .alert{
            border:1px solid red;
        }
    </style>
</head>
<body>
<form action="check.php" method="POST" id="form">
    <label for="username">Username</label>
    <input type="text" id="username" name="username"><span id="uerrors" class="span"></span><br><br>
    <label for="email">Email</label>
    <input type="text" id="email" name="email"><span id="eerrors" class="span"></span><br><br>
    <label for="password">Password</label>
    <input type="password" id="password" name="password"><span id="perrors" class="span"></span><br><br>
    <label for="repassword">Retype-Password</label>
    <input type="password" id="repassword" name="repassword"><span id="rerrors" class="span"></span><br><br>
    <input type="submit" id="submit">
</form>
<script>
    var submit=document.getElementById("submit");
    //For Show Errors Start
    function showErrors(json){
        if(json[0].hasOwnProperty("uerrors")){
            document.getElementById("uerrors").innerHTML=json[0].uerrors;
        }
        if(json[2].hasOwnProperty("perrors")){
            document.getElementById("perrors").innerHTML=json[2].perrors;
        }
        if(json[3].hasOwnProperty("rerrors")){
            document.getElementById("rerrors").innerHTML=json[3].rerrors;
        }
        if(json[4].serrors.length==0){
            document.getElementById("eerrors").innerHTML=json[1].eerrors;
        }else{
            document.getElementById("eerrors").innerHTML=json[4].serrors;
        }
    }
    //For Show Errors End
    submit.addEventListener("click",function(event){
        event.preventDefault();
        var username=document.getElementById("username");
        var email=document.getElementById("email");
        var password=document.getElementById("password");
        var repassword=document.getElementById("repassword");
        var datas="username="+username.value+"&email="+email.value+"&password="+password.value+"&repassword="+repassword.value;
        var request=new XMLHttpRequest();
        request.open("POST","check.php",true);
        request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        request.setRequestHeader("X-Requested-With","XMLHttpRequest");
        request.onreadystatechange=function(){
          if(request.readyState==4 && request.status==200){
              var result=request.responseText;
              var json=JSON.parse(result);
              if(json.success==1){
                      username.value="";
                      email.value="";
                      password.value="";
                      repassword.value="";
                      window.location.href="posts.php";

              }else{
                  showErrors(json);
              }
              console.log(json);
          }
        };
        request.send(datas);
    });
</script>
</body>
</html>