<?php
//Simple
$auto=new stdClass();
try{
    $db=new PDO("mysql:host=localhost;dbname=store","root","");
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $auto->content="Connection Successful!";
}catch(Exception $e){
    $auto->content="Connection Fail!";
}
echo $auto->content;
echo "<br>";
//Inside Class
class One{
    const DB_HOST="localhost";
    const DB_NAME="store";
    const DB_USER="root";
    const DB_PASS="34";
    public $db;
    public $message;
    public function __construct()
    {
        try{
            $this->db=new PDO("mysql:host:".self::DB_HOST.";dbname=".self::DB_NAME,self::DB_USER,self::DB_PASS);
            $this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->message="Database Connection Successful!";
        }catch (Exception $e){
            $this->message="Database Connection Fail!";
        }
    }
}
$obj=new One();