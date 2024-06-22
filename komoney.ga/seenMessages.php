<?php
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
}
if(!is_ajax_request()){exit;};
?>
<?php
require_once "connection.php";
$uid2=isset($_GET['uid2']) ? $_GET['uid2'] : "";
$uid1=isset($_GET['uid1']) ? $_GET['uid1'] : "";
if($uid1!=""){
    $one=1;
    $two=(int)$uid2;
    $onef1=$one+1;
    $onef2=$onef1*$onef1;
    $twof1=$two+1;
    $twof2=$twof1*$twof1;
    $formula=$onef2+$twof2;
    $seen=$db->prepare("select * from `{$formula}` where uid={$one} and view=1 order by created_at desc limit 1");
    $seen->execute();
    $seenFetch=$seen->fetch();
    echo $seenFetch['id'];
}else{
    $one=$_COOKIE['useridKoMoney'];
    $two=(int)$uid2;
    $onef1=$one+1;
    $onef2=$onef1*$onef1;
    $twof1=$two+1;
    $twof2=$twof1*$twof1;
    $formula=$onef2+$twof2;
    $seen=$db->prepare("select * from `{$formula}` where uid={$one} and view=1 order by created_at desc limit 1");
    $seen->execute();
    $seenFetch=$seen->fetch();
    echo $seenFetch['id'];
}

