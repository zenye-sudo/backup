<?php
$array=array(
    "Short Context",
    "Medium Context",
    "Long Context"
);
$test=json_encode($array,JSON_FORCE_OBJECT);
echo $test;