<?php
function fun(...$para){
    echo $para[0] ?? "There are nothing parameters.";
}
fun();