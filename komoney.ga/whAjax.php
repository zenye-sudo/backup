<?php
function is_ajax_request(){return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
}
if (!is_ajax_request()) {exit;}; ?>
<?php
require_once "connection.php";
$page=isset($_GET['pageNumber']) ? $_GET['pageNumber'] : 1;
$perPage=20;
$offset=((($page-1)*$perPage)+1)-1;
$request=$db->prepare("select * from dw where user_id={$_COOKIE['useridKoMoney']} and type='withdraw' ORDER BY date desc limit $offset,20");
$request->execute();
$requestForChecking10=$db->prepare("select * from dw where user_id={$_COOKIE['useridKoMoney']} and type='withdraw'");
$requestForChecking10->execute();
?>
<?php if($requestForChecking10->rowCount()!=0): ?>
    <?php foreach($request->fetchAll() as $key=>$value) :?>
        <?php $date=strtotime($value['date']);$date=date("d-m-y",$date); ?>
        <tr class="d-flex">
            <td class="col-1 col-md-1  m-0 p-0 pl-1 pageId1" style="font-size:10px;"></td>
            <td class="col-3 col-md-4  text-center" style="font-size:13px;"><?php echo $date; ?></td>
            <?php if($value['bank']=="wm"): ?>
                <td class="col-2 col-md-1  text-center" style="font-size:13px;"><img src="img/wm.jpeg" alt="" style="width:100%;height:25px;"></td>
            <?php elseif($value['bank']=="ok"): ?>
                <td class="col-2 col-md-1  text-center" style="font-size:13px;"><img src="img/ok.jpeg" alt="" style="width:100%;height:25px;"></td>
            <?php endif; ?>
            <?php if($value['status']==0): ?>
                <td class="col-3  text-warning text-center" style="font-size:13px;;">Pending</td>
            <?php else: ?>
                <td class="col-3  text-center" style="font-size:15px;color:green;font-family:bold;"><strong>Success</strong></td>
            <?php endif; ?>
            <td class="col-3  text-center" style="font-size:13px;"><?php echo $value['amount'] ?></td>
        </tr>
    <?php endforeach;?>
<?php  else: ?>
    <tr>
        <td class="text-center">There is no withdraw history!</td>
    </tr>
<?php endif; ?>
