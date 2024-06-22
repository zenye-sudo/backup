<?php
class lohal{
    private $name;
    public function __construct($name){
     $this->name=$name;
    }
    public function lohal(){
        return "YOur name is".$this->name."<br>";
    }
}