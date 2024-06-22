<!-- <style>
    #hey:hover>#change{
        color:white;
    }
</style> -->
<!--Section is Start-->
<div class="container-fluid">
    <div class="row">
        <!--         article start-->
        <?php
        $db=new PDO("mysql:host=localhost;dbname=techcoder","root","ituser9");
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

        if(!isset($_GET['paid'])){
            $result=$db->prepare("SELECT * FROM posts LIMIT 0,6");
        }else{
            $result=$db->prepare("SELECT * FROM posts LIMIT $_GET[paid],7");
        }

        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);
        ?>

            <div class="col-md-8  mb-4">
                <?php foreach($result->fetchAll() as $item) : ?>

                    <?php
                $typechange="";
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
                    //For First Photo Start
                    $unserialize=unserialize($item['imglink1']);
//                   For First Photo End
                ?>
                <div class="card border-0 mb-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white header"><?php echo $item['title'] ?></h3>
                        <div class="container row">
                            <div class="col-md-2 bg-warning"><a href="#" class="text-white"><i class="fa fa-pencil-alt"></i><?php echo $item['wirter'] ?></a></div>
                            <div class="col-md-3 bg-success"><a href="#" class="text-white"><i class="fa fa-clock "></i><?php echo $item['created_at'] ?></a></div>
                            <div class="col-md-2 bg-secondary"><a href="#" class="text-white"><i class="fab fa-digital-ocean"></i><?php echo $typechange ?></a></div>
                            <?php if(MySession::checkSession("username")): ?>
                                <div class="col-md-2 bg-info"><a href="index.php?lid=<?php echo $item['id'] ?>" class="text-white" id="test" ><i class="fa fa-hand-peace"></i>Like <span class="badge bg-danger"> <?php echo $likecount->fetchColumn()?></span></a></div>
                            <?php endif; ?>
                            <?php if(!MySession::checkSession("username")):?>
                                <div class="col-md-2 bg-info"><li style="color:white;list-style-type: none"><i class="fa fa-hand-peace"></i> Like <span class="badge bg-danger"> <?php echo $likecount->fetchColumn()?></span></li></div>
                            <?php endif ;?>
                            <div class="col-md-3 bg-danger"><a href="#" class="text-white"><i class="fa fa-comment"></i>comments <span class="badge bg-info"> <?php echo $commentcount->fetchColumn()?></span></a></div>
                        </div>
                    </div>
                    <div class="card-block bg-light">
                        <div class="container row">
                            <div class="col-md-3 mt-3 text-center">
                                <img src="postimg/<?php echo $unserialize[0] ?>" alt="bg" class="photocut mt-lg-3 justify-content-center">
                            </div>
                            <div class="col-md-9 ">
                                <p class="text-justify english ml-lg-3" style="text-indent: 20px"><?php echo substr($item['content'],1,460) ?></p>
                                <button class="btn btn-outline-primary float-right mb-3" id="hey"><a id="change" href="postdetails.php?epid=<?php echo $item['id'] ?>" style="text-decoration:none">Read More</a></button>
                            </div>

                        </div>
                    </div>

                </div>
                <?php endforeach; ?>
            </div>
        <!--         article end-->
        <!--         nav start-->
        <div class="col-md-4">
            <div class="card border-0">
<!--                Card Header start-->
                <div class="bg-dark" style="height:50px;border-top-right-radius:5px;border-top-left-radius:5px;">
                    <div class="row  container-fluid m-0 p-0">
                        <div class="col-6 bg-info"  id="tab1" onclick="show1()"><ul class="nav"><li class="hey text-white" style="text-align:center;list-style-type:none;line-height:50px;">Popular Posts</li></ul></div>
                        <div class="col-6"  id="tab2" onclick="show2()"><ul class="nav"><li class="hey text-white" style="list-style-type:none;line-height:50px;">Recent Posts</li></ul></div>
                    </div>
            </div>
<!--                Card Header end-->
<!--                For First Show1 Start-->
                <div id="show1"> <!-- For show1--!>
                <?php for($i=0;$i<7;$i++):?>
                    <?php
                    $result=$db->prepare("SELECT * FROM posts WHERE id=$ary[$i] ");
                    $result->execute();
                    ?>
                    <?php foreach($result as $hey): ?>
                        <?php
                        $unserialize1=unserialize($hey['imglink1']);
//                        echo $unserialize
                        ?>
                        <div class="card-block mt-4">
                            <div class="container row">
                                <div class="col-3"><img src="postimg/<?php echo $unserialize1[0] ?>" alt="" style="width:100px;height:70px;"></div>
                                <div class="col-9">
                                    <a href="postdetails.php?epid=<?php echo $hey['id'] ?>" style="font-size:17px;font-family:Cambria" class="ml-3"><?php echo $hey['title'] ?></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endfor;?>
                </div>
                <div id="show2" style="display:none;"> <!-- For show1--!>
                                <?php
                      $recentposts=$db->prepare("SELECT * FROM posts ORDER BY created_at DESC LIMIT 6");
                      $recentposts->execute();
                      $recentposts->setFetchMode(PDO::FETCH_ASSOC);
                    ?>
                    <?php foreach($recentposts as $hey): ?>
                        <?php
                            $unserialize1=unserialize($hey['imglink1']);
                            ?>
                        <div class="card-block mt-4">
                            <div class="container row">
                                <div class="col-3"><img src="postimg/<?php echo $unserialize1[0] ?>" alt="" style="width:100px;height:70px;"></div>
                                <div class="col-9">
                                    <a href="postdetails.php?epid=<?php echo $hey['id'] ?>" style="font-size:17px;font-family:Cambria" class="ml-3"><?php echo $hey['title'] ?></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <hr>
            </div>
        </div>
    </div>
<!--                For First Show 1 End-->
</div>
        </div>
            <!--nav end-->
<!--Section is End-->
<script>
    function get(obj){
        return document.getElementById(obj);
    }
    function show1(){
        get("tab1").classList.add("bg-info");
        get("tab2").classList.remove("bg-info");
        get("show1").style.display="block";
        get("show2").style.display="none";
    }
    function show2(){
        get("tab2").classList.add("bg-info");
        get("tab1").classList.remove("bg-info");
        get("show1").style.display="none";
        get("show2").style.display="block";
    }
</script>