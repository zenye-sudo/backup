
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="bootstrap/fontawesome-free-5.0.11/fontawesome-free-5.0.11/web-fonts-with-css/css/fontawesome-all.css"> -->
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

<!-- <script src="bootstrap/script/jquery-3.3.1.min.js"></script>
<script src="bootstrap/script/jquery-3.3.1.slim.min.js"></script> -->
<!-- <script src="bootstrap/script/popper.min.js"></script>
<script src="bootstrap/script/tether.js"></script>
<script src="bootstrap/script/bootstrap.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
</body>
</html>