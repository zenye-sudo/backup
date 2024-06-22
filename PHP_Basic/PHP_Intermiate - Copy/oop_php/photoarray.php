<form action="<?php $_PHP_SELF ?>" method="post" enctype="multipart/form-data">
    <input type="file" name="files[]" multiple>
    <input type="submit" name="submit">
</form>
<?php
if(isset($_POST['submit'])){
    $files=$_FILES["files"]['name'];
    $files1=$_FILES['files']['tmp_name'];
    $imglink=[];
    foreach ($files as $item){
        $imglink[]=mt_rand(time(),time()).$item;
    }
    foreach ($files1 as $key=>$value){
        move_uploaded_file($value,"testimg/".$imglink[$key]);
    }
    $serialize=serialize($imglink);
        function getMyDate(){
            return date("Y/m/d H:m:s",time());
        }
        $hey=getMyDate();
        $db=new PDO("mysql:host=localhost;dbname=techcoder","root","");
        $result=$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $db->exec("INSERT INTO posts(title,content,wirter,created_at,imglink1) VALUES('hey','sdf','zenye','$hey','$serialize')");
            $result=$db->prepare('SELECT imglink1 FROM posts WHERE id=2');
            $result->execute();
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $output=$result->fetchColumn();
            $unserialize=unserialize($output);
            foreach ($unserialize as $item){
                echo "<img src='testimg/".$item."'>";
            }


}
?>