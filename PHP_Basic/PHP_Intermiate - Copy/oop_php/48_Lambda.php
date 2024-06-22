<?php
//Lambda is same to the anonymous function.
function concrete($para3){
    $para3();
}
concrete(function(){
   echo "I am Lambda(anonymous) functiomn";
});


function nextOne($para1,$para2,$para3){
    $all=$para1+$para2;
    $para3($all);

}
nextOne(1,4,function($all){
    echo "The total is {$all}";
});