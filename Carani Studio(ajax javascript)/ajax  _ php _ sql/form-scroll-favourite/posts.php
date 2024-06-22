<?php
session_start();
$username="zsdf";
if(isset($_SESSION['username'])){
    $username=$_SESSION['username'];
}else{
    header("location:index.php");
}
?>
<style></style>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
       .style{
           width:600px;
           border:1px solid black;
           margin-bottom:20px;
           padding-bottom:14px;
       }
        #loadmorebtn{
            display:none;
        }
        .hide{
            display:none;
        }
    </style>
</head>
<body>
<p style="float:right"><?php echo $username ?></p>
<a href="logout.php">Logout</a>

<div id="container">

</div>
<button id="loadmorebtn" data-page="0">loadmore</button>
<div id="alert">
    There is no posts in this section.
</div>
<script>
    var loadmorebtn=document.getElementById("loadmorebtn");
    var container=document.getElementById("container");
    var likecounter=document.getElementsByClassName("likecounter");
    var prevent=false;
    function like(){
        var likebtns=document.getElementsByClassName("like");
        var unlikebtns=document.getElementsByClassName("unlike");
        for(var i=0;i<likebtns.length;i++){
            likebtns[i].addEventListener("click",function(){
                var pid=this.getAttribute("data-pid");
                var uid=this.getAttribute("data-uid");
                var pid1=this.parentElement.lastElementChild.id;
                var pidinput=this.parentElement.lastElementChild;
                var likebtn=this;
                var unlikebtn=this.previousElementSibling;
                var request=new XMLHttpRequest();
                request.open("POST","like.php",true);
                request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                request.setRequestHeader("X-Requested-With","XMLHttpRequest");
                request.onreadystatechange=function(){
                    if(request.readyState==4 && request.status==200){
                        var result=request.responseText;
                        if(result!="You had been liked"){
                            pidinput.innerHTML=result + " Likes";
                        }
                          likebtn.style.display="none";
                          unlikebtn.style.display="inline";
                        console.log(likebtn);
                        console.log(unlikebtn);
                    }
                };
                request.send("pid="+pid+"&uid="+uid+"&pid1="+pid1);
            });
        }
        for(var o=0;o<unlikebtns.length;o++){
            unlikebtns[o].addEventListener("click",function(){
                var pid=this.getAttribute("data-pid");
                var uid=this.getAttribute("data-uid");
                var pid1=this.parentElement.lastElementChild.id;
                var pidinput=this.parentElement.lastElementChild;
                var unlikebtn=this;
                var likebtn=this.nextElementSibling;
                var request=new XMLHttpRequest();
                request.open("POST","unlike.php",true);
                request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                request.setRequestHeader("X-Requested-With","XMLHttpRequest");
                request.onreadystatechange=function(){
                    if(request.readyState==4 && request.status==200){
                        var result=request.responseText;
                        if(result!="You had been liked"){
                            pidinput.innerHTML=result + " Likes";
                        }
                        unlikebtn.style.display="none";
                        likebtn.style.display="inline";
                    }
                };
                request.send("pid="+pid+"&uid="+uid+"&pid1="+pid1);
            });
        }
    }
    function showPosts(result){
        var temp=document.createElement("div");
        temp.innerHTML=result;
        var className=temp.getElementsByClassName("style");
        var len=className.length;
        for(var i=0;i<len;i++){
            container.appendChild(className[0]);
        }
    };
    function loadMore(){
        if(prevent){return;};
        prevent=true;
        var page=parseInt(loadmorebtn.getAttribute("data-page"));
        var request=new XMLHttpRequest();
        request.open("GET","scroll.php?page="+page,true);
        request.setRequestHeader("X-Requested-With","XMLHttpRequest");
        request.onreadystatechange=function(){
            if(request.readyState==4 && request.status==200){
                var result=request.responseText;
                showPosts(result);
                like();
                var next_page=page+10;
                loadmorebtn.setAttribute("data-page",next_page);
                prevent=false;
            }
        };
        request.send();

    }
    function scrollReaction(){
        var contentHeight=container.offsetHeight;
        var currentHeight=window.innerHeight+window.pageYOffset;
        if(currentHeight>contentHeight){
            loadMore();
        }
    }
    loadmorebtn.addEventListener("click",loadMore);
    document.onscroll=function(){
       scrollReaction();
    };
    loadMore();
</script>
</body>
</html>
