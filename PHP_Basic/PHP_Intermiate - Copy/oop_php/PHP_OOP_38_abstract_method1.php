<?php
//abstract method never have body.
//class must be abstract when there is an abstract method.
//must overwrite all the abstract method when it has at least one abstract method.
abstract class Index{
    const DB_HOST="localhost";//constant varible;
    public abstract function hey();
}
class One extends Index{

    public function hey()
    {
       echo "Hello";
    }
}
$obj=new One();
$obj->hey();