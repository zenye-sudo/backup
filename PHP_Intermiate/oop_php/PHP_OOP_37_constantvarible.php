<?php
class One{
    public const DB_HOST="localhost";
    public const DB_USER="root";
    public const DB_PASS="";
    public const DB_NAME="test";

    public function __construct()
    {
        echo self::DB_HOST;
    }
}
$obj=new One();
//PDO kyan thay tal naw.