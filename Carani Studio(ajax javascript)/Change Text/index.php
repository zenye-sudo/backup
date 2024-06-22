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
<p id="p">This is a original paragraph!</p>
<input type="submit" id="submit" value="change">
<script>
<script>
    var p=document.getElementById("p");
    var btn=document.getElementById("submit");
    btn.addEventListener("click",function(){
        var request=new XMLHttpRequest();
        request.open("GET","test.txt",true);
        request.onreadystatechange=function(){
          if(request.readyState==2){
              p.innerHTML="Loading.....";
          }
          if(request.readyState==4){
              p.innerHTML=request.responseText;
          }
        };
        request.send();
    })
</script>
</body>
</html>