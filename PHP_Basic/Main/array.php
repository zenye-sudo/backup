<?php 
$ary=array("zanye","yezen","kweeye");echo $ary[0];//Numeric array or indexed array
$ary=array("one"=>"zenye","two"=>"yezen","three"=>"kweeye");echo $ary["one"];//associative array//
$ary=array(
   array("one"=>"zenye","two"=>"yezen","three"=>"kweeye"),
   array("four"=>"zenye","five"=>"yezen","six"=>"kweeye"),
   array("seven"=>"zenye","eight"=>"yezen","nine"=>"kweeye")
);echo $ary[1][1]//multidimesional array
$ary=[
    ["one"=>"zenye","two"=>"yezen","three"=>"kweeye"],
    ["four"=>"zenye","five"=>"yezen","six"=>"kweeye"],
    ["seven"=>"zenye","eight"=>"yezen","nine"=>"kweeye"],
    ["ten"=>"zenye","eleven"=>"yezen","thirteen"=>"kweeye"]
];//This is short array in php 5.4
 ?>