<?php
define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASS","ituser9");
define("DB_NAME","php_basic_blog");
date_default_timezone_set("Asia/Rangoon");

function dbConnect(){
    $dbConnect=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    if(mysqli_connect_errno($dbConnect)==0){
        return $dbConnect;
    }else{
        echo "Database Connection Fail!";
    }
};
$db=dbConnect();