<?php
function is_ajax_request(){return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
}
if (!is_ajax_request()) {exit;}; ?>
<?php
require_once "connection.php";
$page=isset($_GET['pageNumber']) ? $_GET['pageNumber'] : 1;
$perPage=20;
$offset=((($page-1)*$perPage)+1)-1;
$request=$db->prepare("select * from proof ORDER BY date desc limit $offset,20");
$request->execute();
$requestForChecking10=$db->prepare("select * from proof");
$requestForChecking10->execute();
?>
<?php if($requestForChecking10->rowCount()!=0): ?>
    <?php foreach($request->fetchAll() as $key=>$value) :?>
                <tr>
                    <td><?php echo $value['date']; ?></td>
                    <td><?php echo $value['username']; ?></td>
                    <td><?php echo $value['method']; ?></td>
                    <td><?php echo $value['amount']; ?></td>
                </tr>
    <?php endforeach;?>
<?php  else: ?>
    <tr>
        <td>There is no withdraw history!</td>
    </tr>
<?php endif; ?>

