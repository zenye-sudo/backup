<?php
//Checking DataTypees
//is_int
//is_string
//is_bool
//is_NULL
//is_float
class One{
    function hey($data){
     if(is_null($data)){
         echo "True";
     }else{
         echo "False";
     }
    }
}
$obj=new One();
$obj->hey(NULL);