<?php
$ary=["one"=>1,"two"=>2,"three"=>3,"four"=>4,"five"=>5];
echo "array form is ".$ary['one'];
echo "<br>";
echo var_dump($ary);
$obj=(object) $ary;
echo var_dump($obj);
echo "<br>";
echo "Object form is ".$obj->one;