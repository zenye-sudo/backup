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
<div id="form">
    <p>Which category are you interest in?</p>
    <select name="category_select" id="category_select">
        <option disabled selected>Please Choose</option>
        <option value="1">Fruits</option>
        <option value="2">Vegetables</option>
        <option value="3">Books</option>
    </select>
    <select name="sub_category_select" id="sub_category_select">

    </select>
</div>
<script>
var cat_select=document.getElementById("category_select");
var subcat_select=document.getElementById("sub_category_select");
cat_select.addEventListener("change",requestAjax);
function requestAjax(){
    var url="subcatagories.php?category_id="+cat_select.value;
    var request=new XMLHttpRequest();
    request.open("GET",url,true);
    request.onreadystatechange=function(){
        if(request.readyState==4 && request.status==200){
            subcat_select.innerHTML=request.responseText;
        }
    }
    request.send();
}
</script>
</body>
</html>