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
<div id="login">
    <form action="pages/login.php" method="post">
        <label for="email">Email:</label>
        <input type="text" name="email" id="email">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <input type="submit" name="submit" id="submit" value="Login">
    </form>
</div>
<div id="register">
    <form action="pages/register.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username">
        <label for="email">Email:</label>
        <input type="text" name="email" id="email">
        <label for="password">Password:</label>
        <input type="text" name="password" id="password">
        <input type="submit" name="submit" id="submit" value="Register">
    </form>
</div>
</body>
</html>