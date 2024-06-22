<?php
require_once "connection.php";
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest";
}
if(!is_ajax_request()){exit;}
$one=isset($_POST['one']) ? $_POST['one'] : "";
$two=isset($_POST['two']) ? $_POST['two'] : "";
/**
 * (x+1)*(x+1)
 * (y+1)*(y+1)
 */
/**Formula for table name*/
$onef1=$one+1;
$onef2=$onef1*$onef1;
$twof1=$two+1;
$twof2=$twof1*$twof1;
$formula=$onef2+$twof2;
/**Formula for table name*/

/**For check table exists or no exists start**/
$checkTabel=$db->prepare("SELECT COUNT(*) FROM `{$formula}`");
$checkTabel->execute();
if($checkTabel->rowCount()>0){echo "table and conservation created";}else{
/**For create Table Start*/
    $createTable=$db->prepare("
CREATE TABLE IF NOT EXISTS `{$formula}`(
`id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
`uid` INT(11) NOT NULL,
`text` VARCHAR (255) NOT NULL,
`created_at` TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP
)
");
    $createTable->execute();
    $db->exec("INSERT INTO conservation(uid,tn) VALUES ({$two},{$formula})");
    echo "table and conservation created";
/**For create Table End*/
}/**For check table exists or no exists End*/
$oneConservation=$db->prepare("SELECT count(*) FROM conservation where uid={$one} AND tn={$formula}");
$oneConservation->execute();
if($oneConservation->fetchColumn()==0){
    $db->exec("INSERT INTO conservation(uid,tn) VALUES ({$one},{$formula})");
}
$twoConservation=$db->prepare("SELECT count(*) FROM conservation where uid={$two} AND tn={$formula}");
$twoConservation->execute();
if($twoConservation->fetchColumn()==0){
    $db->exec("INSERT INTO conservation(uid,tn) VALUES ({$two},{$formula})");
}



