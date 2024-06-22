<!doctype html>
<html>
<head>
    <title>Hello, World!</title>
</head>
<body>
<h1>Hello, World!</h1>
<p>Today is: <?php echo date("d / m / Y") ?></p>
<p>
    <?php
    $now = time();
    $newyear = strtotime('2019-04-13');
    $sec_left = $newyear - $now;
    echo floor($sec_left / (60 * 60 * 24));
    ?>
    days before Happy New Year.
</p>
</body>
</html>