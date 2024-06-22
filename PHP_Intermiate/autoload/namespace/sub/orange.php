<?php
namespace sub;
class orange{
    private $age;
    public function __construct($age)
    {
        $this->age=$age;
    }
    public function orange(){
        echo "Your age is ".$this->age;
    }
}