<?php
require_once "init.php";
require_once "index.php";
if(isset($_GET['type'],$_GET['id'])){
    $type=$_GET['type'];
    $articleid=(int)$_GET['id'];
    switch ($type){
        case "article":
            $result=$db->query("
            INSERT INTO article_likes(user,article)
            SELECT {$_SESSION['user_id']},{$articleid} FROM articles
            WHERE EXISTS(
            SELECT id FROM articles WHERE id={$articleid}
            )AND NOT EXISTS (
            SELECT id FROM article_likes WHERE user={$_SESSION['user_id']} AND article={$articleid}
            )LIMIT 1
            ");
            break;
    }
}
header("location:index.php");