<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #suggestion{
            padding:0;
            margin:0;
            width:300px;
            display:none;
        }
        #suggestion>li{
            list-style-type:none;
            line-height:40px;
            background-color:grey;
        }
        #suggestion>li>a{
            text-decoration: none;
            color:white;
        }
    </style>
</head>
<body>
<form action="search.php" method="get">
    <input type="text" name="keywords" id="keywords" autocomplete="off">
    <input type="submit" name="submit" id="submit">
</form>
<ul id="suggestion">
    <li><a href="#">Alpha</a></li>
    <li><a href="#">Alpha</a></li>
    <li><a href="#">Alpha</a></li>
    <li><a href="#">Alpha</a></li>
    <li><a href="#">Alpha</a></li>
</ul>
<script>
    var suggestion=document.getElementById("suggestion");
    var submit=document.getElementById("submit");
    var keywords=document.getElementById("keywords");
    function getSuggestion(json){
        var string="";
        for(var k in json){
          for(var k1 in json[k]){
              string+="<li><a href='search.php?keywords="+k1+"'>"+json[k][k1]+"</a></li>";
          }
        }
        return string;
    }
    function showSuggestion(json){
        suggestion.style.display="block";
        suggestion.innerHTML=getSuggestion(json);
    }
    keywords.addEventListener("input",function(){
       var request=new XMLHttpRequest();
       request.open("GET","autosuggest.php?keywords="+keywords.value,true);
       request.setRequestHeader("X-Requested-With","XMLHttpRequest");
       request.onreadystatechange=function(){
           if(request.readyState==4 && request.status==200){
               var result=request.responseText;
               var json=JSON.parse(result);
               showSuggestion(json);
               console.log(result);
           }
       }
       request.send();
    });
</script>
</body>
</html>