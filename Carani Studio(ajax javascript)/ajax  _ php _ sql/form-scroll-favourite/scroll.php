<?php
session_start();
$username="";
if(isset($_SESSION['username'])){
    $username=$_SESSION['username'];
}else{
    header("location:index.php");
}
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest";
}
if(!is_ajax_request()){
    exit;
}
$page=isset($_GET['page']) ? $_GET['page'] : "10";
$db=new PDO("mysql:host=localhost;dbname=cs(infinite scroll and like)","root","");
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$result=$db->prepare("SELECT * FROM posts LIMIT $page,10");
$result->execute();
$result->setFetchMode(PDO::FETCH_ASSOC);
    ?>
    <?php foreach($result as $key=>$value): ?>
        <?php
        $likecounter=$db->prepare("SELECT COUNT(*) FROM likecs WHERE pid={$value['id']}");
        $likecounter->execute();
        $likecounter->setFetchMode(PDO::FETCH_ASSOC);
        $likeunlike=$db->prepare("SELECT COUNT(*) FROM likecs WHERE pid={$value['id']} AND uid='{$username}'");
        $likeunlike->execute();
        $likeunlike->setFetchMode(PDO::FETCH_ASSOC);
        ?>
        <div id="<?php echo $value['id'] ?>" class="style">
            <p id="title"><?php echo $value['title'] ?></p>
            <span id="writer">Writer=><?php echo $value['wirter'] ?></span>
            <p><?php echo substr($value['content'],0,100)?></p>
            <button id="moredetails">More Details...</button>
            <?php if($likeunlike->fetchColumn()==1){ ?>
                <button class="unlike" data-pid="<?php echo $value['id'] ?>" data-uid="<?php echo $username ?>">Unlike</button>
                <button class="like hide" data-pid="<?php echo $value['id'] ?>" data-uid="<?php echo $username ?>">Like</button>
            <?php }else{ ?>
                <button class="unlike hide" data-pid="<?php echo $value['id'] ?>" data-uid="<?php echo $username ?>">Unlike</button>
                <button class="like" data-pid="<?php echo $value['id'] ?>" data-uid="<?php echo $username ?>">Like</button>
            <?php } ?>
            <span id="<?php echo $value['id'] ?>" class="likecounter"> <?php echo $likecounter->fetchColumn() ?> Likes</span>
        </div>
    <?php endforeach;?>