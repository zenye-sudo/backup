<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/fontawesome-free-5.0.11/fontawesome-free-5.0.11/web-fonts-with-css/css/fontawesome-all.css">
</head>
<body>
<?php
require_once "include/session.php";
require_once "include/navbar.php";
?>
<!--admin Panel Start-->
<?php
$alert="";
if(MySession::checkSession("email")){
    if(MySession::adminGetSession("email")=="futurenetzenye@gmail.com"){
        if(isset($_POST['submit'])){
            $title=$_POST['title'];
            $writer=$_POST['writer'];
            $type=$_POST['type'];
            $contents=$_POST['contents'];
            $name=$_FILES['imglink']['name'];
            $tmp_name=$_FILES['imglink']['tmp_name'];
//        print_r($tmp_name);
            if($title!=NULL AND $writer!=NULL AND $type!=NULL AND $contents!=NULL AND $name[0]!="" AND strlen($contents)>=50){
                $alert="Edit Datas Successful!";
                $eachname=[];
                foreach ($name as $item){
                    $item=mt_rand(time(),time()).$item;
                    $eachname[]=$item;
                }
                foreach($tmp_name as $key=>$value){
                    move_uploaded_file($value,"postimg/".mt_rand(time(),time()).$name[$key]);
                }
                $serialize=serialize($eachname);
                function getMyDate(){
                    date_default_timezone_set("Asia/Rangoon");
                    return date("Y/m/d H:m:s");
                }
                $curTime=getMyDate();
                $result=$db->exec("UPDATE posts SET title='$title',wirter='$writer',type=$type,content='$contents',imglink1='$serialize' where id=$_GET[pid] ");
            }else{
                $alert="Edit Datas Successful!";
                $result=$db->exec("UPDATE posts SET title='$title',wirter='$writer',type=$type,content='$contents' where id=$_GET[pid] ");

            }
            switch ($alert){
                case "Edit Datas Successful!":
                    echo '<div class="alert alert-success container" id="hide">'.$alert.'<span class="float-right"><a href="" data-dimiss="#hide">X</a></span></div>';
                    break;
            }
        }
    }else{
        header("location:index.php");
    }
}else{
    header("location:index.php");
}

?>
<div class="container-fluid mb-5">
    <div class="row">
<!--        Form Start-->
        <?php
        if(isset($_GET['pid'])){
            $hey=$db->prepare("SELECT * FROM posts WHERE id= $_GET[pid]");
            $hey->execute();

        }
        ?>

        <div class="container col-md-9 mb-4">
            <div class="card border-0 pb-4">
                <div class="head-header text-center text-white bg-dark">
                    <h3>Edit Post</h3>
                </div>
                <div class="container card-block">
                    <?php foreach($hey as $key=>$value): ?>
                        <?php
                    $unserialize=unserialize($value['imglink1']);
                        ?>
            <form action="<?php $_PHP_SELF ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Post title</label>
                    <input type="text" id="title" class="form-control" name="title" value="<?php echo $value['title'] ?>" placeholder="Title">
                </div>
                <div class="form-group">
                    <label for="writer">Post writer</label>
                    <input type="text" id="writer" class="form-control" value="<?php echo $value['wirter'] ?>"name="writer" placeholder="Writer">
                </div>
                <div class="form-group">
                    <label for="type">Post Type</label>
                    <select name="type" id="type" class="form-control">
                        <option value="1">Celebrity</option>
                        <option value="2">Healthy</option>
                        <option value="3">IT news</option>
                        <option value="4">Coding</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="content">Post contents</label>
                    <textarea name="contents" id="content" cols="30" rows="10" class="form-control">
                        <?php echo $value['content'] ?>
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="img">Choose Files</label>
                    <input type="file" id="img" name="imglink[]" class="form-control" multiple>
                </div>
               <?php foreach ($unserialize as $item): ?>
    <img src="postimg/<?php echo $item ?>" alt="bg" style="width:200px;height:100px;">
                <?php endforeach;?>
                <button class="btn btn-outline-primary float-right" name="submit">Edit</button>
            </form>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

<!--        Form End-->
        <div class="col-md-3">
            <ul class="list-group">
                <li class="list-group-item"><a href="#" style="text-decoration:none">Administrator Posts</a></li>
                <li class="list-group-item"><a href="showallposts.php" style="text-decoration:none">Show all posts</a></li>
                <li class="list-group-item"><a href="#" style="text-decoration:none">Administrator Posts</a></li>
                <li class="list-group-item"><a href="#" style="text-decoration:none">Administrator Posts</a></li>
                <li class="list-group-item"><a href="#" style="text-decoration:none">Administrator Posts</a></li>
            </ul>
        </div>
    </div>

</div>
<!--admin Panel End-->
<?php
require_once "include/footer.php";
?>

<script src="bootstrap/script/jquery-3.3.1.min.js"></script>
<script src="bootstrap/script/jquery-3.3.1.slim.min.js"></script>
<script src="bootstrap/script/popper.min.js"></script>
<script src="bootstrap/script/tether.js"></script>
<script src="bootstrap/script/bootstrap.min.js"></script>
</body>
</html>