<?php
//Simple Form
//class One{
//    public  $count=0;
//    function count(){
//        $this->count++;
//        echo $this->count;
//        echo "<br>";
//    }
//}
//$obj=new One();
//$obj->count();
//$obj->count();
//
//$obj2=new One();
//$obj2->count();
//$obj2->count();

//Static Form
class One{
    public static $count=0;
    function count(){
        $this::$count++;
        echo $this::$count;
        echo "<br>";
    }
}
$obj=new One();
$obj->count();
$obj->count();

$obj2=new One();
$obj2->count();
$obj2->count();