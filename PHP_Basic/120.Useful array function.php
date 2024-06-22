<?php 
$ary=array();
echo count($ary)."<br>";
array_push($ary,"ONE");
array_push($ary,"TWO");
array_push($ary,"THREE");
echo count($ary)."<br>";
array_pop($ary);//Lastest Cut
echo count($ary)."<br>";
array_shift($ary);
echo count($ary)."<br>";//Frontest Cut

 ?>