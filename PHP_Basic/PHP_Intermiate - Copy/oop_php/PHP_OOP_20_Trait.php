<?php
trait One{
    var $name="zenye<br>";
}
trait Two{
    var $age="17<br>";
}

trait Three{
    var $re="single<br>";
}
class All{
    use One;
    use Two;
    use Three;
//    OR
//use One,Two,Three;
}
$obj=new All();
echo $obj->name;
echo $obj->age;
echo $obj->re;