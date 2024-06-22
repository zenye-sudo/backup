
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
session_start();
include_once ("sysgen/postgenerator.php");
include_once("sysgen/mySession.php");
?>

<!--Navigation Start-->

<div class="navcontainer">
    <nav>
        <img src="photos/download.png"  width="100px" height="75px">
        <ul id="ul">
            <li class="li"><a href="index.php">HOME</a></li>
            <li class="li"><a href="filternews.php?pid=1">POLITIC</a></li>
            <li class="li"><a href="filternews.php?pid=2">WARS</a></li>
            <li class="li"><a href="filternews.php?pid=3">IT NEWS</a></li>
            <li class="li"><a href="filternews.php?pid=4">SOCIAL</a></li>
            <li class="li" id="special"><a href="#">

                    <?php
                    if(checkSession("username")){
                        echo "<a href='admin.php'>".getSession("username")."</a>";
                    }else{
                        echo "MEMBER";
                    }
                    ?>



                </a>
                <ul id="ul2">
                    <?php
                    if(checkSession("username")){
                        echo  "<li><a href=\"logout.php\">Logout</a></li>";
                    }else{
                        echo "<li><a href=\"login.php\">Login</a></li>
                    <li><a href=\"register.php\">Register</a></li>";
                    }
                    ?>
                </ul>
            </li>
        </ul>
    </nav>
</div>
<!--Navigation End-->
<!--header Start-->
<header>
    <h1>NASA SIMPLE BLOG</h1>
</header>
<!--header End-->
<div id="empty"></div>
<!--Sectioin Start-->
<?php
if($_GET['pid']){
    $pid=$_GET['pid'];
    $bol=postDetails($pid);
    foreach($bol as $post) {
//            echo $post['imglink'];
        echo "<div id='section'>
    <h1>".$post['title']."</h1>
    <img style='width:400px;height:400px;' src='photos/".$post['imglink']."' alt='nasa'>
    <p>".$post['content']."</p>
    <span id='span1'>".$post['created_at']."</span><br><hr><br><br>
</div>";
    }
}
?>

   <form action='<?php $_PHP_SELF ?>' method='post' style='margin-left:30px'>
       <?php
       if(checkSession("username")){
           echo "<label for='addcomment' style='font-size:20px;margin-left:23px;'>Add Comment:</label><br>
        <input type='text' style='font-size:20px;width:850px;height:30px;margin-left:20px'; id='addcomment' name='comments'>
        <input type='submit' name='submit' value='Comment' style='width:70px;height:40px;color:white;border:0;background:#63c1ff;'><br><br>";
       }

       ?>

    </form>;

<!-- php Code-->
<div style="width:920px;max-height:500px;overflow:auto;margin-left:50px;margin-bottom:39px;margin-top:19px; padding-top:20px;">

<?php
if(checkSession("username")){
if(isset($_POST['submit'])){
        $name=getSession("username");
        $pid=$_GET['pid'];
        $comments=$_POST['comments'];
        insertComments($name,$pid,$comments);
        $result=showComments($pid);
        foreach ($result as $item){
           echo '<div id="generate">
            <div id="pp"></div>
            <span>'.$item["name"].'</span><br>
            <p>'.$item["comment"].'</p>
        </div>';
        }
    }else{


    $result=showComments($_GET['pid']);
    foreach ($result as $item){
        echo '<div id="generate">
            <div id="pp"></div>
            <span>'.$item["name"].'</span><br>
            <p>'.$item["comment"].'</p>
        </div>';
    }


}


}else{
    $result=showComments($_GET['pid']);
    foreach ($result as $item){
        echo '<div id="generate">
            <div id="pp"></div>
            <span>'.$item["name"].'</span><br>
            <p>'.$item["comment"].'</p>
        </div>';
    }
}

?>
</div>


<!--PHP code -->


<!--Session End-->
<!--Footer Start-->
<div class="footer">
    <div class="first">
        <nav>
            <ul>
                <li><a href="#">HOME</a></li>
                <li><a href="#">NEWS</a></li>
                <li><a href="#">PRODUCTS</a></li>
                <li><a href="#">ABOUT</a></li>
            </ul>
        </nav>
    </div>

    <div class="second">
        <nav>
            <ul>
                <li><h2>Contact Imformation(TechCoder Myanmar)</h2>
                </li>
                <li><a href="#">-Thaedaw</a></li>
                <li><a href="#">-Myat Phone Shin Main Road,13</a></li>
                <li><a href="#">-Yangon</a></li>
                <li><a href="#">-Shwe Taung Kyar </a></li>
                <li><a href="#">-09-969313141,09-769458185</a></li>
            </ul>
        </nav>
    </div>

</div>
<!--Footer End-->
<script type="text/javascript">
    var error=document.getElementById("auto");
    console.log(error);
</script>
</body>
</html>