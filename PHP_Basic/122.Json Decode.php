<?php 
$filename="Test/she.json";
$handler=fopen($filename,'r');
$json=fread($handler,filesize($filename));

$arys=json_decode($json);
print_r($arys);

// foreach($arys as $ary){
//    foreach($ary as $key=>$value){
//         echo $key."=>".$value."<br>";
//    }
// }

 ?>