<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="index.php" method="POST">
    <label for="username">Username</label>
    <input type="text" name="username" id="username" class="input"><br><br>
    <label for="email">Email</label>
    <input type="text" name="email" id="email" class="input"><span id="emailerror"></span><br><br>
    <label for="password">Password</label>
    <input type="text" name="password" id="password" class="input"><br><br>
    <label for="repassword">Retype-Password</label>
    <input type="text" name="repassword" id="repassword" class="input"><br><br>
    <input type="submit" name="submit" value="submit" id="submit">
</form>
<script>
var input=document.getElementsByClassName("input");
for(var i=0;i<input.length;i++){
     input[i].addEventListener("focusout",function(){
        var test=this.id;
        var thi=this;
        var value=this.value;
        if(test=="username"){
            if(/^[a-zA-Z0-9]+$/.test(value)){
                thi.style.border="2px solid green";
            }else{
                thi.style.border="2px solid red";
            }
        }else if(test=="email"){
            if(/^[a-zA-Z0-9\.\_]+@[a-zA-Z0-9]+.[com|net|org]+$/.test(value)){
                var request=new XMLHttpRequest();
                request.open("GET","check.php?value="+value,true);
                request.setRequestHeader("X-Requested-With","XMLHttpRequest");
                request.onreadystatechange=function(){
                    if(request.readyState==4 && request.status==200){
                        var result=request.responseText;
                        if(result=="Email is already Exits."){
                            document.getElementById("emailerror").innerHTML=result;
                            thi.style.border="2px solid red";
                        }else{
                            document.getElementById("emailerror").innerHTML="";
                            thi.style.border="2px solid green";
                        }

                    }

                };
                request.send();
                thi.style.border="2px solid green";
            }else{
                thi.style.border="2px solid red";
            }
        }else if(test=="password"){
            if(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9]).+$/.test(value)){
                thi.style.border="2px solid green";
            }else{
                thi.style.border="2px solid red";
            }
        }else if(test=="repassword"){
            var passwordvalue=document.getElementById("password").value;
            if(value==""){
                value="replace";
            }else{
                value=value;
            }
            if(value==passwordvalue){
            thi.style.border="2px solid green";
        }else{
            thi.style.border="2px solid red";
        }
        }
     });
}
</script>
</body>
</html>