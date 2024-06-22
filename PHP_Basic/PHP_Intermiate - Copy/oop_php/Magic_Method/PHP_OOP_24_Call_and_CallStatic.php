<?php
class One{
function __call($name, $arguments)//This method is only work if ma shi thaw function ko len kaw len
{
     echo "Your are tring to call none exists methods {$name} with values";
     echo "<pre>".print_r($arguments,true)."</pre><hr>";
}
public static function __callstatic($name,$arguments){//This method is same to upper method.
  echo "Your are tring to call none exitst methods{$name} with values";
  echo "<pre>".print_r($arguments,true)."</pre>";
}
}
$obj=new One();
$obj->new("Mg Mg");


One::__hey("Mg Mg");

