<?php
require_once "init.php";
$qry=$db->query("
SELECT articles.id,articles.title,COUNT(article_likes.id) as count,GROUP_CONCAT(users.name SEPARATOR '|') as liked_by
FROM articles
LEFT JOIN article_likes
ON article_likes.article=articles.id
LEFT JOIN users
ON article_likes.user=users.id
GROUP BY articles.id;
");
while($rows=$qry->fetch_object()){
    $rows->liked_by=$rows->liked_by ? explode('|',$rows->liked_by) : [];
    $article[]=$rows;
}
//echo "<pre>".print_r($article,true)."</pre>";
////die();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php foreach($article as $item) :?>
    <h3><?php echo $item->title ?></h3>
    <a href="like.php?type=article&id=<?php echo $item->id ?>" id="like">Like</a>
    <p><?php echo $item->count ?> like this post.</p>
    <?php if(!empty($item->liked_by)) :?>
    <ul>
        <?php foreach($item->liked_by as $value ) :?>
        <li><?php echo $value;?></li>
        <?php endforeach; ?>
    </ul>
        <?php endif; ?>
<?php endforeach;?>
<script type="text/javascript">
    var btn=document.getElementById("like");
    var dynamic="hey";
    if(dynamic=="hey"){
        btn.innerHTML="unlike";
    };
    btn.addEventListener("click",function () {
    dynamic="change";
    },true);

</script>
</body>
</html>
