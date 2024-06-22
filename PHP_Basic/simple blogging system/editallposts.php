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
                    if(checkSession("username")){
                        echo getSession("username");
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
    <h1>Edit Administrator Posts</h1>
</header>
<!--header End-->
<div id="empty"></div>
<!--SideBar Start-->
<div id="scontainer" style="height:1000px;">
    <div>
        <ul>
            <li class="s"><a href="admin.php">INSERT DATAS</a></li>
            <li class="s"><a href="showallposts.php">SHOW ALL POSTS</a></li>
            <li class="s"><a href="#">JAVASCRIPT ADVANCED </a></li>
            <li class="s"><a href="#">JQUERY ADVANCED </a></li>
            <li class="s"><a href="#">BOOTSTRA ADVANCED </a></li>
            <li class="s"><a href="#">PHP ADVANCED </a></li>
            <li class="s"><a href="#">MYSQL ADVANCED </a></li>

        </ul>
    </div>
</div>
<!--SideBar End-->
<!--Admin Post Panel Start-->
<?php
$ary=[];
if($_GET['pid']){

    $result=postDetails($_GET['pid']);
    foreach($result as $item){
        $ary["title"]=$item["title"];
        $ary["subject"]=$item["subject_id"];
        $ary["writer"]=$item["writer"];
        $ary["content"]=$item["content"];
        $ary["imglink"]=$item["imglink"];

    };

}else{
    echo "POst id not found!";
}
if($_GET['pid']){
    if(isset($_POST['submit'])){
        $img=$_FILES['file']['name'];
        $imglink="";
        if($img!=NULL){
            $imglink=$img;
        }else{
            $imglink=$ary['imglink'];
        }
        $title=$_POST['postTitle'];
        $type=$_POST['postType'];
        $subject=$_POST['subject'];
        $writer=$_POST['postWriter'];
        $content=$_POST['textarea'];
        $pid=$_GET['pid'];
        $result=updatePost($title,$type,$subject,$writer,$content,$imglink,$pid);
        echo $result ? "Update Success!" : "Update Fail!";
    }

}








?>
<div id="formcontainer" style="padding-left:30px;width:700px;height:700px;">
    <form action="<?php $_PHP_SELF ?>" method="post" enctype="multipart/form-data">
        <label for="postTitle" style="font-size:20px;">Post Title</label><br>
        <input type="text" name="postTitle" id="postTitle" value="<?php echo $ary['title']; ?>" style="font-size:16px;width:650px;height:33px;border:0.5px solid grey;border-radius:2px"><br><br>


        <label for="postType" style="font-size:20px;">Post Type</label><br>
        <select name="postType" id="postType" style="font-size:16px;width:650px;height:33px;border:0.5px solid grey;border-radius:2px;">
            <option value=1>Free</option>
            <option value=2>Paid</option>
        </select><br><br>


        <label for="subjects" style="font-size:20px;">Subjects</label><br>
        <select name="subject" id="subjects" style="font-size:16px;width:650px;height:33px;border-radius:2px;">
            <?php
            $result=subjects();
            foreach($result as $item){
                echo '<option value='.$item["id"].'>'.$item["name"].'</option>';
            }
            ?>
        </select><br><br>




        <label for="postWriter" style="font-size:20px;">Post Writer</label><br>
        <input type="text" name="postWriter" id="postWriter" value="<?php echo $ary['writer']; ?>" style="font-size:16px;width:650px;height:33px;border:0.5px solid grey;border-radius:2px"><br><br>


        <lable for="textarea" style="font-size:20px">Content</lable>
        <br>
        <textarea rows="20px" cols="105px" name="textarea" id="textarea"><?php echo $ary['content']; ?></textarea><br><br>


        <input type="file" name="file" id="file" rows="33px">
        <div style="float:right;margin-right:50px">
            <input type="submit" name="submit" value="Cancel" style="color:blue;width:60px;height:35px;background:white;border:0;border:2px solid blue;border-radius:3px;border-color:#a797ff;font-size:17px;">
            <input type="submit" name="submit" value="Edit" style="color:white;width:60px;height:35px;background:blue;border:0;border-radius:3px;border-color:#a797ff;font-size:17px;">
        </div>
        <img src="photos/<?php echo $ary['imglink']; ?>" alt="">

    </form>
</div>
<!--Admin Post Panel End-->
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