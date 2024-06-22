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
        <style>
        #hey:hover>#change{
            color:white;
        }
    </style>
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
                $alert="Insert Datas Successful!";
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
                $check=$db->setAttribute(PDO::ATTR_ERRMODE,PDO::FETCH_ASSOC);
                $result=$db->exec("INSERT INTO posts(title,content,wirter,created_at,type,imglink1) VALUES ('$title','$contents','$writer','$curTime','$type','$serialize')");
            }else{
                $alert="Insert Datas Fail!";
            }
            switch ($alert){
                case "Insert Datas Successful!":
                    echo '<div class="alert alert-success container" id="hide">'.$alert.'<span class="float-right"><a href="" data-dimiss="#hide">X</a></span></div>';
                    break;
                case "Insert Datas Fail!";
                    echo '<div class="alert alert-warning container" id="hide">'.$alert.'<span class="float-right"><a href="" data-dimiss="#hide">X</a></span></div>';
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
        <!--        Showallpost Start-->
        <?php
        $db=new PDO("mysql:host=localhost;dbname=techcoder","root","");
        $result1=$db->prepare("SELECT COUNT(id) FROM posts");
        $result1->execute();
        $count=$result1->fetchColumn();
        $num=0;
        $result="";
        if(!isset($_GET['show'])){
            $result=$db->prepare("SELECT * FROM posts LIMIT 0,6");
        }else{
            $result=$db->prepare("SELECT * from posts limit $_GET[show],6");
        }

        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);
        ?>
        <div class="container col-md-9 mb-4">
            <?php foreach($result as $item): ?>
            <div class="card mb-4">
                <div class="card-header bg-dark">
                    <h3 class="text-center text-white" style="font-family:Cambria;"><?php echo $item['title'] ?></h3>
                </div>
                <div class="card-block container-fluid">
                    <p class="text-justify" style="font-family:Cambria"><?php echo substr($item['content'],0,400)?></p>
                    <button class="btn btn-outline-danger mb-1" id="hey"><a href="admin.php" id="change" style="text-decoration:none">Delete</a></button>
                    <button class="btn btn-outline-primary mb-1 float-right" id="hey"><a href="editposts.php?pid=<?php echo $item['id'] ?>" id="change" style="text-decoration:none">Edit</a></button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <!--  Show all posts End-->
        <div class="col-md-3">
            <ul class="list-group">
                <li class="list-group-item"><a href="admin.php" style="text-decoration:none">Administrator Posts</a></li>
                <li class="list-group-item"><a href="showallposts.php" style="text-decoration:none">Show all posts</a></li>
                <li class="list-group-item"><a href="#" style="text-decoration:none">Administrator Posts</a></li>
                <li class="list-group-item"><a href="#" style="text-decoration:none">Administrator Posts</a></li>
                <li class="list-group-item"><a href="#" style="text-decoration:none">Administrator Posts</a></li>
            </ul>
        </div>
    </div>

</div>
<!--admin Panel End-->
<!--Pangination System start-->

<div class="container mb-4 mt-3">
    <ul class="pagination justify-content-center">
        <?php for($i=0;$i<$count;$i+=6) :?>
            <?php ++$num; ?>
            <li class="page-item"><a href="showallposts.php?show=<?php echo $i ?>" class="page-link"><?php echo $num ?></a></li>
        <?php endfor; ?>

    </ul>
</div>
<!--Pangination System End-->
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