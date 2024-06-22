<div class="vacSlips">
    <?php
    function is_ajax_request(){
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
    }
    if(!is_ajax_request()){exit;};
    require_once("connection.php");
    $slips=$db->prepare("select * from vac where user_id={$_COOKIE['useridKoMoney']} ORDER  BY  targetDate desc");
    $slips->execute();
    $test2="";?>
    <?php if($slips->rowCount()!=0): ?>
        <?php foreach($slips->fetchAll() as $key=>$value): ?>
            <?php $targetDate=$value['targetDate'];
            $targetDateNew=strtotime($targetDate);
            $targetDateNewDate=date("d-m-Y",$targetDateNew);
            $targetDateNewTime=date("h:i:s A",$targetDateNew);
            ?>
            <?php if($value['targetDate']!=$test2): ?>
                <table class="table table-bordered m-0 <?php if($test2!=""){echo "mt-5";} ?>">
                    <thead>
                    <tr class="bg-primary" style="border-bottom:0;">
                        <th colspan="3">
                            <strong class="justify-content-start"><?php echo $targetDateNewDate; ?></strong>
                            <strong class="float-right"><?php echo $targetDateNewTime; ?></strong>
                        </th>
                    </tr>
                    </thead>
                    <thead>
                    <tr class="d-flex">
                        <th class=" text-center col-3 m-0 p-0">Num</th>
                        <th class=" col-4 text-center m-0 p-0">Price</th>
                        <th class=" text-center col-5 m-0 p-0">Open</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="d-flex mt-1">
                        <input type="hidden" id="<?php echo $key ?>id" value="<?php echo $value['id']; ?>">
                        <input type="hidden" id="<?php echo $key ?>targetDate" value="<?php echo $value['targetDate']; ?>">
                        <input type="hidden" id="<?php echo $key ?>type" value="<?php echo $value['type']; ?>">
                        <td class="col-3 m-0  pl-3 pb-0 pt-0 text-center"><div id="<?php echo $key ?>num" style="background-color:yellow;color:black;font-size:20px;width:40px;line-height:40px;border-radius:50%"><?php echo $value['num']; ?></div></td>
                        <td class="col-4 m-0 p-0 pb-0 pt-2 text-center"><strong id="<?php echo $key ?>price"><?php echo $value['price']; ?></strong><small>(kyats)</small></td>
                        <td class="col-5 m-0 pb-0 pt-1 text-center">
                            <div class="row m-0 p-0">
                                <?php if($targetDateNewDate == date("d-m-Y",time()) && $value['status']==1 && time()<$targetDateNew): ?>
                                    <?php $now1=date("Y-m-d H:i:s",time());?>
                                    <?php $targetDate1=$value['targetDate'];?>
                                    <script>
                                        function test1(){
                                            var timer;
                                            var dbDate=new Date("<?php echo $targetDate1; ?>");
                                            var now=new Date("<?php echo $now1 ?>");
                                            var difference=(dbDate-now)-1000;
                                            timer=setInterval(function(){

                                                var seconds = Math.floor(difference/ 1000);
                                                var minutes = Math.floor(seconds / 60);
                                                var hours = Math.floor(minutes / 60);
                                                hours %= 24;
                                                minutes %= 60;
                                                seconds %= 60;
                                                if(hours<10){
                                                    hours="0"+hours;
                                                }
                                                if(minutes<10){
                                                    minutes="0"+minutes;
                                                }
                                                if(seconds<10){
                                                    seconds="0"+seconds;
                                                }
                                                $("#<?php echo $key; ?>h").text(hours);
                                                $("#<?php echo $key; ?>m").text(minutes);
                                                $("#<?php echo $key; ?>s").text(seconds);
//                                    // alert(difference);
                                                if(difference<=0){
                                                    clearInterval(timer);
                                                    var num=$("#<?php echo $key ?>num").html();
                                                    var price=$("#<?php echo $key ?>price").html();
                                                    var id=$("#<?php echo $key ?>id").val();
                                                    var targetDate=$("#<?php echo $key ?>targetDate").val();
                                                    var type=$("#<?php echo $key ?>type").val();
                                                    $("#<?php echo $key ?>h").hide();
                                                    $("#<?php echo $key ?>m").hide();
                                                    $("#<?php echo $key ?>s").hide();
                                                    $("#<?php echo $key ?>checking").show();
                                                    $.ajax({
                                                        url:"vacLiveCheck.php",
                                                        type:"GET",
                                                        data:{
                                                            targetDate:targetDate,
                                                            type:type,
                                                            num:num,
                                                            id:id,
                                                            price:price
                                                        },
                                                        success:function(data){
                                                            $("#<?php echo $key ?>checking").hide();
                                                            if(data=="Closed"){
                                                                $("#<?php echo $key ?>close").show();
                                                            }else if(data=="Lose"){
                                                                $("#<?php echo $key ?>lose").show();
                                                            }else if(data.slice(0,3)=="Tot"){
                                                                $("#<?php echo $key ?>tot").show();
                                                                $(".vacbalance").text(data.slice(3));
                                                            }else{
                                                                $("#<?php echo $key ?>win").show();
                                                                $(".vacbalance").text(data);
                                                            }

                                                        }
                                                    });

                                                }
                                                difference-=1000;
                                            },1000);


                                        }
                                        test1();

                                    </script>
                                <input type="hidden" class="hidden" value="<?php echo $targetDateNew; ?>">
                                    <div class="m-0 mt-1 mr-1 bg-danger" id="<?php echo $key ?>lose" style="display:none;font-size:15px;font-family:bold;width:40px;height:25px;padding-top:2px;border-radius:10px;">Lose</div>
                                    <div class="m-0 mt-1 mr-1 bg-danger" id="<?php echo $key ?>close" style="display:none;padding-top:2px;font-size:15px;font-family:bold;width:43px;height:25px;border-radius:10px;">Close</div>
                                    <div class="m-0 mr-1 mt-1 bg-success" id="<?php echo $key ?>win" style="display:none;padding-top:2px;font-size:15px;font-family:bold;width:40px;height:25px;border-radius:10px;">Win</div>
                                    <div class="m-0 mr-1 mt-1 bg-success" id="<?php echo $key ?>tot" style="display:none;padding-top:2px;font-size:15px;font-family:bold;width:40px;height:25px;border-radius:10px;">Tot</div>
                                    <div class="m-0 bg-danger" id="<?php echo $key; ?>h" style="font-size:20px;width:30px;height:30px;border-radius:10px;"><?php echo date("h",$targetDateNew); ?></div>
                                    <div class="m-0  bg-primary" id="<?php echo $key; ?>m" style="font-size:20px;width:30px;height:30px;border-radius:10px;"><?php echo date("i",$targetDateNew); ?></div>
                                    <div class="m-0 bg-success" id="<?php echo $key; ?>s" style="font-size:20px;width:30px;height:30px;border-radius:10px;"><?php echo date("s",$targetDateNew); ?></div>
                                    <div class="m-0 mr-1 mt-1 bg-primary" id="<?php echo $key; ?>checking" style="display:none;font-size:15px;font-family:bold;width:80px;height:25px;padding-top:2px;border-radius:10px;">Checking...</div>
                                <?php elseif($value['status']==0 && $value['wl']=="l" && $value['close']==0): ?>
                                    <div class="m-0 mt-1 mr-1 bg-danger" style="font-size:15px;font-family:bold;width:40px;height:25px;padding-top:2px;border-radius:10px;">Lose</div>
                                <?php elseif($value['status']==0 && $value['wl']=="w" && $value['close']==0): ?>
                                    <div class="m-0 mr-1 mt-1 bg-success" style="padding-top:2px;font-size:15px;font-family:bold;width:40px;height:25px;border-radius:10px;">Win</div>
                                <?php elseif($value['status']==0 && $value['wl']=='t' && $value['close']==0 ):?>
                                    <div class="m-0 mr-1 mt-1 bg-success" style="padding-top:2px;font-size:15px;font-family:bold;width:40px;height:25px;border-radius:10px;">Tot</div>
                                <?php elseif($value['status']==0 && $value['wl']=="l" && $value['close']==1): ?>
                                    <div class="m-0 mt-1 mr-1 bg-danger" style="padding-top:2px;font-size:15px;font-family:bold;width:43px;height:25px;border-radius:10px;">Close</div>
                                <?php else: ?>
                                    <div class="m-0 mr-1 mt-1 bg-warning" style="font-size:15px;font-family:bold;width:60px;height:25px;padding-top:2px;border-radius:10px;">Waiting</div>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            <?php else: ?>
                <table class="table table-bordered m-0">
                    <tbody></tbody>
                    <tr class="d-flex mt-1">
                        <input type="hidden" id="<?php echo $key ?>id" value="<?php echo $value['id']; ?>">
                        <input type="hidden" id="<?php echo $key ?>targetDate" value="<?php echo $value['targetDate']; ?>">
                        <input type="hidden" id="<?php echo $key ?>type" value="<?php echo $value['type']; ?>">
                        <td class="col-3 m-0  pl-3 pb-0 pt-0 text-center"><div style="background-color:yellow;color:black;font-size:20px;width:40px;line-height:40px;border-radius:50%" id="<?php echo $key ?>num"><?php echo $value['num']; ?></div></td>
                        <td class="col-4 m-0 p-0 pb-0 pt-2 text-center"><strong id="<?php echo $key ?>price"><?php echo $value['price']; ?></strong><small>(kyats)</small></td>
                        <td class="col-5 m-0 pb-0 pt-1 text-center">
                            <div class="row m-0 p-0">
                                <?php if($targetDateNewDate == date("d-m-Y",time()) && $value['status']==1): ?>
                                    <script>
                                        function test2(){
                                            var dbDate=new Date("<?php echo $value['targetDate']; ?>");
                                            <?php $now1=date("Y-m-d H:i:s",time());?>
                                            var now=new Date("<?php echo $now1 ?>");
                                            var difference=(dbDate-now)-100;
                                            var timer=setInterval(function(){
                                                var seconds = Math.floor(difference / 1000);
                                                var minutes = Math.floor(seconds / 60);
                                                var hours = Math.floor(minutes / 60);
                                                hours %= 24;
                                                minutes %= 60;
                                                seconds %= 60;
                                                if(hours<10){
                                                    hours="0"+hours;
                                                }
                                                if(minutes<10){
                                                    minutes="0"+minutes;
                                                }
                                                if(seconds<10){
                                                    seconds="0"+seconds;
                                                }
                                                $("#<?php echo $key; ?>h").text(hours);
                                                $("#<?php echo $key; ?>m").text(minutes);
                                                $("#<?php echo $key; ?>s").text(seconds);
                                                if(difference <= 1000){
                                                    clearInterval(timer);
                                                    var num=$("#<?php echo $key ?>num").html();
                                                    var price=$("#<?php echo $key ?>price").html();
                                                    var id=$("#<?php echo $key ?>id").val();
                                                    var targetDate=$("#<?php echo $key ?>targetDate").val();
                                                    var type=$("#<?php echo $key ?>type").val();
                                                    $("#<?php echo $key ?>h").hide();
                                                    $("#<?php echo $key ?>m").hide();
                                                    $("#<?php echo $key ?>s").hide();
                                                    $("#<?php echo $key ?>checking").show();
                                                    $.ajax({
                                                        url:"vacLiveCheck.php",
                                                        type:"GET",
                                                        data:{
                                                            targetDate:targetDate,
                                                            type:type,
                                                            num:num,
                                                            id:id,
                                                            price:price
                                                        },
                                                        success:function(data){
                                                            $("#<?php echo $key ?>checking").hide();
                                                            if(data=="Closed"){
                                                                $("#<?php echo $key ?>close").show();
                                                            }else if(data=="Lose"){
                                                                $("#<?php echo $key ?>lose").show();
                                                            }else if(data.slice(0,3)=="Tot"){
                                                                $("#<?php echo $key ?>tot").show();
                                                                $(".vacbalance").text(data.slice(3));
                                                            }else{
                                                                $("#<?php echo $key ?>win").show();
                                                                $(".vacbalance").text(data);
                                                            }

                                                        }
                                                    });

                                                }

                                                difference-=1000;
                                            },1000);
                                        }
                                        test2();

                                    </script>
                                <input type="hidden" class="hidden" value="<?php echo $targetDateNew; ?>">
                                    <div class="m-0 mt-1 mr-1 bg-danger" id="<?php echo $key ?>lose" style="display:none;font-size:15px;font-family:bold;width:40px;height:25px;padding-top:2px;border-radius:10px;">Lose</div>
                                    <div class="m-0 mt-1 mr-1 bg-danger" id="<?php echo $key ?>close" style="display:none;padding-top:2px;font-size:15px;font-family:bold;width:43px;height:25px;border-radius:10px;">Close</div>
                                    <div class="m-0 mr-1 mt-1 bg-success" id="<?php echo $key ?>win" style="display:none;padding-top:2px;font-size:15px;font-family:bold;width:40px;height:25px;border-radius:10px;">Win</div>
                                    <div class="m-0 mr-1 mt-1 bg-success" id="<?php echo $key ?>tot" style="display:none;padding-top:2px;font-size:15px;font-family:bold;width:40px;height:25px;border-radius:10px;">Tot</div>
                                    <div class="m-0 bg-danger" id="<?php echo $key ?>h" style="font-size:20px;width:30px;height:30px;border-radius:10px;"><?php echo date("h",$targetDateNew); ?></div>
                                    <div class="m-0 bg-primary" id="<?php echo $key ?>m" style="font-size:20px;width:30px;height:30px;border-radius:10px;"><?php echo date("i",$targetDateNew); ?></div>
                                    <div class="m-0 bg-success" id="<?php echo $key ?>s" style="font-size:20px;width:30px;height:30px;border-radius:10px;"><?php echo date("s",$targetDateNew); ?></div>
                                    <div class="m-0 mr-1 mt-1 bg-primary" id="<?php echo $key ?>checking" style="display:none;font-size:15px;font-family:bold;width:80px;height:25px;padding-top:2px;border-radius:10px;">Checking...</div>
                                <?php elseif($value['status']==0 && $value['wl']=="l" && $value['close']==0): ?>
                                    <div class="m-0 mt-1 mr-1 bg-danger" style="font-size:15px;font-family:bold;width:40px;height:25px;padding-top:2px;border-radius:10px;">Lose</div>
                                <?php elseif($value['status']==0 && $value['wl']=="w" && $value['close']==0): ?>
                                    <div class="m-0 mr-1 mt-1 bg-success" style="padding-top:2px;font-size:15px;font-family:bold;width:40px;height:25px;border-radius:10px;">Win</div>
                                <?php elseif($value['status']==0 && $value['wl']=='t' && $value['close']==0 ):?>
                                    <div class="m-0 mr-1 mt-1 bg-success" style="padding-top:2px;font-size:15px;font-family:bold;width:40px;height:25px;border-radius:10px;">Tot</div>
                                <?php elseif($value['status']==0 && $value['wl']=="l" && $value['close']==1): ?>
                                    <div class="m-0 mt-1 mr-1 bg-danger" style="padding-top:2px;font-size:15px;font-family:bold;width:43px;height:25px;border-radius:10px;">Close</div>
                                <?php else: ?>
                                    <div class="m-0 mr-1 mt-1 bg-warning" style="font-size:15px;font-family:bold;width:60px;height:25px;padding-top:2px;border-radius:10px;">Waiting</div>
                                <?php endif; ?>
                            </div>
                        </td>
                </table>

            <?php endif; ?>
            <?php $test2=$value['targetDate']; ?>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
    <div class="text-center pt-5">
        <strong class="text-danger">You don't have any betting history in this virtual account!<br>You can bet in this section!</strong>
    </div>
    <?php endif; ?>



</div>
