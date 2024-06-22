<?php
class Hello{
    private $age;
    public function __construct($age){
        $this->age=$age;
    }
    public function Hello(){
        return "Your age is ".$this->age."<br>";
    }
}