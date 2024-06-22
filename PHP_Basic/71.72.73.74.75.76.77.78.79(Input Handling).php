<?php 
if(isset($_POST['submit'])){
	$colors=$_POST['colors'];
	$nams=$_POST['nam'];
	echo "Your username is ".$_POST['username']."<br>";
	echo "Your password is ". $_POST['password'].'<br>';
	foreach($colors as $color){
	echo $color ."<br>";
    };
    foreach($nams as $nam){
    echo $nam."<br>";
    };

    $file=$_FILES['file']['tmp_name'];
    echo $file;
    move_uploaded_file($file,'test/'.$_FILES['file']['name']);

    $files=$_FILES['files']['tmp_name'];
    foreach($files as $key=>$value){
        echo $_FILES['files']['name'][$key] ."<br>";
    }

}
 ?>
 <FORM action='<?php $_PHP_SELF ?>' method="post" enctype="multipart/form-data">
 	<input type="text" name="username"><br><br>
 	<input type="password" name="password"><br><br>
 	<input type="checkbox" name="colors[]" value="red">Red
 	<input type="checkbox" name="colors[]" value="Green">Green
 	<input type="checkbox" name="colors[]" value="Blue">Blue <br><br>
 	<input type="radio" name="nam[]" value="mg mg">MG MG
 	<input type="radio" name="nam[]" value="aung aung">AUNG AUNG
 	<input type="radio" name="nam[]" value="zaw zaw">ZAW ZAW <br><br>
 	<input type="file" name="file"><br><br>
 	<input type="file" name="files[]" multiple><br><br>
  
 	<input type="submit" name="submit"><br><br>
 </FORM>