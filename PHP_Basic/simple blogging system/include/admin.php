
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
    <h1>Administrator Post</h1>
</header>

<?php
$message="";

if(isset($_POST['submit'])){
    $title=$_POST['postTitle'];
    $type=$_POST['postType'];
    $subject=$_POST['subject'];
    $writer=$_POST['postWriter'];
    $content=$_POST['textarea'];
    $file=$_FILES['file']['name'];
    $imglink=mt_rand(time(),time())."_".$file;
    move_uploaded_file($_FILES['file']['tmp_name'],"photos/".$imglink);
    $bol=insertDatas($title,$type,$subject,$writer,$content,$imglink);
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
<div id="formcontainer" style="padding-left:30px;width:700px;height:800px;">
        <form action="<?php $_PHP_SELF ?>" method="post" enctype="multipart/form-data">
        <label for="postTitle" style="font-size:20px;">Post Title</label><br>
        <input type="text" name="postTitle" id="postTitle" style="border:1px solid rgba(0,0,0,0.63);font-size:16px;width:650px;height:33px;border-radius:2px"><br><br>


        <label for="postType" style="font-size:20px;">Post Type</label><br>
        <select name="postType" id="postType" style="font-size:16px;width:650px;height:33px;border-radius:2px;">
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
        <input type="text" name="postWriter" id="postWriter" style="border:1px solid black;font-size:16px;width:650px;height:33px;border-radius:2px"><br><br>


         <lable for="textarea" style="font-size:20px">Content</lable>
            <br>
        <textarea rows="20px" cols="105px" name="textarea" id="textarea"></textarea><br><br>


            <input type="file" name="file" id="file" rows="33px">
            <div style="float:right;margin-right:50px">
            <input type="submit" name="submit" value="Cancel" style="color:blue;width:60px;height:35px;background:white;border:0;border:2px solid blue;border-radius:3px;border-color:#a797ff;font-size:17px;">
            <input type="submit" name="submit" value="Post" style="color:white;width:60px;height:35px;background:blue;border:0;border-radius:3px;border-color:#a797ff;font-size:17px;">
            </div>

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