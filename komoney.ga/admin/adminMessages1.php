<?php
//sleep(2);
require_once "../connection.php";
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
}
if(!is_ajax_request()){exit;};
function message_time_ago($dbData){
    $dbData=strtotime($dbData);
    $nowData=time();
    $dbDataY=date("Y",$dbData);
    $nowDataY=date("Y",$nowData);
    $dbDataM=date("M",$dbData);
    $nowDataM=date("M",$nowData);
    $dbDataD=date("d",$dbData);
    $nowDataD=date("d",$nowData);
    if($dbDataY==$nowDataY && $dbDataM==$nowDataM && $dbDataD==$nowDataD){
        return date("h:i A",$dbData);
    }else if($dbDataY==$nowDataY){
        return date("M d \a\\t h:i A",$dbData);
    }else{
        return date("M d,Y \a\\t h:i A",$dbData);
    }
}
?>
<?php
$data_page=isset($_GET['data_page']) ? $_GET['data_page'] : "";
$data_page1=$data_page-10;
?>
<script>
    <?php if($data_page1<0): ?>
    $("#loadMore").attr("data-page",null);
    $("#loadMore").hide();
    <?php else: ?>
    $("#loadMore").attr("data-page",<?php echo $data_page1 ?>);
    <?php endif; ?>
</script>
<?php
$data_table=isset($_GET['data_table']) ? $_GET['data_table'] : "";
if($data_page1<0){
    $previousMessage=$db->prepare("select * from `{$data_table}` limit 0,{$data_page}");
    $previousMessage->execute();
}else{
    $previousMessage=$db->prepare("select * from `{$data_table}` limit {$data_page1},10");
    $previousMessage->execute();
}
?>
<?php foreach($previousMessage->fetchAll() as $item): ?>
    <?php
    $retrieveUser=$db->prepare("select * from users where id={$item['uid']}");
    $retrieveUser->execute();
    $retrieveUserData=$retrieveUser->fetch();
    $pp=json_decode($retrieveUserData['pp']); ?>
    <p class="text-muted" style="display:block;text-align:center;margin:0;font-size:12px;<?php if($test == message_time_ago($item['created_at'])){echo "display:none;";} ?>"><?php echo message_time_ago($item['created_at']); ?></p>
    <li class="li <?php if($item['uid']==1){echo "send";}else{echo "replies";} ?>" data-id="<?php echo $item['id'] ?>">
        <img id="liimg" src="../user/pp/<?php echo $pp ?>" style="<?php if($item['uid']==1){ echo "margin-right:10px";}?>">
        <?php
        $test=strrpos($item['text'],'.');
        $extension=substr($item['text'],$test+1,strlen($item['text']));
        $extension=strtolower($extension);
        ?>
        <?php if($extension=="jpg" || $extension== "jpeg" || $extension== "gif" || $extension == "png"): ?>
            <img src="../SendImg/<?php echo $item['text'] ?>"  class=" p-0 img-thumbnail" alt="" style="width:50%;margin-bottom:5px;">
        <?php else: ?>
            <p><?php echo $item['text']; ?></p>
        <?php endif; ?>
    </li>
    <li style="display:none" class="seen" id="seen<?php echo $item['id']; ?>"><small style="float:right;" class="text-muted">Seen</small><img src='../2d3d.png' alt='' style='float:right;width:20px;height:20px;'></li>
    <!--           For hide same data start-->
    <?php
    $test=message_time_ago($item['created_at']);
    ?>
    <!--           For hide same data end-->
<?php endforeach; ?>
