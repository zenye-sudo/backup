<?
try{
   $db=new PDO("mysql:host=localhost;dbname=chat","root","");
}catch(Exception $e){
    die("Error :".$e->getMessage());
}