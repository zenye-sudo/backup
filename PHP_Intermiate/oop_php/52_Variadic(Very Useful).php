<?php
function fun(...$para){
//    Form $para=["One","Two","Three"];
    echo $para[2];

}
fun("One","Two","Three");

echo "<hr>";

function funa(...$para){
  echo $para[0][2];
}
funa(["One","Two","Three"],"Two","Three");