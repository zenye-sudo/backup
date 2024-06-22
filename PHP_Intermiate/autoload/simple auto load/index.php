<?php
//require_once ("sub/lohal.php");
//require_once ("sub/hello.php");
         //OR
//******Simple Load*****
require_once ("sub/Loader/Loader.php");
class Index{
    public function __construct()
    {
     Load::Loader("sub/lohal");
     $lohal=new lohal("Zen Ye");
     echo $lohal->lohal();


     Load::Loader("sub/hello");
     $hello=new Hello(12);
     echo $hello->Hello();


    }
}
$obj=new Index();
