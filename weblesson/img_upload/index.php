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
<h3>Select Image</h3>
<input type="file" name="file" id="file">
<span id="upload_image"></span>
<script src="../bootstrap/script/jquery-3.3.1.min.js"></script>
<script>
    $(document).ready(function(){
        var url=window.URL;
        $(document).on("change","#file",function(){
            var files,img;
            var thi=this;
            if((files=this.files[0])){
                img=new Image();
                img.onload=function(){
                    alert("width:"+this.width+" Height:"+this.height);
                    //Test start
                    var property=thi.files[0];
                    var image_name=property.name;
                    var image_extension=image_name.split(".").pop().toLowerCase();
                    if($.inArray(image_extension,['jpg','jpeg','gif','png'])== -1){
                        alert("Invaild image file");
                    }else{
                        var image_size=property.size;
                        if(image_size>2000000){
                            alert("Imagee file size is very big");
                        }else{
                            var form_data=new FormData();
                            form_data.append("file",property);
                            $.ajax({
                                url:"upload.php",
                                method : "POST",
                                data:form_data,
                                contentType:false,
                                cache:false,
                                processData:false,
                                beforeSend:function(){
                                    $('#upload_image').html("<label>Uploading File...</label>");
                                },
                                success:function(data){
                                    $("#upload_image").html(data);
                                    console.log9
                                }
                            });
                        }
                    }
                    //Test End
                };
                console.log(this.name);
                img.src=url.createObjectURL(files);
            }

        });
    });
</script>
</body>
</html>