<?php
namespace sub\sub2;
class grape{
    private $professional;
    public function __construct($pro)
    {
        $this->professional=$pro;
    }
    public function grape(){
        echo "Your professional work  is ".$this->professional;
    }
}