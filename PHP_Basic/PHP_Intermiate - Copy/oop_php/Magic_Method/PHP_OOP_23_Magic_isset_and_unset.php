<?php
class One{
function __isset($name)
{
   echo "You are trying to check none property <span style='color:red'>{$name}</span><hr>";
}
    function __unset($name)
    {
        echo "You are trying to check the unset property <span style='color:red'>{$name}</span><hr>";
    }
}
$obj=new One();
isset($obj->name);
unset($obj->name);