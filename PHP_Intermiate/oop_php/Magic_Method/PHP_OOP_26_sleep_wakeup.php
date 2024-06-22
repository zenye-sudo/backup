<?php
class One{
    function __sleep()
    {
        echo "YOu are tring to serialize my class object<br>";//This method is work when this method is serialized.
        return [];
    }
    function __wakeup()
    {
      echo "You are trying to deserialize my class object.";
    }
}
$one=new One();
$de=serialize($one);
unserialize($de);