<?php
setcookie("useridKoMoney",$_COOKIE['useridKoMoney'],(time()-3600*24*31*12*10),'/','',0);
setcookie("usernameKoMoney",$_COOKIE['usernameKoMoney'],(time()-3600*24*31*12*10),'/','',0);
session_destroy();
header("location:index.php");