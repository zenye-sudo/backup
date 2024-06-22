<?php
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
}
if(!is_ajax_request()){exit;};
require_once "connection.php";
?>
<?php
$u2=isset($_POST['u2']) ? $_POST['u2'] : "";
if($u2==1){
    $one=$_COOKIE['useridKoMoney'];
    $two=$u2;
    $onef1=$one+1;
    $onef2=$onef1*$onef1;
    $twof1=$two+1;
    $twof2=$twof1*$twof1;
    $formula=$onef2+$twof2;
    $watch=$db->prepare("update `{$formula}` set view=1 where uid !={$one}");
    $watch->execute();
}else{
    $one=1;
    $two=$u2;
    $onef1=$one+1;
    $onef2=$onef1*$onef1;
    $twof1=$two+1;
    $twof2=$twof1*$twof1;
    $formula=$onef2+$twof2;
    $watch=$db->prepare("update `{$formula}` set view=1 where uid !={$one}");
    $watch->execute();
}
