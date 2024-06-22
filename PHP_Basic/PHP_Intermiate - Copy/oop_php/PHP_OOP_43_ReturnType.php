<?php
class PHP_OOP_43_ReturnType{
    public $name;
    public function setter(string $data){
        $this->name=$data;
    }
   public function getter() : string {
       return $this->name;
   }
}
$obj=new PHP_OOP_43_ReturnType();
$obj->setter("zenye");
echo $obj->getter();