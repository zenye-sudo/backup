<?php
$db=new PDO("mysql:host=localhost;dbname=techcoder","root","ituser9");
session_start();
class MySession{
    public function __construct($key,$value,$key1,$value1)
    {
        $_SESSION[$key]=$value;
        $result=$_SESSION[$key1]=$value1;
        echo $result ? "Success!":"fail";
    }

    static function checkSession($key){
        return isset($_SESSION[$key]);
    }
        static function getSession($key){
        return $_SESSION[$key];
    }
    static function adminGetSession($k){
        return $_SESSION[$k];
    }
}
// new MySession("name","zenye","email","zenye@gmail.com");
//echo MySession::adminGetSession("email");

