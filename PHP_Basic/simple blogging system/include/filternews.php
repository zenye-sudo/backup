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
<!--SideBar Start-->
<div id="scontainer">
    <div>
        <ul>
            <li class="s"><a href="#">HTML ADVANCED </a></li>
            <li class="s"><a href="#">CSS ADVANCED  </a></li>
            <li class="s"><a href="#">JAVASCRIPT ADVANCED </a></li>
            <li class="s"><a href="#">JQUERY ADVANCED </a></li>
            <li class="s"><a href="#">BOOTSTRA ADVANCED </a></li>
            <li class="s"><a href="#">PHP ADVANCED </a></li>
            <li class="s"><a href="#">MYSQL ADVANCED </a></li>

        </ul>
    </div>
</div>
<!--SideBar End-->
<!--Sectioin Start-->
<?php

//$array="";
$rows="";

$start=0;
if(substr($_GET['pid'],7,2)!=""){
    $start=substr($_GET['pid'],7,2);
}else{
    $start=0;
}

if(checkSession("username")){
    $array=filteredposts(2,substr($_GET['pid'],0,1),$start);
    $rows=filteredpoststwo(2,substr($_GET['pid'],0,1));
}else{
    $array=filteredposts(1,substr($_GET['pid'],0,1),$start);
    $rows=filteredpoststwo(1,substr($_GET['pid'],0,1));
}











$type="";
echo $type;
foreach($array as $post){
    $pid=$post['id'];
    if($post["type"]==1){
        $type="FREE";
    }else{
        $type="PAID";
    }
    echo '<div id="auto"><h2>'.$post["title"].'</h2><p id="type">'.$type.'</p>
         <p>'.substr($post["content"],0,500).'</p>
         <a href="postDetails.php?pid='.$pid.'">Details</a></div>';
}
?>

<!--Session End-->
<div id="pagination" style="width:100%;text-align:center;margin-bottom:20px;margin-top:10px;">
    <nav>
        <ul>
            <?php
            $num=0;
            for($i=0;$i<$rows;$i+=6){
                $num++;
                echo '<li><a href="filternews.php?pid='.substr($_GET['pid'],0,1).'start='.$i.'">'.$num.'</a></li>';
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