<?php
$ary=[
    ["One","Two","Three","Four"],
    ["One","Two","Three","Four"],
    ["One","Two","Three","Four"],
    ["One","Two","Three","Four"],
];
$string=serialize($ary);
echo $string."<hr>";
$array=unserialize($string);
echo "<pre>".print_r($array,true)."</pre>";