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

<?php
//Like System Start
if(MySession::checkSession("username")){
    if(isset($_GET['lid'])){
        $user=MySession::getSession("username");
        $email=MySession::getSession("email");
        $article=$_GET['lid'];
        $insertLike=$db->exec("
                INSERT INTO articles_like (user,email,article)
                SELECT users.name,users.email,posts.id
                FROM users
                JOIN posts
                WHERE EXISTS (SELECT id FROM posts WHERE id=$article) AND users.name='$user' AND users.email='$email' AND posts.id=$article AND NOT EXISTS(SELECT id FROM articles_like WHERE user='$user' AND email='$email' AND article=$article)LIMIT 1
                ;
                ");
    }
}
//        Like System End
if(isset($_GET['epid'])){
    $epid=$_GET['epid'];

    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $result=$db->prepare("SELECT * FROM posts WHERE id=$epid");
    $result->execute();
    $result->setFetchMode(PDO::FETCH_ASSOC);
}
?>
<?php
if(isset($_POST['submit'])){
$check=$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$comments=$_POST['comment'];

if($comments!=NULL){
    if(MySession::checkSession("username")){
        $user=MySession::getSession("username");
        $article=$_GET['epid'];

    }
}
}
?>
<?php foreach ($result->fetchAll() as $item):?>
 <?php
// LIKER sTART
$epid=$_GET['epid'];
 $liker=$db->prepare("SELECT user FROM articles_like WHERE article=$epid ");
 $liker->execute();
 $liker->setFetchMode(PDO::FETCH_ASSOC);
// LIKER END
    switch($item['type']){
        case 1:
            $typechange="Celebrity";
            break;
        case 2:
            $typechange="Healthy";
            break;
        case 3:
            $typechange="IT News";
            break;
        case 4:
            $typechange="Coding";
            break;
    }
 $likecount=$db->prepare("SELECT COUNT(*) FROM articles_like WHERE article=$item[id] ");
 $likecount->execute();
 $likecount->setFetchMode(PDO::FETCH_ASSOC);
 $commentcount=$db->prepare("SELECT COUNT(*) FROM comments  WHERE article=$item[id] ");
 $commentcount->execute();
 $commentcount->setFetchMode(PDO::FETCH_ASSOC);
    ?>
    <!--        Section Start-->
<div class="container-fluid">
    <div class="container-fluid row">
    <div class="col-md-10">
        <div class="card border-0 mb-4">
            <div class="card-header bg-dark">
                <h3 class="text-white header"><?php echo $item['title'] ?></h3>
                <div class="container row">
                    <div class="col-md-2 bg-warning"><a href="#" class="text-white"><i class="fa fa-pencil-alt"></i>  <?php echo $item['wirter'] ?><a></div>
                    <div class="col-md-3 bg-success"><a href="#" class="text-white"><i class="fa fa-clock "></i>  <?php echo $item['created_at'] ?></a></div>
                    <div class="col-md-2 bg-secondary"><a href="#" class="text-white"><i class="fab fa-digital-ocean"></i>  <?php echo $typechange ?></a></div>
                    <?php if(MySession::checkSession("username")): ?>
                        <div class="col-md-2 bg-info"><a href="postdetails.php?epid=<?php echo $epid ?>&lid=<?php echo $item['id'] ?>" class="text-white" ><i class="fa fa-hand-peace"></i>Like <span class="badge bg-danger"> <?php echo $likecount->fetchColumn()?></span></a></div>
                    <?php endif; ?>
                    <?php if(!MySession::checkSession("username")):?>
                        <div class="col-md-2 bg-info"><li style="color:white;list-style-type: none"><i class="fa fa-hand-peace"></i> Like <span class="badge bg-danger"> <?php echo $likecount->fetchColumn()?></span></li></div>
                    <?php endif ;?>
                    <div class="col-md-3 bg-danger"><a href="#" class="text-white"><i class="fa fa-comment"></i>comments <span class="badge bg-info"> <?php echo $commentcount->fetchColumn()?></span></a></div>
                </div>
            </div>
            <div class="card-block bg-light mt-4">
                <?php
                $unserialize=unserialize($item['imglink1']);
                ?>
                    <img src="postimg/<?php echo $unserialize[0] ?>" alt="1.png" class="container">
                <p style="font-family: Cambria;text-indent:34px;" class="container text-justify"><?php echo substr($item['content'],0,2000) ?></p>
                <img src="postimg/<?php echo $unserialize[1] ?>" alt="" class="container">
                <p style="font-family: Cambria;text-indent:34px;" class="container text-justify"><?php echo substr($item['content'],2000,2000) ?></p>
                <img src="postimg/<?php echo  $unserialize[2] ?>" alt="" class="container">
            </div>
            <form action="<?php $_PHP_SELF  ?>" class="container-fluid" style="background:rgba(0,0,0,0.07)" method="post">
                <div class="form-group">
                    <label for="comment">Add comments</label>
                    <div class=" row"><div class="container col-md-10"><input type="text" class="form-control" name="comment" id="comment"></div>
                        <div class="col-md-2"><button class="container btn btn-outline-primary" name="submit">Comment</button></div></div>
                </div>
            </form>
            <div class="card-footer" style="background:rgba(0,0,0,0.07);max-height:504px;overflow:auto">

                <!--                        Comment Form Start-->
                <?php
                if(isset($_POST['submit'])){
                    $addcomments=$db->exec("INSERT INTO comments (user,article,comment) VALUES('$user',$article,'$comments')");
                            $getcomments=$db->prepare("SELECT * FROM comments WHERE article=$epid");
        $getcomments->execute();
        $getcomments->setFetchMode(PDO::FETCH_ASSOC);
                    foreach($getcomments->fetchAll() as $key=>$value){
                 echo '                <div class="container mb-3">
                    <div class="row">
                        <span class="col-md-1 mr-md-5"><img src="img/1.PNG" alt="" class=" bg-danger" style="width:100px;height:60px;"></span>
                        <div class="col-10"><span style="font-family: \'MV Boli\';font-size:18px;">'.$value["user"].'</span><br>
                            <p>'.$value["comment"].'</p>
                        </div>
                    </div>
                </div>';

                }

                }else{
                            $getcomments=$db->prepare("SELECT * FROM comments WHERE article=$epid");
        $getcomments->execute();
        $getcomments->setFetchMode(PDO::FETCH_ASSOC);
                    foreach($getcomments->fetchAll() as $key=>$value){
                        echo '                <div class="container mb-3">
                    <div class="row">
                        <span class="col-md-1 mr-md-5"><img src="img/1.PNG" alt="" class=" bg-danger" style="width:100px;height:60px;"></span>
                        <div class="col-10"><span style="font-family: \'MV Boli\';font-size:18px;">'.$value["user"].'</span><br>
                            <p>'.$value["comment"].'</p>
                        </div>
                    </div>
                </div>';

                    }
                }
                ?>

                <!--                        Comment Form End-->
            </div>
        </div>
    </div>

    <!--        Section End-->

        <?php endforeach; ?>
<!--        Nav Start-->
        <?php
        // LIKER sTART
        $epid=$_GET['epid'];
        $liker=$db->prepare("SELECT user FROM articles_like WHERE article=$epid ");
        $liker->execute();
        $liker->setFetchMode(PDO::FETCH_ASSOC);
        // LIKER END
        ?>

    <div class=" col-md-2">
            <div class="card border-0 mb-4">
                <div class="card-header bg-dark hey"><span class="hey text-white" id="h3">Post Likers</span></div>
                <div class="card-block bg-white pb-2 pt-2" style="max-height: 490px;overflow:auto" id="block">
                 <ol>
                     <?php foreach ($liker->fetchAll() as $item): ?>
                     <li style="line-height: 40px;"><a href="#" class="text-dark" style="text-decoration:none;font-size:18px;font-family:'MV Boli'"><?php echo $item['user'] ?></a></li>
                     <?php endforeach; ?>
                 </ol>
                </div>
            </div>
    </div>

<!--        Nav End-->
<!--    </div>-->
</div>
<?php
require_once "include/footer.php";
?>
<script src="bootstrap/script/jquery-3.3.1.min.js"></script>
<script src="bootstrap/script/popper.min.js"></script>
<script src="bootstrap/script/tether.js"></script>
<script src="bootstrap/script/bootstrap.min.js"></script>
<script>
   $("#block").hide();
    $("#h3").click(function(){
       var parent=$(this).parent();
       var bo=parent.parent();
       $("#block",bo).slideToggle("fast");
        // console.log(parent);
    });
</script>
</body>
</html>