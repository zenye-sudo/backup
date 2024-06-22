<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="assets/public.css">
    <script src="assets/public.js"></script>
</head>
<body>
<div id="main">
    <div id="header">
        <div id="navigation">
            <a href="index.php">Main Page</a>
        </div>
        <div id="search-area">
            <form action="search.php" method="GET" id="search-form">
                <?php $q=isset($_GET['q']) ? $_GET['q'] : ""; ?>
                <input type="text" id="search" name="q" value="<?php echo htmlspecialchars($q); ?>">
                <input type="submit" value="Search"/>
            </form>
            <ul id="suggestions">
            </ul>
        </div>
    </div>
<!--    <div id="footer">-->
<!---->
<!--    </div>-->
<!--</div>-->
<!--</body>-->
<!--</html>-->
