<?php
$db=new PDO("mysql:host=localhost;dbname=techcoder","root","");
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$result=$db->prepare("select * from users");
$result->execute();
$result->setFetchMode(PDO::FETCH_ASSOC);

?>
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
<select name="users" id="users">
    <?php
    foreach($result->fetchAll() as $key=>$value){
        echo "<option value='".$value['id']."'>".$value['name']."</option>";
    }
    ?>
</select>
<span id="id"></span>
<span id="name"></span>
<span id="email"></span>
<span id="country"></span>
<script>
    var users=document.getElementById("users");
    var id=document.getElementById("id");
    var name=document.getElementById("name");
    var email=document.getElementById("email");
    var country=document.getElementById("country");
    users.addEventListener("change",function(){
        var uid=users.value;
        var request=new XMLHttpRequest();
        request.open("GET","test.php?uid="+uid,true);
        request.setRequestHeader("X-Requested-With","XMLHttpRequest");
        request.onreadystatechange=function(){
          if(request.status==200 && request.readyState==4){
              var result=request.responseText;
              var json=JSON.parse(result);
              country.innerHTML=json[4].country;
              id.innerHTML=json[0].id;
              name.innerHTML=json[1].name;
              email.innerHTML=json[2].email;
              // console.log(json[0].id+json[1].name+json[2]);
              console.log(json);
          }
        };
        request.send();
    });
</script>
</body>
</html>