<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/fontawesome-free-5.0.11/fontawesome-free-5.0.11/web-fonts-with-css/css/fontawesome-all.css">
</head>
<body>
<?php
require_once "include/session.php";
require_once "include/aac.php";
require_once "include/navbar.php";
require_once "include/section.php";

?>
<!--Pangination System start-->
<?php
$check=$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$result=$db->prepare("SELECT COUNT(id) FROM posts");
$result->execute();
$result->setFetchMode(PDO::FETCH_ASSOC);
$count=$result->fetchColumn();
$num=0;
?>
<div class="container mb-4 mt-3">
<ul class="pagination justify-content-center">
    <?php for($i=0;$i<$count;$i+=7) :?>
        <?php ++$num; ?>
        <li class="page-item"><a href="index.php?paid=<?php echo $i ?>" class="page-link"><?php echo $num ?></a></li>
    <?php endfor; ?>

</ul>
</div>
<!--Pangination System End-->
<?php
require_once "include/footer.php";
?>

<script src="bootstrap/script/jquery-3.3.1.min.js"></script>
<script src="bootstrap/script/jquery-3.3.1.slim.min.js"></script>
<script src="bootstrap/script/popper.min.js"></script>
<script src="bootstrap/script/tether.js"></script>
<script src="bootstrap/script/bootstrap.min.js"></script>

</body>
</html>