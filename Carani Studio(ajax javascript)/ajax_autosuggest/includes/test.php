<?php
$file=file("us_train_names.txt",FILE_IGNORE_NEW_LINES);
echo "<pre>".print_r($file,true)."</pre>";
$text="zenye";
if(strpos($text,"zenye")===0){
    echo "True";
}else{
    echo "fale";
}

