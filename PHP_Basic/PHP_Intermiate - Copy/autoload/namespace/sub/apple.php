<?php
namespace sub;
class apple{
    private $name;
    public function __construct($name){
        $this->name=$name;
    }
    public  function name(){
        echo "Your name is ".$this->name;
    }
}