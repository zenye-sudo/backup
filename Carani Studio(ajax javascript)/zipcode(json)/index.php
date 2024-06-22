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
<h1>Enter Your zipcode(US)</h1>
<input type="text" name="zipcode" id="zipcode">
<input type="submit" value="Get information" id="btm">
<div id="response">
<h1 id="info"></h1>
</div>
<script>
    var btn=document.getElementById("btm");
    var zipcode=document.getElementById("zipcode");
    var info=document.getElementById("info");

    btn.addEventListener("click",function(){
        var test="/^\d+$/";
        if(zipcode.value!=""){
            findLocation();
            zipcode.value="";
        }else{
            return false;
            zipcode.value="";
        }
    });
    function findLocation(){
        var url="http://maps.googleapis.com/maps/api/geocode/json?address="+zipcode.value;
        var request=new XMLHttpRequest();
        request.open("GET",url,true);
        request.onreadystatechange=function(){
            if(request.readyState<4){
                tem();
            }
            if(request.readyState==4 && request.status==200){
                var js=JSON.parse(request.responseText);
                console.log(request.responseText);
                info.innerHTML=js.results[0].formatted_address;
            }
            if(request.status==0){
                info.innerHTML="Valid Zipcode!";
            }
        }
        request.send();
    }
    function tem(){
        info.innerHTML="Loading....";
    }
</script>
</body>
</html>