<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #container{
            width:400px;
            border:1px dotted black;
            margin:100px auto;
        }
        #header{
            text-align:center;
        }
        #section{
            max-height:150px;
            overflow:auto;
            margin-left:110px;
        }
        #section>ul{
            list-style-type:none;
            padding:0;
            margin:0;
        }
        #section>ul>li{
            line-height:35px;
        }
        #footer{
            margin-top:20px;
            margin-bottom:10px;
            text-align:center;
        }
        .smaller{
            font-size:13px;
            text-decoration:line-through;
        }
    </style>
</head>
<body>
<div id="container">
    <div id="header"><h1>ToDo List Application</h1></div>
    <div id="section">
        <ul id="ul">
        </ul>
    </div>
    <div id="footer">
        <form action="index.php" method="GET">
            <input type="text" name="name" id="name" autocomplete="off">
            <input type="submit" id="submit">
        </form>
    </div>
</div>
<script>
    var ul=document.getElementById("ul");
    var btn=document.getElementById("submit");
    var text=document.getElementById("name");
    //For Broswer Reload Start
    function get(json){
        var test="";
        for(var k in json){
            var test1="";
            if(json[k][2]==0){
                test1="smaller";
                test+="<li class='"+test1+" input'><input type='checkbox' data-id='"+json[k][0]+"' checked>"+json[k][1]+"</li>";
            }else{
                test1="";
                test+="<li class='"+test1+" input'><input type='checkbox' data-id='"+json[k][0]+"' >"+json[k][1]+"</li>";
            }
        }
        return test;
    }
    function show(json){
        ul.innerHTML=get(json);
    }
    function reload(){
        var request=new XMLHttpRequest();
        request.open("GET","reload",true);
        request.setRequestHeader("X-Requested-With","XMLHttpRequest");
        request.onreadystatechange=function(){
          if(request.readyState==4 && request.status==200){
              var result=request.responseText;
              var json=JSON.parse(result);
              show(json);
              //For update datas Start
              var checkbox=document.getElementsByClassName("input");
              for(var i=0;i<checkbox.length;i++){
                 checkbox[i].addEventListener("change",function(){
                     var id=this.firstChild;
                     var thi=this;
                    var request1=new XMLHttpRequest();
                    request1.open("POST","update.php",true);
                    request1.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                    request1.setRequestHeader("X-Requested-With","XMLHttpRequest");
                    request1.onreadystatechange=function(){
                        if(request1.readyState==4 && request1.status==200){
                            var result1=request1.responseText;
                            if(result1=="done"){
                                thi.classList.add("smaller");
                            }else{
                                thi.classList.remove("smaller");
                            }
                        }
                    };
                    request1.send("id="+id.getAttribute("data-id"));
                 });
              }
              //For update datas End
          }
        };
        request.send();


    }
    //For Broswer Reload End
    reload();
    //To add New List Start
    btn.addEventListener("click",function(event){
        event.preventDefault();
        var request=new XMLHttpRequest();
        request.open("POST","add.php",true);
        request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        request.setRequestHeader("X-Requested-With","XMLHttpRequest");
        request.onreadystatechange=function(){
            if(request.readyState==4 && request.status==200){
                var result=request.responseText;
                text.value="";
            }
        };
        request.send("name="+text.value);
        reload();
    });
    //To add New List End

</script>
</body>
</html>