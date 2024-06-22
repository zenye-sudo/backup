<?php
try{
//    $filehandler=fopen("note.txt","r");
    if(file_exists("test.txt")){
        echo "Shi tal";
    }else{
        throw new Exception("Ma shi buu");
    }
}catch (Exception $e){
    echo $e->getMessage();
}