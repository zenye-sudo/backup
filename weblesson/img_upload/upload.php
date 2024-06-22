<?php
if($_FILES['file']['name']!=""){
    $test=explode(".",$_FILES['file']['name']);
    $extension=end($test);
    $new_name=mt_rand(time(),time()).".".$extension;
    move_uploaded_file($_FILES['file']['tmp_name'],"img/".$new_name);
    echo "<img src='img/".$new_name."'>";
}