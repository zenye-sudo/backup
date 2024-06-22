<?php
///////////////////////Ma Ya Par///////////////////////
//$ary=["One"=>1,"Two"=>2];
//$var=function($key,$value){
//    echo "Key is ".$key." and value is ".$value;
//};
//array_walk($ary,$var());
$num=0;
$ary=["One"=>1,"Two"=>2,"Three"=>3];
array_walk($ary,function($key,$value)use (&$num){
    $num=++$num;
echo "Key is ".$key." and value is ".$value ."Increment is ".$num."<hr>";
});