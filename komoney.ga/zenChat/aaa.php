<?php
require_once "../connection.php";
$file_name=$_FILES['file1']['name'];
$new_name=mt_rand(time(),time()).".".$file_name;
move_uploaded_file($_FILES['file1']['tmp_name'],"../user/cp/".$new_name);
$je=json_encode($new_name);
$result=$db->prepare("update users set cp='{$je}' WHERE id={$_COOKIE['useridKoMoney']}");
$result->execute();
echo $new_name;