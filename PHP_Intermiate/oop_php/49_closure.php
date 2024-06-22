<?php
$num=2323;
$var=function() use ($num){
  echo "The number is {$num}";
};
$var();
echo "<hr>";

function concrete($para1){
    $para1();
}
concrete(function()use ($num){
   echo $num;
});