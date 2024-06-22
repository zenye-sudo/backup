
<!--Navigation Start-->

<div class="navcontainer">
    <nav>
        <img src=".\photos\download.png"  width="100px" height="75px">
        <?php
        if(checkSession("username")){
            echo '<form action="searchpage.php" method="get">
            <input type="text" name="keywords" placeholder="Search" id="search"><input type="submit" id="button" value="Search">
        </form>';
        }else{
                    if(!checkSession($username)){
                header("location:index.php");
            }
        }
        ?>

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
                        $rows=allPostCount(2);
                        echo  "<li><a href=\"logout.php\">Logout</a></li>";
                    }else{
                        echo "<li><a href=\"login.php\">Login</a></li>
                    <li><a href=\"register.php\">Register</a></li>";
                        $rows=allPostCount(1);
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
<!--SideBar Start-->
<!--SideBar End-->
<!--Sectioin Start-->
<?php
$rows="";
$new=0;
if(isset($_GET['new'])){
    $new=$_GET['new'];
}else{
    $new=0;
}
if($_GET['keywords']=="" AND $_GET['new']==""){
    header("location:index.php");
}else{
    $db=dbConnect();
    $keywords=$_GET['keywords'];
    $preg=preg_replace("/[^A-Za-z-9]/","",$keywords);
    $preg=mysqli_real_escape_string($db,$keywords);
    $qry="SELECT * FROM post WHERE content LIKE '%$preg%' OR writer LIKE '%$preg%' OR created_at LIKE '%$preg%' LIMIT $new,6";
    $result=mysqli_query($db,$qry);
    $qry1="SELECT * FROM post WHERE content LIKE '%$preg%' OR writer LIKE '%$preg%' OR created_at LIKE '%$preg%'";
    $result1=mysqli_query($db,$qry1);
    $rows=mysqli_num_rows($result1);
//    echo "<pre>".print_r($result,true)."</pre>";
    foreach($result as $item){
        $pid=$item['id'];
        if($item["type"]==1){
        $type="FREE";
        }else{
        $type="PAID";
        }
        echo '<div id="auto"><h2>'.$item["title"].'</h2><p id="type">'.$type.'</p>
        <p>'.substr($item["content"],0,500).'</p>
       <a href="postDetails.php?pid='.$pid.'">Details</a></div>';



    }
}

?>
<div id="pagination" style="width:100%;text-align:center;margin-bottom:20px;margin-top:10px;">
    <nav>
        <ul>
            <?php
            $num=0;
            for($i=0;$i<$rows;$i+=6){
                $num++;
                echo '<li><a href="searchpage.php?keywords='.$_GET['keywords'].'&new='.$i.'">'.$num.'</a></li>';
            }
            ?>
        </ul>
    </nav>
</div>

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
