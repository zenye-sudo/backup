<?php
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
}
if(!is_ajax_request()){exit;};
$table=isset($_POST['table']) ? $_POST['table'] : "";
$otherUid=isset($_POST['otherUid']) ? $_POST['otherUid'] : "";
echo $table;