<?php
$ary=["One"=>1,"Two"=>2,"Three"=>3];
function vare($key,$value){
    echo "Key is ".$key." value is ".$value ."<hr>";
}
array_walk($ary,"vare");