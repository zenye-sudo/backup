<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<?php
session_start();
include_once("sysgen/mySession.php");
include_once ("sysgen/postgenerator.php");

if(getSession("email")=="futurenetzenye@gmail.com"){
//    header("location:admin.php");
}else{
    header("location:index.php");
}
?>




<!--Navigation Start-->

<div class="navcontainer">
    <nav>
        <img src=".\photos\download.png"  width="100px" height="75px">
        <ul id="ul">
            <li class="li"><a href="index.php">HOME</a></li>
            <li class="li"><a href="filternews.php?pid=1">POLITIC</a></li>
            <li class="li"><a href="filternews.php?pid=2">WARS</a></li>
            <li class="li"><a href="filternews.php?pid=3">IT NEWS</a></li>
            <li class="li"><a href="filternews.php?pid=4">SOCIAL</a></li>
            <li class="li" id="special"><a href="#">

                    <?php
                    $rows=allPostCount();
                    $start=0;
                    if(isset($_GET['start'])){
                        $start=$_GET['start'];
                    }else{
                        $start=0;
                    }
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
    <h1>Administrator Post</h1>
</header>

<?php
$message="";

if(isset($_POST['submit'])){
    $title=$_POST['postTitle'];
    $type=$_POST['postType'];
    $writer=$_POST['postWriter'];
    $content=$_POST['textarea'];
    $file=$_FILES['file']['name'];
    $imglink=mt_rand(time(),time())."_".$file;
    move_uploaded_file($_FILES['file']['tmp_name'],"photos/".$imglink);
    $bol=insertDatas($title,$type,$writer,$content,$imglink);
    if($bol=="False"){
        $message="Insert Datas Fail!";
    }else{
        $message="Insert Datas Successful!";
    }
    echo "<div id='message' style='width:100%;height:40px;background:#57dd8c'>
    <a href='#' id='alertbtn' style='text-decoration:none;float:right;margin-right:10px;position:relative'>X</a>
    <p style='line-height:40px;text-align:center;'>$message</p>

</div>";
}
//?>
<!--header End-->
<div id="empty"></div>
<!--SideBar Start-->
<div id="scontainer">
    <div>
        <ul>
            <li class="s"><a href="admin.php">INSERT POSTS</a></li>
            <li class="s"><a href="showallposts.php">SHOW ALL POSTS  </a></li>
            <li class="s"><a href="#">JAVASCRIPT ADVANCED </a></li>
            <li class="s"><a href="#">JQUERY ADVANCED </a></li>
            <li class="s"><a href="#">BOOTSTRA ADVANCED </a></li>
            <li class="s"><a href="#">PHP ADVANCED </a></li>
            <li class="s"><a href="#">MYSQL ADVANCED </a></li>

        </ul>
    </div>
</div>
<!--SideBar End-->
<!--Show all posts panel Start-->
<?PHP
$result=showDatas(2,$start);

foreach($result as $post){
    echo "<div id='showallpost'>
    <h3>".$post['title']."</h3>
    <p>".substr($post['content'],0,300)."
    </p>
    <a href='editallposts.php?pid=".$post['id']."' id='a'>Edit</a> 
    <a href='showallposts.php?delete=".$post['id']."' id='b' >Delete</a>

</div>";
}
$test="";
if(isset($_GET['delete'])){
    $test=$_GET['delete'];
    deletePost($test);
}
?>
<!--Show all posts panel End-->
<!--Pangination System Start-->
<?php

?>
<div id="pagination" style="width:100%;text-align:center;margin-bottom:20px;margin-top:10px;">
  <nav>
      <ul><?php
          $num=0;
          for($i=0;$i<$rows;$i+=5){
              $num++;
              echo "<li><a href='showallposts.php?start=".$i."'>".$num."</a></li>";
          }
          ?>

      </ul>
  </nav>
</div>
<!--Pangination System End-->
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


<script>
    var message=document.getElementById("message");
    var alertbtn=document.getElementById("alertbtn");
    alertbtn.onclick=function(){
        message.style.display="none";
    }

</script>
</body>
</html>
