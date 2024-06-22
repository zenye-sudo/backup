<?php
class One{
    function callMe(){
        return __CLASS__;
    }
     function dif(){
        echo static::callMe();
    }
}
$obj=new One();
$obj->dif();

echo "<hr>";

class Two extends One{
    function callMe(){
        return __CLASS__;
    }
}
$obj2=new Two();
echo $obj2->dif();