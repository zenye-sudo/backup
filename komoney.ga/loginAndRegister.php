<?php
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
}
if(!is_ajax_request()){exit;};
require_once "connection.php";
?>
<div id="loginAndRegister">
    <div class="container position-absolute col-11 alert alert-warning alert-dismissible pr-3 mr-5 pt-1" id="alertbar" role="alert" style="z-index: 1;display: none;border-top-left-radius: 0;border-top-right-radius: 0;">
        Incorrect email or password!<span class="float-right" data-dismiss="alert" style="cursor:pointer;font-size:19px;" id="alert1">X</span>
    </div>
    <!--<div class="container pt-md-3 pt-2 pb-3 betDiv" style="background-color:#dbd9e4;color:black;">-->
    <div class="container pt-md-3 pt-2 pb-3 betDiv bg-dark" style="">
        <div class="row">
            <div id="login" class="col-md-5 ml-md-5 mr-md-5 mb-4" >
                <h3 style="border-bottom:2px solid blue;padding-bottom:14px">အေကာင့္၀င္ရန္</h3>
                <form action="register.php" method="post">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <div style="position:relative;float:right;top:40px;right:3px;display:none">
                            <i class="fa fa-check-circle text-success"></i>
                        </div>
                        <input type="email" name="email" id="email1" class="form-control input" placeholder="Email ထည့္ပါ။">
                        <small class="form-text  text-danger" style="display:none;" id="email1error"></small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <div style="position:relative;float:right;top:40px;right:3px;display:none">
                            <i class="fa fa-check-circle text-success"></i>
                        </div>
                        <input type="password" name="email" id="password1" class="form-control input" placeholder="Password ထည့္ပါ။">
                        <small class="form-text  text-danger" style="display:none;" id="password1error"></small>
                    </div>
                    <button class="btn btn-outline-primary" id="login0">Login</button>
                    <span class="float-right mt-2"><a href="#" style="text-decoration:none;font-size:15px;">Forgot your password?</a></span>
                </form>
            </div>
            <div id="register" class="col-md-5">
                <h3 style="border-bottom:2px solid blue;padding-bottom:14px">အေကာင့္သစ္ျပဳလုပ္ရန္</h3>
                <form action="register.php" method="post">
                    <div class="form-group">
                        <label for="username">Name: <small class="text-primary">  "ex=>Zaw Zaw"</small></label>
                        <div style="position:relative;float:right;top:40px;right:3px;display:none">
                            <i class="fa fa-check-circle text-success"></i>
                        </div>
                        <input type="text" name="username" id="username0" class="form-control input" placeholder="နာမည္ထည့္ပါ(Englishလို)">
                        <small class="form-text  text-danger" style="display:none;" id="usernameerror"></small>
                    </div>
                    <div class="form-group">
                        <label for="email">Email: <small class="text-primary">  "ex=>zawzaw@gmail.com"</small></label>
                        <div style="position:relative;float:right;top:40px;right:3px;display:none">
                            <i class="fa fa-check-circle text-success"></i>
                        </div>
                        <input type="text" name="email" id="email" class="form-control input" placeholder="Email ထည့္ပါ။">
                        <small class="form-text  text-danger" style="display:none;" id="emailerror"></small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password: <small class="text-primary">  "ex=>1234"</small></label>
                        <div style="position:relative;float:right;top:40px;right:3px;display:none">
                            <i class="fa fa-check-circle text-success"></i>
                        </div>
                        <input type="password" name="password" id="password" class="form-control input" placeholder="Password ထည့္ပါ။">
                        <small class="form-text  text-danger" style="display:none;" id="passworderror"></small>
                    </div>
                    <div class="form-group">
                        <label for="repassword">Retype-Password: <small class="text-primary">  "ex=>1234"</small></label>
                        <div style="position:relative;float:right;top:40px;right:3px;display:none">
                            <i class="fa fa-check-circle text-success"></i>
                        </div>
                        <input type="password" name="repassword" id="repassword" class="form-control input" placeholder="အေပၚမွာေရးထားတဲ့ Password ျပန္ထည့္ပါ။">
                        <small class="form-text  text-danger" style="display:none;" id="repassworderror"></small>
                    </div>
                    <button class="btn btn-outline-primary" id="register0">Register</button>
                    <span class="float-right mt-2"><a href="#" style="font-size:15px;">Already have an account!</a></span>
                </form>
            </div>
        </div>
    </div>
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
                if(id=="username0"){
                    if(/^[a-zA-Z0-9\_\s]+$/.test(value) && value.length>1){
                        thi.style.border="1px solid green";
                        thi.previousElementSibling.style.display="block";
                        document.getElementById("usernameerror").style.display="none";
                    }else if(value.length<3){
                        thi.style.border="1px solid red";
                        thi.previousElementSibling.style.display="none";
                        document.getElementById("usernameerror").style.display="block";
                        document.getElementById("usernameerror").innerHTML="အနည္းဆံုးစာလံုးေရ၂လံုးပါရမည္!";
                    }else{
                        thi.style.border="1px solid red";
                        thi.previousElementSibling.style.display="none";
                        document.getElementById("usernameerror").style.display="block";
                        document.getElementById("usernameerror").innerHTML="Special Charactersပါလို့မရပါ!";
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
                                    document.getElementById("emailerror").innerHTML="Email ကသံုးျပီးသားျဖစ္ေနတယ္!";
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
                        document.getElementById("emailerror").innerHTML="Email မမွန္ကန္ပါ!";
                    }
                }else if(id=="password"){
                    if(/^[a-zA-Z0-9\_\!\@\#\$\%\^\&\*]+$/.test(value) && value.length>3){
                    // if(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9]).+$/.test(value)){
                        thi.style.border="1px solid green";
                        thi.previousElementSibling.style.display="block";
                        document.getElementById("passworderror").style.display="none";
                    }else{
                        thi.style.border="1px solid red";
                        thi.previousElementSibling.style.display="none";
                        document.getElementById("passworderror").style.display="block";
                        // document.getElementById("passworderror").innerHTML="Password must be contains a lowercase,uppercase,number and special characters at leaset!";
                       document.getElementById("passworderror").innerHTML="အနည္းဆံုးစာလံုးေရ4လံုးပါရမည္!";
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
                        document.getElementById("repassworderror").innerHTML="အေပၚက Passwordနွင့္မတူညီပါ!";
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
                        document.getElementById("email1error").innerHTML="Email မမွန္ကန္ပါ!";
                    }
                }else if(id=="password1"){
                    // if(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9]).+$/.test(value)){
                    if(/^[a-zA-Z0-9\_\!\@\#\$\%\^\&\*]+$/.test(value) && value.length>3){
                        thi.style.border="1px solid green";
                        thi.previousElementSibling.style.display="block";
                        document.getElementById("password1error").style.display="none";
                    }else{
                        thi.style.border="1px solid red";
                        thi.previousElementSibling.style.display="none";
                        document.getElementById("password1error").style.display="block";
                        // document.getElementById("password1error").innerHTML="Password must be contains a lowercase,uppercase,number and special characters at leaset!";
                       document.getElementById("passworderror").innerHTML="အနည္းဆံုးစာလံုးေရ4လံုးပါရမည္!";
                    }
                }
            });
        }
        registerbtn.onclick=function(event){
            event.preventDefault();
            var username0=document.getElementById("username0").value;
            var email0=document.getElementById("email").value;
            var password0=document.getElementById("password").value;
            var repassword0=document.getElementById("repassword").value;
            var request=new XMLHttpRequest();
            $("#loadingForBet").css('display', 'block');
            request.open("POST","register.php",true);
            request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            request.setRequestHeader("X-Requested-With","XMLHttpRequest");
            request.onreadystatechange=function(){
                if(request.readyState==4 && request.status==200){
                    $("#loadingForBet").css('display', 'none');
                    var result=request.responseText;
                    var json=JSON.parse(result);
                    if(json.success==1){
                        $.get({
                            url: "vac.php",
                            type: "GET",
                            beforeSend: function () {
                                $("#loadingForBet").css('display', 'block');
                            },
                            success: function (data) {
                                $("#loadingForBet").css('display', 'none');
                                $("#howtoplay").css('display', 'none');
                                $("#loginAndRegister").css('display', 'none');
                                $("#home").css('display', 'none');
                                $("#dowloadApk").hide();
                                $(".vacUsername").text(username0);
                                $(".memberBtn").show();
                                $(".notMemberBtn").hide();
                                $(".forMemberSetting").show();
                                $(".forMember").css('display', 'block');
                                $(".vacBalance").html("100000.00");
                                $(".racbalance").html("0.00");
                                $(".forMember").show();
                                $(".forChange").append(data);
                                                            window.location.href="index.php?status=24KSDJFLKuisdfkjdsl234KJDFLKSSF@#%#%45DFGSLKDFSF;GDF8f*Aksdfk";
                            }
                        });
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
            $("#loadingForBet").show();
            request.open("POST","login.php",true);
            request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            request.setRequestHeader("X-Requested-With","XMLHttpRequest");
            request.onreadystatechange=function(){
                if(request.readyState==4 && request.status==200){
                    $("#loadingForBet").hide();
                    var result=request.responseText;
                    var json=JSON.parse(result);
                    // console.log(json);
                    if(json.status==1 || json.status==0){
                        if(json.status==1){
                            $.get({
                                url: "vac.php",
                                type: "GET",
                                beforeSend: function () {
                                    $("#loadingForBet").css('display', 'block');
                                },
                                success: function (data) {
                                    $("#loadingForBet").css('display', 'none');
                                    $("#howtoplay").css('display', 'none');
                                    $("#loginAndRegister").css('display', 'none');
                                    $("#home").css('display', 'none');
                                    $("#dowloadApk").hide();
                                    $(".vacUsername").text(json.username);
                                    $(".memberBtn").show();
                                    $(".notMemberBtn").hide();
                                    $(".forMemberSetting").show();
                                    $(".forMember").css('display', 'block');
                                    $(".balance").html(json.balance);
                                    $(".forMember").show();
                                    $(".forChange").append(data);
                                }
                            });
                            window.location.href="index.php?status=24KSDJFLKuisdfkjdsl234KJDFLKSSF@#%#%45DFGSLKDFSF;GDF8f*Aksdfk";

                        }else{
                            alert.innerHTML="Incorrect email or password!<span class=\"float-right\" data-dismiss=\"alert\" style=\"cursor:pointer;font-size:19px;\" id=\"alert1\">X</span>\n";
                            alert.style.display="block";
                        }
                    }else if(json.special==1){
                        window.location.href="admin/admin.php";
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
        };
    </script>
</div>