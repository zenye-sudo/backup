<?php
//$num=23;
//$function=function(){
//    global $num;         //PHP mar varible ko function hte ka nay lane kaw lo ma ya buu.So,I use globla keywords.
//    echo "I am anonymous{$num}";
//};
//$function();
$num=234;
$function=function($data){
    $data=5345;
  echo "Data 1 is {$data}";
};
echo $num ."<br>";
$function($num);echo "<br>";
echo $num."<br>";
//OR//
$num=234;
$function=function(&$data){
    $data=5345;
    echo "Data 1 is {$data}";
};
echo $num ."<br>";
$function($num);echo "<br>";
echo $num."<br>";
