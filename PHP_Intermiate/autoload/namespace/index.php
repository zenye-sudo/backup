<?php
require_once ("sub/apple.php");
require_once ("sub/orange.php");
require_once ("sub/sub2/grape.php");
//use sub\sub2 as sub2;
   //Same to
use sub\sub2;
class Index{
    public function __construct()
    {
        $obj=new sub\apple("zenye");
        $obj->name();

        $obj2=new \sub\orange(12);
        $obj2->orange();

        $obj3=new sub2\grape("web developer");
        $obj3->grape();
    }

}
new Index();