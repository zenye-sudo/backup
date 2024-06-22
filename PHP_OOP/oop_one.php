<?php

//class One{
// function test(){
//     echo "Hello";
// }
//}
//$newobject=new One();
//echo $newobject->test();

//-----------------------------------------------------
//***********class properties,multiple class instance,Use this keyword call properties from Methods.*****************
//class One{
//    var $name;
//    var $age;
// function hey(){
//     echo "Name is  ".$this->name." and age is ".$this->age."<br>";
// }
//}
//$he=new One();
//$he->name="zenye";
//$he->age="17";
//$he->hey();
//
//$she=new One();
//$she->name="hla hla";
//$she->age="17";
//$she->hey();
//----------------------------------------------------------------
//********************Inheritance**********************************
//class One{
//    var $name="zenye";
//    function hey(){
//      echo $this->name;
//    }
//}
//class Two extends One{
//
//}
//$new=new Two;
//echo $new->hey();
//-------------------------------------------------------------------

//************************************Access Modifier&**************************
//class One{
//    public $one="one public<br>";//Everyone can use
//    private $two="two private<br>";//usable only inside class
//    protected  $three="three protected<br>";//Usable only inside class and its sub class.
//    function hey(){
//        echo $this->two;
//    }
//}
//class Two extends One {
//    function hey2(){
//        echo $this->three;
//    }
//}
// $one=new One();
//echo $one->one;
//echo $one->hey();
//$two=new Two();
//echo $two->hey2();
//-----------------------------------------------------------------------------------
//**************************Getter and Setter*****************************
//class One{
//    private $name="zenye<br>";

//    function orange(){
//         $this->name="yezen";
//    }
//    function apple(){
//        return $this->name;
//    }
//}
//$one=new One();
//echo $one->orange();
//echo $one->apple();
//------------------------------------------------------------------------------
//**************************************Static Keywords**************************************
// class One{
//    public $name="zenye<br>";
//    public static $age="17<br>";
//    public static function many(){
//        echo One::$age;
//    }
// }
//$obj=new One();
//echo $obj->name;
////******Here is the important****
//echo $obj::$age;
//echo One::$age;
//echo $obj::many();
//----------------------------------------------------------------------------------------------

//*********************************Constructor and Destructor****************************************
//class One{
//function __construct()
//{
//    echo "I am a constructor and I work when class was invoked";
//}
//function hey($var="i am default value"){
//    echo "<br>I am a method.". $var;
//}
//function __destruct()
//{
//   echo "<br>I am a destructor and I work after class is property and method work<hr>";
//}
//}
//$obj=new One();
//echo $obj->hey();
//-----------------------------------------------------------------------------------------



//*****************************More function************************************
class One{
    function __construct()
    {
        echo "Constructor";
    }

    function hey(){
        echo "Hello";
    }
    function __destruct()
    {
        echo "Destructor";
    }
}
$declared=get_declared_classes();//declared classes
$methods=get_class_methods("One");
$obj=new One();
foreach($declared as $item){
    echo $item."<br>";
}
echo "<hr>";
foreach($methods as $item){
    echo $item."<br>";
}
echo "<hr>";
if(method_exists($obj,"hey")){
    echo "Method is exists.";
}