<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #resultdiv{
            display:none;
        }
        .alert{
            border:1px solid red;
        }
        .spinner{
            display:none;
        }
    </style>
</head>
<body>
<div id="formdiv">
    <p>Calculate Your as you like volume</p>
    <form action="process_measurement.php" method="POST" id="form">
        <label for="length">Length:</label>
        <input type="text" name="length" id="length"><br><br>
        <label for="width">Width: </label>
        <input type="text" name="width" id="width"><br><br>
        <label for="height">Height:</label>
        <input type="text" name="height" id="height"><br><br>
        <input type="submit" value="html_submit" name="html_submit" id="html_submit">
    </form>
</div>
<div class="spinner" id="spinner">
    <img src="spinner.gif" alt="Loading..." width="34" height="34">
</div>
<div id="resultdiv">
    <p>The result of volume that given is <span id="volume"></span> </p>
</div>
<script>
    var formdiv=document.getElementById("formdiv");
    var form=document.getElementById("form");
    var resultdiv=document.getElementById("resultdiv");
    var volume=document.getElementById("volume");
    var ajax_submit=document.getElementById("html_submit");
    var action=form.getAttribute("action");

    var spinner=document.getElementById("spinner");
    function clearResult(){
        resultdiv.style.display="none";
        volume.innerHTML="";
    }
    function postResult(result){
        resultdiv.style.display="block";
        volume.innerHTML=result;
    }

    // var form_data="";
    function displayErrors(errors){
        var inputs=document.getElementsByTagName("input");
        for(var i=0;i<inputs.length;i++){
            var input=inputs[i];
            if(errors.indexOf(input.name)>=0){
                input.classList.add("alert");
            }
        }
    }
    function clearAlert(){
        var inputs=document.getElementsByTagName("input");
        for(var i=0;i<inputs.length;i++){
            inputs[i].classList.remove("alert");
        }
    }
    function ajaxReqeust(){
        clearResult();
        clearAlert();
        spinner.style.display="block";
        ajax_submit.disabled="True";
        var length=document.getElementById("length").value;
        var width=document.getElementById("width").value;
        var height=document.getElementById("height").value;
        var request=new XMLHttpRequest();
        request.open("POST",action,true);
        request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        request.setRequestHeader("X-Requested-With","XMLHttpRequest");
        request.onreadystatechange=function(){
            if( request.readyState==4  && request.status==200 ){
             var response=request.responseText;
             var json=JSON.parse(response);
             console.log(response);
             if(json.hasOwnProperty("error") && json.error.length>=0){
                 displayErrors(json.error);
                 spinner.style.display="none";
             }else{
                 spinner.style.display="none";
                 ajax_submit.disabled=false;
                 postResult(json.volume);
             }

            }
        };
        var form_data="length="+length+"&width="+width+"&height="+height;
        request.send(form_data);
        document.getElementById("length").value="";
        document.getElementById("width").value="";
        document.getElementById("height").value="";
    }

    ajax_submit.addEventListener("click",function(event){
        event.preventDefault();
        ajaxReqeust();
    });
</script>
</body>
</html>