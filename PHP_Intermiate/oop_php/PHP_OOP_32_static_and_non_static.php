<?php
//non-static   => static can call
//static       =>non_static can't call
//_______________________________________________________________________________
//********non_static can called static*****
//class One{
//static public $name="zenye";
//function fun(){
//    echo $this::$name;
//}
//}
//$obj=new One();
//echo $obj->fun();

//**********static can't called non-static*****
//class One{
//    public $name="zenye";
//    public static function hey(){
//        echo $this::$name;
//    }
//}
//$obj=new One();
//echo $obj->hey();

//***********static can call static.
class One{
    static $name="zenye";
    static  function fun(){
    echo self::$name;
}
}
$obj=new One();
echo One::fun();
