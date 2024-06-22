<?php
//sleep(2);
require_once "../connection.php";
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
}
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
$data_table=isset($_GET['data_table']) ? $_GET['data_table'] : "";
if($data_table==""){
    $one=$_GET['uid'];
    $two=$_COOKIE['useridKoMoney'];
    $onef1=$one+1;
    $onef2=$onef1*$onef1;
    $twof1=$two+1;
    $twof2=$twof1*$twof1;
    $formula=$onef2+$twof2;
}else{
    $formula=$data_table;
    $know=$_COOKIE['useridKoMoney'];
    $know1=($know+1)*($know+1);
    $sum=$formula;
    $cal=(sqrt($sum-$know1))-1;
    $one=$cal;
    $two=$know;
}
$test="";
//////////////////Test start////////////
$otherUserImg=$db->prepare("select * from users where id={$one}");
$otherUserImg->execute();
$otherUserImgFetch=$otherUserImg->fetch();
$otherUserImgFetchPp=json_decode($otherUserImgFetch['pp']);
//////////////////Test start////////////
$messageRowCount=$db->prepare("SELECT * FROM `{$formula}`");
$messageRowCount->execute();
$totalMessageRowCount=$messageRowCount->rowCount();?>
<?php
if($totalMessageRowCount>=20){
    $minusRowCount=$totalMessageRowCount-10;
    $retrievetable=$db->prepare("select * from `{$formula}` limit {$minusRowCount},10");
    $retrievetable->execute();
    ?>
    <script>
        $("#loadMore").attr("data-page",<?php echo $minusRowCount; ?>);
        $("#loadMore").attr("data-table","<?php echo $formula ?>");
        $("#loadMore").show();
    </script>
    <?php
}else{
    $retrievetable=$db->prepare("select * from `{$formula}`");
    $retrievetable->execute();
    ?>
    <script>
        $("#loadMore").attr("data-page",null);
        $("#loadMore").attr("data-table",null);
        $("#loadMore").hide();
    </script>
    <?php
}
?>
<script>

</script>
<?php foreach($retrievetable->fetchAll() as $item): ?>
    <?php
    $retrieveUser=$db->prepare("select * from users where id={$item['uid']}");
    $retrieveUser->execute();
    $retrieveUserData=$retrieveUser->fetch();
    $pp=json_decode($retrieveUserData['pp']); ?>
    <p class="text-muted" style="display:block;text-align:center;margin:0;font-size:12px;<?php if($test == message_time_ago($item['created_at'])){echo "display:none;";} ?>"><?php echo message_time_ago($item['created_at']); ?></p>
    <!--    FOr replies username start-->
    <?php if($data_table!="") : ?>
        <li style="margin:0;padding:0;line-height:15px;<?php if($item['uid']==$_COOKIE['useridKoMoney']){echo 'display:none';}; ?>">
            <small style="font-size:10px;margin:0;padding:0;padding-left:35px;"><?php echo $retrieveUserData['username']; ?></small>
        </li>
    <?php endif; ?>
    <!--    FOr replies username end-->
    <li class="li <?php if($item['uid']==$_COOKIE['useridKoMoney']){echo "send";}else{echo "replies";} ?>" data-id="<?php echo $item['id'] ?>">
        <img id="liimg" src="user/pp/<?php echo $pp ?>" style="<?php if($item['uid']==$_COOKIE['useridKoMoney']){ echo "margin-right:10px";}?>">
        <?php
        $test=strrpos($item['text'],'.');
        $extension=substr($item['text'],$test+1,strlen($item['text']));
        $extension=strtolower($extension);
        ?>
        <?php if($extension=="jpg" || $extension== "jpeg" || $extension== "gif" || $extension == "png"): ?>
            <img src="SendImg/<?php echo $item['text'] ?>" class="fullScreenImg p-0 img-thumbnail" alt="" style="width:50%;margin-bottom:5px;">
        <?php else: ?>
            <p><?php echo $item['text']; ?></p>
        <?php endif; ?>
    </li>
    <li style="display:none" class="seen" id="seen<?php echo $item['id']; ?>"><small style="float:right;" class="text-muted">Seen</small><i class="fa fa-check text-success" style="float:right;"></i></li>
    <!--           For hide same data start-->
    <?php
    $test=message_time_ago($item['created_at']);
    ?>
    <!--For hide same data end-->
<?php endforeach; ?>

