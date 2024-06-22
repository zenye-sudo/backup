document.addEventListener("DOMContentLoaded",function(){
   var suggestions=document.getElementById("suggestions");
   var form=document.getElementById("search-form");
   var search=document.getElementById("search");
   function sort(json){
       var output="";
       for(var i=0;i<json.length;i++){
           output+="<li>";
            output+="<a href='search.php?q='"+json[i]+">";
               output+=json[i];
               output+="</a>";
               output+="</li>";
       }
       return output;
   }
   function showSuggestions(json){
       suggestions.style.display="block";
    suggestions.innerHTML=sort(json);
   }
   function getSuggestions(){
       var q=search.value;
       if(q.length<=3){
           suggestions.style.display="none";
           return;
       }
       var xhr=new XMLHttpRequest();
       xhr.open("GET","autosuggest.php?q="+q,true);
       xhr.setRequestHeader("X-Requested-With","XMLHttpRequest");
       xhr.onreadystatechange=function(){
           if(xhr.readyState==4 && xhr.status==200){
               var result=xhr.responseText;
               console.log("Result:"+result);
               var json=JSON.parse(result);
               showSuggestions(json);
               console.log(result[0]);
               console.log(json);
           }
       };
       xhr.send();
   }
   search.addEventListener("input",getSuggestions);
});