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
<h1 id="h1">This is original paragraph!</h1>
<input type="submit" value="change" id="submit">
<script>
    var btn=document.getElementById("submit");
    var h1=document.getElementById("h1");
    btn.addEventListener("click",function(){
        var request=new XMLHttpRequest();
        request.open("GET","new_contents.php",true);
        request.onreadystatechange=function(){
            if(request.readyState<4){
                h1.innerHTML="Loading...";
            }
            if(request.readyState==4 && request.status==200){
                var json=JSON.parse(request.responseText);
                h1.innerHTML=request.responseText;
            }
        };
        request.send();
    });
</script>
</body>
</html>