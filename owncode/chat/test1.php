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
<input type="file" name="photo" id="photoInput">
<script src="../bootstrap/script/jquery-3.3.1.min.js"></script>
<script>
    var url=window.URL;
    $("#photoInput").on("change",function(e){
        var files,img;
        if((files=this.files[0])){
            img=new Image();
            img.onload=function(){
                alert("width:"+this.width+" Height:"+this.height);
            };
            img.src=url.createObjectURL(files);
        }
    });
</script>
</body>
</html>