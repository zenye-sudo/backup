<?php
class One{
  public function __get($var){
      echo "You are trying to get none exist property {$var} property<hr>";
  }
  public function __set($var,$value){
      echo "You are trying to get none exists method {$var} with value of {$value}";
  }
}
$obj=new One;
$obj->name;
$obj->name="zenye";