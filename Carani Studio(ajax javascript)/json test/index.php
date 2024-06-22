<p id="p"></p>
<script>
    var request=new XMLHttpRequest();
    request.open("POST","test.json",true);
    request.send();
    request.onreadystatechange=function(){
        if(request.readyState==4 && request.status==200){
        var p=document.getElementById("p");
        var hey=JSON.parse(request.responseText);
        console.log(hey);
        for(k in hey){
            p.innerHTML+=k+":"+hey[k]+"<br>";
        }
        }
    }
</script>