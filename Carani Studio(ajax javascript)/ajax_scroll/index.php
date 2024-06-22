<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .blog_posts{
            width:700px;
            height:300px;
            border:1px solid black;
            margin-bottom:34px;
        }
        #spinner{
            display:none;
        }
    </style>
</head>
<body>
<div id="container">
</div>
<div id="spinner">
    <img src="spinner.gif" alt="spinner" width="40px" height="40px">
</div>
<div id="loadmorediv">
    <button id="loadmore" data-page="0">Loadmore</button>
</div>
<script>
    var container=document.getElementById("container");
    var loadmore=document.getElementById("loadmore");
    var spinner=document.getElementById("spinner");
    var prevent=false;
    function showSpinner(){
     spinner.style.display='inline';
    }
    function hideSpinner(){
        spinner.style.display="none";
    }
    function showLoadmore(){
        loadmore.style.display='inline';
    }
    function hideLoadmore(){
        loadmore.style.display="none";
    }
    function appendToDiv(container,result){
        var temp=document.createElement("div");
        temp.innerHTML=result;
        // container.appendChild(temp);
        var class_name=temp.firstElementChild.className;
        var items=temp.getElementsByClassName(class_name);
        var len=items.length;
        for(var i=0;i<len;i++){
            container.appendChild(items[0]);
        }
        console.log(items.length);
        // console.log("Class name is "+class_name);
    }
    function setCurrentPage(page){
        console.log("INcrementing page to "+page);
        loadmore.setAttribute("data-page",page);
    }
    function loadMore(){
        if(prevent){return;};
        prevent=true;
        showSpinner();
        hideLoadmore();
        var page=parseInt(loadmore.getAttribute("data-page"));
        var next_page=page+1;
        var request=new XMLHttpRequest();
        request.open("GET","blog_posts.php?page="+next_page,true);
        request.setRequestHeader("X-Requested-With","XMLHttpRequest");
        request.onreadystatechange=function(){
        if(request.readyState==4 && request.status==200){
            var result=request.responseText;
            console.log("Result:"+result);
            setCurrentPage(next_page);
            appendToDiv(container,result);
            hideSpinner();
            showLoadmore();
            prevent=false;
        }
        };
        request.send();
    }
    loadmore.addEventListener("click",function(event){
        event.preventDefault();
        loadMore();
    });
    function scrollreaction(){
        var content_height=container.offsetHeight;
        var current_height=window.innerHeight+window.pageYOffset;
        console.log(current_height+"/"+content_height);
        if(current_height>=content_height){
            loadMore();
        }
    }
    window.onscroll=function(){
        scrollreaction();
    };
    loadMore();
</script>
</body>
</html>