<?php
function is_ajax_request()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
}

if (!is_ajax_request()) {
    exit;
};
date_default_timezone_set("Asia/Rangoon");
require_once ("racCheckTwod.php");
?>
<div id="rac"  style="height:1000px;width:100%;">
    <style>
        #radioBtn1 .notActive{
            color: #3276b1;
            background-color: #fff;
        }
    </style>
    <!-- -----------------------------------------------------   FOr alert bar start---------------------------------------------------->
    <div class="background" style="display:none;width:100%;height:100%;position: absolute;background-color:rgba(0,0,0,0.6);left:0;"></div>
    <div class="alertForVocher1 mt-5 pb-2 pt-2 text-dark position-absolute col-10 text-center" style="display:none;border-radius:19px;margin-left:5%;background-color:white;z-index:2;">
        <button class="btn btn-success background mt-3 float-right">OK</button>
    </div>
    <!-----------------------------------------------------------FOr alert bar end------------------------------------------------------>
    <!----------------------------------------------------------    FOr bet 2d start----------------------------------------------------->
    <div class="2dDiv1 mt-2"  style="margin-left:3px;margin-right:3px;padding:17px;background-color:rgb(11,0,24);overflow:hidden;border:2px solid yellow;border-radius:15px;">
    <h4 style="color:yellow;text-align:center;font-family: bold;">2D Vocher</h4><br>
        <input type="text" id="confirmVocherDate1" value="<?php echo date('Y-m-d',time()); ?>" class="form-control confirmVocherDate1"><br>
        <div class="row justify-content-center mb-3">
            <div id="radioBtn1" class="btn-group">
                <?php $hour=date("H",time()); ?>
                <a class="btn btn-primary btn-sm <?php if($hour<12){echo "active";}else{echo "notActive";} ?>" data-toggle="fun1" data-time="12:00:00 PM" data-title="12:05:00">12:00 AM</a>
                <a class="btn btn-primary btn-sm <?php if($hour>=12){echo "active";}else{echo "notActive";} ?>" data-toggle="fun1" data-time="04:30:00 PM" data-title="16:35:00">04:30 PM</a>
            </div>
            <input type="hidden" name="fun" id="fun1" data-time="<?php if($hour<12){echo "12:00:00 PM";}else if($hour>=12){echo "04:30:00 PM";} ?>" value="<?php if($hour<12){echo "12:05:00";}else if($hour>=12){echo "16:35:00";} ?>">
        </div>
        <!----------------------twod VocherTable start--------->
        <table class="table table-bordered twodVocher1">
            <thead>
            <tr class="bg-primary">
                <th class="text-center p-0">2D</th>
                <th class="text-center p-0">R</th>
                <th class="text-center p-0">Price</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center p-0" style="color:yellow">
                    <strong>
                        <select name="confirmVocherTwod1" class="form-control b-0 confirmVocherTwod1" style="border-radius:0;border:0;">
                            <?php
                            for ($i = 0; $i < 100; $i++) {
                                if($i<10){
                                    $i="0".$i;
                                }
                                echo "<option value='" . $i . "'>" . $i . "</option>";
                            }
                            for($i=0;$i<10;$i++){
                                echo "<option value='".$i.".s'>".$i." ထိပ္</option>";
                            }
                            for($i=0;$i<10;$i++){
                                echo "<option value='".$i.".e'>".$i." ပိတ္</option>";
                            }
                            ?>
                        </select>
                    </strong>
                </td>
                <td class="text-center p-0 text-center ">
                    <input type="checkbox" class="form-control confirmVocherCheckbox1">
                </td>
                <td class="text-center p-0" style="color:yellow">
                    <strong>
                        <select name="confirmVocherBetPrice1" class="form-control confirmVocherBetPrice1" style="border-radius:0;border:0;">
                            <?php
                            echo "Hello";
                            for ($i = 50; $i <= 10000; $i += 50) {
                                echo "<option value='" . $i . "'>" . $i . " Kyats</option>";
                            }
                            ?>
                        </select>
                    </strong>
                </td>
            </tr>
            </tbody>
        </table>
        <button class="btn btn-primary btn-sm addRow1">Add</button>
        <button class="btn btn-primary btn-sm float-right confirmVocherForTwod1">Confirm Vocher</button>
        <!----------------twod Vocher end-------------------->
    </div>
    <!-------------------------------------------------------------------FOr bet 2d end--------------------------------------------------->
    <!----------------------------------------------------------    FOr bet 3d start----------------------------------------------------->
    <div class="3dDiv mt-2" style="margin-left:3px;margin-right:3px;padding:17px;background-color:rgb(11,0,24);overflow:hidden;border:2px solid yellow;border-radius:15px;">
    <h4 style="color:yellow;text-align:center;font-family: bold;">3D Vocher</h4><br>
        <input type="text" id="confirmVocherDate1ForThreed" value="<?php echo date('Y-m-d',time()); ?>" class="form-control confirmVocherDate1"><br>
        <!----------------------twod VocherTable start--------->
        <table class="table table-bordered threedVocher1">
            <thead>
            <tr class="bg-primary">
                <th class="text-center p-0">3D</th>
                <th class="text-center p-0">R</th>
                <th class="text-center p-0">Price</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center p-0" style="color:yellow">
                    <strong>
                        <select name="confirmVocherThreed1" class="form-control b-0 confirmVocherThreed1" style="border-radius:0;border:0;">
                            <?php
                            for ($i = 0; $i < 1000; $i++) {
                                if($i<10){
                                    $i="00".$i;
                                }else if($i>=10 && $i<100){
                                    $i="0".$i;
                                }
                                echo "<option value='" . $i . "'>" . $i . "</option>";
                            }
                            ?>
                        </select>
                    </strong>
                </td>
                <td class="text-center p-0 text-center ">
                    <input type="checkbox" class="form-control confirmVocherForThreedCheckbox1">
                </td>
                <td class="text-center p-0" style="color:yellow">
                    <strong>
                        <select name="confirmVocherForThreedBetPrice" class="form-control confirmVocherBetPrice1ForThreed" style="border-radius:0;border:0;">
                            <?php
                            echo "Hello";
                            for ($i = 50; $i <= 10000; $i += 50) {
                                echo "<option value='" . $i . "'>" . $i . " Kyats</option>";
                            }
                            ?>
                        </select>
                    </strong>
                </td>
            </tr>
            </tbody>
        </table>
        <button class="btn btn-primary btn-sm addRow1ForThreed">Add</button>
        <button class="btn btn-primary btn-sm float-right confirmVocherForThreed1">Confirm Vocher</button>
        <!----------------twod Vocher end-------------------->
    </div>
    <!-------------------------------------------------------------------FOr bet 3d end--------------------------------------------------->
    <script>
        /*****************************************for choose radio button start**********************************************/
        $('#radioBtn1 a').on('click', function(){
            var sel = $(this).data('title');
            var test=$(this).data('time');
            var tog = $(this).data('toggle');
            $('#'+tog).prop('value', sel);
            $('#'+tog).attr('data-time',test);

            $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
            $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
        });
        /******************************************for choose radio button end*************************************************/
        $(".confirmVocherDate1").datepicker();
        $(".background").click(function(){$(".background").hide();$(".alertForVocher1").hide();});
        /**********************************************For Confirm 2d Vocher start*********************************************/
        $(".addRow1").click(function () {
            $(".twodVocher1").append('<tr><td class="text-center p-0" style="color:yellow"><strong><select name="confirmVocherTwod1" class="form-control b-0 confirmVocherTwod1" style="border-radius:0;"><?php for($i=0;$i<100;$i++){if($i<10){$i='0'.$i;};echo  "<option value=$i>$i</option>";} for($i=0;$i<10;$i++){echo "<option value=$i.start>$i ထိပ္</option>";} for($i=0;$i<10;$i++){echo "<option value=$i.end>$i ပိတ္</option>";} ?></select> </strong></td> <td class="text-center p-0 text-center "> <input type="checkbox" class="form-control confirmVocherCheckbox1"></td><td class="text-center p-0" style="color:yellow"><strong><select name="confirmVocherBetPrice1" class="form-control confirmVocherBetPrice1" style="border-radius:0;"><?php for($i=50;$i<=10000;$i+=50){echo  "<option value=$i>$i Kyats</option>";} ?></select> </strong> </td> </tr>');
        });
        $(".confirmVocherForTwod1").click(function() {
            var children = $(".alertForVocher1").children();
            children.hide();
            var checkHolidays = new Date($("#confirmVocherDate1").val());
            if(checkHolidays.getDay()==0 || checkHolidays.getDay()==6){
                if(checkHolidays.getDay()==0){
                    $(".alertForVocher1").prepend('<i class="fa fa-times-circle fa-3x text-danger mb-3"></i><br><strong>2D is closed because today is <span class="text-danger">Sunday.</span>But You can pre-bet for next days.Have a nice Sunday!</strong><br>');
                }else{
                    $(".alertForVocher1").prepend('<i class="fa fa-times-circle fa-3x text-danger mb-3"></i><br><strong>2D is closed because today is <span class="text-danger">Saturaday.</span>But You can pre-bet for next days.Have a nice Saturaday!</strong><br>');
                }
                $(".background").show();
                $(".alertForVocher1").fadeIn("fast");
            }else{
                $("#loadingForBet").show();
                var confirmVocherCheckbox1 = document.getElementsByClassName("confirmVocherCheckbox1");
                var confirmVocherDate1 = $("#confirmVocherDate1").val();
                var confirmVocherTime = $("#fun1").val();
                var confirmVocherTwod1 = document.getElementsByClassName("confirmVocherTwod1");
                var confirmVocherBetPrice1 = document.getElementsByClassName("confirmVocherBetPrice1");

                var obj = {};
                obj['list'] = {};
                var forSAndE = 0;
                var pwon = 0;
                for (var i = 0; i < confirmVocherTwod1.length; i++) {
                    pwon += parseInt(confirmVocherBetPrice1[i].value);
                    var startOrEnd = confirmVocherTwod1[i].value.slice(2, 3);
                    if (startOrEnd == "s" || startOrEnd == "e") {
                        if (confirmVocherCheckbox1[i].checked == true) {
                            var dividedByTen = confirmVocherBetPrice1[i].value / 20;
                        } else {
                            var dividedByTen = confirmVocherBetPrice1[i].value / 10;
                        }
                        if (startOrEnd == "s") {
                            var first = confirmVocherTwod1[i].value.slice(0, 1);
                            for (var j = 0; j < 10; j++) {
                                var second = j;
                                obj['date'] = confirmVocherDate1;
                                obj['time'] = confirmVocherTime;
                                var generate = first + second;
                                obj['list']["S" + forSAndE + "" + j] = {};
                                obj['list']["S" + forSAndE + "" + j]['twod'] = generate;
                                obj['list']["S" + forSAndE + "" + j]['price'] = dividedByTen;
                            }
                            ;
                            //For StartR(RS) start
                            if (confirmVocherCheckbox1[i].checked == true) {
                                var Rsecond = confirmVocherTwod1[i].value.slice(0, 1);
                                for (var rj = 0; rj < 10; rj++) {
                                    var Rfirst = rj;
                                    obj['date'] = confirmVocherDate1;
                                    obj['time'] = confirmVocherTime;
                                    var Rgenerate = Rfirst + Rsecond;
                                    obj['list']["RS" + forSAndE + "" + rj] = {};
                                    obj['list']["RS" + forSAndE + "" + rj]['twod'] = Rgenerate;
                                    obj['list']["RS" + forSAndE + "" + rj]['price'] = dividedByTen;
                                }
                            }
                            //For startR(RS) end
                            forSAndE++;

                        } else {
                            var second1 = confirmVocherTwod1[i].value.slice(0, 1);
                            for (var k = 0; k < 10; k++) {
                                var first1 = k;
                                obj['date'] = confirmVocherDate1;
                                obj['time'] = confirmVocherTime;
                                var generate1 = first1 + second1;
                                obj['list']["E" + forSAndE + "" + k] = {};
                                obj['list']["E" + forSAndE + "" + k]['twod'] = generate1;
                                obj['list']["E" + forSAndE + "" + k]['price'] = dividedByTen;
                            }
                            //For StartR(RS) start
                            if (confirmVocherCheckbox1[i].checked == true) {
                                var Rsecond1 = confirmVocherTwod1[i].value.slice(0, 1);
                                for (var rk = 0; rk < 10; rk++) {
                                    var Rfirst1 = rk;
                                    obj['date'] = confirmVocherDate1;
                                    obj['time'] = confirmVocherTime;
                                    var Rgenerate1 = Rfirst1 + Rsecond1;
                                    obj['list']["RS" + forSAndE + "" + rk] = {};
                                    obj['list']["RS" + forSAndE + "" + rk]['twod'] = Rgenerate1;
                                    obj['list']["RS" + forSAndE + "" + rk]['price'] = dividedByTen;
                                }
                            }
                            //For startR(RS) end
                            forSAndE++;
                        }
                    } else if (confirmVocherCheckbox1[i].checked == true) {
                        // var confirmVocherBetPrice1=confirmVocherBetPrice1[i].value/2;
                        var origialnumber = confirmVocherTwod1[i].value;
                        var firstCharacter = origialnumber.slice(0, 1);
                        var secondCharacter = origialnumber.slice(1, 2);
                        var modifyNumber = secondCharacter + firstCharacter;
                        obj['date'] = confirmVocherDate1;
                        obj['time'] = confirmVocherTime;
                        obj['list']["R" + i] = {};
                        obj['list']["R" + i]['price'] = confirmVocherBetPrice1[i].value / 2;
                        obj['list']["R" + i]['twod'] = origialnumber;
                        obj['list']["N" + i] = {};
                        obj['list']["N" + i]['price'] = confirmVocherBetPrice1[i].value / 2;
                        obj['list']["N" + i]['twod'] = modifyNumber;
                    } else {
                        obj['date'] = confirmVocherDate1;
                        obj['time'] = confirmVocherTime;
                        obj['list']["N" + i] = {};
                        obj['list']["N" + i]['twod'] = confirmVocherTwod1[i].value;
                        obj['list']["N" + i]['price'] = confirmVocherBetPrice1[i].value;
                    }
                }
                obj['totalPrice'] = pwon;
                console.log(obj);
                var string = JSON.stringify(obj);
                $.ajax({
                    url: 'racSave.php',
                    type: "POST",
                    data: {
                        data: string
                    },
                    success: function (data) {
                        $("#loadingForBet").hide();
                        var confirmVocherCheckbox1 = document.getElementsByClassName("confirmVocherCheckbox1");
                        var confirmVocherDate1 = $("#confirmVocherDate1").val();
                        var date = new Date(confirmVocherDate1);
                        var day = date.getUTCDate();
                        var month = date.getUTCMonth() + 1;
                        var year = date.getUTCFullYear();
                        var confirmVocherTime = $("#fun").attr('data-time');
                        var confirmVocherTwod1 = document.getElementsByClassName("confirmVocherTwod1");
                        var confirmVocherBetPrice1 = document.getElementsByClassName("confirmVocherBetPrice1");
                        if (data == "Your balance is not enough!") {
                            $(".alertForVocher1").prepend('<i class="fa fa-times-circle fa-3x text-danger mb-3"></i><br><strong>Your balance is not enough to make pharase.Please change to real account and deposit money.</strong><br>');
                        } else if (data == "Wrong Date!Please change date!") {
                            $(".alertForVocher1").prepend('<i class="fa fa-calendar-times mb-2 fa-3x text-danger"></i><br><strong>Your choosen date<span class="dateWrong text-danger"></span> is wrong.Today is <span class="dateWrongCorrect text-primary">(12-23-2018)</span>.Please try another date.</strong>');
                            $(".dateWrong").text("(" + day + "-" + month + "-" + year + ")");
                        } else if (data == "Wrong Time!Pleae Change time!") {
                            $(".alertForVocher1").prepend('<i class="mb-3 fa fa-clock text-danger fa-3x text-center"></i><br><strong>Your choosen time<span class="timeWrong text-danger"></span> is wrong.Current time is <span class="timeWrongCorrect text-primary"></span></strong>');
                            $(".timeWrong").text("(" + confirmVocherTime + ")");
                            $(".timeWrongCorrect").text("(<?php echo date('h:i:s A', time()); ?>)");
                        } else if (data == "Daing close!") {
                            $(".alertForVocher1").prepend('<i class="fa fa-clock fa-3x text-danger"></i><br><strong>Die is close!</strong>')
                        } else {
                            $(".racbalance").html(data);
                            $(".alertForVocher1").prepend('<i class="fa fa-check-circle text-success fa-3x"></i><br><strong>You betted Successfully!</strong><table class=" mt-3 table table-bordered table-dark"><thead><tr><th colspan="2" class="alertForVocher1Date" style="color:white">' + day + '-' + month + '-' + year + '</th><th colspan="2" style="color:white" class="alertForVocher1Time">' + confirmVocherTime + '</th></tr><tr>        <th style="color:yellow">2D</th>        <th style="color:yellow">R</th>        <th style="color:yellow">Price</th>    </tr>    </thead> <tbody class="alertForVocher1Tbody"> <tr>     <td colspan="2" style="color:yellow">Total is </td>     <td style="color:yellow" class="alertForVocher1Total">' + pwon + '<span> MMK</span></td> </tr> </tbody></table>');
                            for (var i = 0; i < confirmVocherTwod1.length; i++) {
                                var test;
                                if (confirmVocherTwod1[i].value.slice(1, 3) == ".s") {
                                    test = confirmVocherTwod1[i].value.slice(0, 1) + " ထိပ္";
                                } else if (confirmVocherTwod1[i].value.slice(1, 3) == ".e") {
                                    test = confirmVocherTwod1[i].value.slice(0, 1) + " ပိတ္";
                                } else {
                                    test = confirmVocherTwod1[i].value;
                                }
                                if (confirmVocherCheckbox1[i].checked == true) {
                                    $(".alertForVocher1Tbody").prepend('<tr><td>' + test + '</td><td><i class="fa fa-check text-success"></i></td><td class="">' + confirmVocherBetPrice1[i].value + ' MMK</td>>');
                                } else {
                                    $(".alertForVocher1Tbody").prepend('<tr><td>' + test + '</td><td><i class="fa fa-times text-danger"></i></td><td class="">' + confirmVocherBetPrice1[i].value + ' MMK</td>>');
                                }
                            }
                        }
                        $(".background").show();
                        $(".alertForVocher1").fadeIn("fast");
                    }
                });
            }
        });
        /**********************************************For Confirm 2d Vocher end*********************************************/
        /***********************************************For Confirm 3d vocher start******************************************/
        $(".addRow1ForThreed").click(function () {
            $(".threedVocher1").append('<tr><td class="text-center p-0" style="color:yellow"><strong><select name="confirmVocherThreed1" class="form-control b-0 confirmVocherThreed1" style="border-radius:0;"><?php for($i=0;$i<1000;$i++){if($i<10){$i='00'.$i;}else if($i<=100){$i='0'.$i;};echo  "<option value=$i>$i</option>";} ?></select> </strong></td> <td class="text-center p-0 text-center "> <input type="checkbox" class="form-control confirmVocherForThreedCheckbox1"></td><td class="text-center p-0" style="color:yellow"><strong><select name="confirmVocherBetPrice1ForThreed" class="form-control confirmVocherBetPrice1ForThreed" style="border-radius:0;"><?php for($i=50;$i<=10000;$i+=50){echo  "<option value=$i>$i Kyats</option>";} ?></select> </strong> </td> </tr>');
        });
        $(".confirmVocherForThreed1").click(function(){
            var children=$(".alertForVocher1").children();
            children.hide();
            var TotalBetPriceForThreed=0;
            var confirmVocherDate1ForThreed=$("#confirmVocherDate1ForThreed").val();
            var confirmVocherDate1ForThreedJs=new Date(confirmVocherDate1ForThreed);
            if(confirmVocherDate1ForThreedJs.getDate() == 1 || confirmVocherDate1ForThreedJs.getDate() == 16){
                $("#loadingForBet").show();
                var confirmVocherBetPrice1ForThreed=document.getElementsByClassName("confirmVocherBetPrice1ForThreed");
                var confirmVocherThreed1=document.getElementsByClassName("confirmVocherThreed1");
                var confirmVocherForThreedCheckbox1=document.getElementsByClassName('confirmVocherForThreedCheckbox1');
                var obj={};
                obj.date=confirmVocherDate1ForThreed;
                obj.time="15:35:00";
                obj.list={};
                for(var i=0;i<confirmVocherThreed1.length;i++){
                    var threed=confirmVocherThreed1[i].value;
                    var price=confirmVocherBetPrice1ForThreed[i].value;
                    TotalBetPriceForThreed+=parseInt(confirmVocherBetPrice1ForThreed[i].value);//For total bet price for 3d
                    if(confirmVocherForThreedCheckbox1[i].checked == true){
                        var f=threed.slice(0,1);
                        var s=threed.slice(1,2);
                        var t=threed.slice(2,3);
                        var checkEqual=-1;//No word equal
                        if(f==s && f==t){//Three word equal
                            checkEqual=0;
                        }else{ // Two word equal
                            if(f==s){
                                checkEqual=2;
                            }
                            if(f==t){
                                checkEqual=2;
                            }
                            if(s==t){
                                checkEqual=2;
                            }
                        }
                        if(checkEqual==-1){
                            var price=confirmVocherBetPrice1ForThreed[i].value/6;
                            var one=f+s+t;
                            var two=t+s+f;
                            var three=s+f+t;
                            var four=s+t+f;
                            var five=f+t+s;
                            var six=t+f+s;
                            obj['list']['R'+i+"0"]={};
                            obj['list']['R'+i+"0"]['threed']=one;
                            obj['list']['R'+i+"0"]['price']=price;
                            obj['list']['R'+i+"1"]={};
                            obj['list']['R'+i+"1"]['threed']=two;
                            obj['list']['R'+i+"1"]['price']=price;
                            obj['list']['R'+i+"2"]={};
                            obj['list']['R'+i+"2"]['threed']=three;
                            obj['list']['R'+i+"2"]['price']=price;
                            obj['list']['R'+i+"3"]={};
                            obj['list']['R'+i+"3"]['threed']=four;
                            obj['list']['R'+i+"3"]['price']=price;
                            obj['list']['R'+i+"4"]={};
                            obj['list']['R'+i+"4"]['threed']=five;
                            obj['list']['R'+i+"4"]['price']=price;
                            obj['list']['R'+i+"5"]={};
                            obj['list']['R'+i+"5"]['threed']=six;
                            obj['list']['R'+i+"5"]['price']=price;

                        }else if(checkEqual==2){
                            price=confirmVocherBetPrice1ForThreed[i].value/3;
                            one=f+s+t;
                            two=t+s+f;
                            three=s+f+t;
                            four=s+t+f;
                            five=f+t+s;
                            six=t+f+s;
                            var ne=[];
                            var ary=[one,two,three,four,five,six];
                            for(var q=0;q<ary.length;q++){
                                if( one == ary[q] ){
                                    if(0 !=q){
                                        ne.push(ary[q]);
                                        delete ary[q];
                                        delete ary[0];
                                    }
                                }
                                if( two == ary[q] ){
                                    if(1 !=q){
                                        ne.push(ary[q]);
                                        delete ary[q];
                                        delete ary[1];
                                    }
                                }
                                if( three == ary[q] ){
                                    if(2 !=q){
                                        ne.push(ary[q]);
                                        delete ary[q];
                                        delete ary[2];
                                    }
                                }
                                if( four == ary[q] ){
                                    if(3 !=q){
                                        ne.push(ary[q]);
                                        delete ary[q];
                                        delete ary[3];
                                    }
                                }
                                if( five == ary[q] ){
                                    if(4 !=q){
                                        ne.push(ary[q]);
                                        delete ary[q];
                                        delete ary[4];
                                    }
                                }
                                if( six == ary[q] ){
                                    if(5 !=q){
                                        ne.push(ary[q]);
                                        delete ary[q];
                                        delete ary[5];
                                    }
                                }
                            }
                            obj['list']['RT'+i+"0"]={};
                            obj['list']['RT'+i+"0"]['threed']=ne[0];
                            obj['list']['RT'+i+"0"]['price']=price;
                            obj['list']['RT'+i+"1"]={};
                            obj['list']['RT'+i+"1"]['threed']=ne[1];
                            obj['list']['RT'+i+"1"]['price']=price;
                            obj['list']['RT'+i+"2"]={};
                            obj['list']['RT'+i+"2"]['threed']=ne[2];
                            obj['list']['RT'+i+"2"]['price']=price;

                        }else{
                            obj['list']['N'+i]={};
                            obj['list']['N'+i]['threed']=threed;
                            obj['list']['N'+i]['price']=price;
                        }
                    }else{
                        obj['list']['N'+i]={};
                        obj['list']['N'+i]['threed']=threed;
                        obj['list']['N'+i]['price']=price;
                    }

                }
                obj.totalPrice=TotalBetPriceForThreed;
                var string=JSON.stringify(obj);
                $.ajax({
                    url:'racSave.php',
                    type:"POST",
                    data:{
                        data:string
                    },
                    success:function(data){
                        $("#loadingForBet").hide();
                        var confirmVocherForThreedCheckbox1=document.getElementsByClassName('confirmVocherForThreedCheckbox1');
                        var confirmVocherDate1ForThreed=$("#confirmVocherDate1ForThreed").val();
                        var date=new Date(confirmVocherDate1ForThreed);
                        var day=date.getUTCDate();
                        var month=date.getUTCMonth()+1;
                        var year=date.getUTCFullYear();
                        var confirmVocherBetPrice1ForThreed=document.getElementsByClassName("confirmVocherBetPrice1ForThreed");
                        var confirmVocherThreed1=document.getElementsByClassName("confirmVocherThreed1");
                        if(data=="Your balance is not enough!"){
                            $(".alertForVocher1").prepend('<i class="fa fa-times-circle fa-3x text-danger mb-3"></i><br><strong>Your balance is not enough to make pharase.Please change to real account and deposit money.</strong><br>');
                        }else if(data=="Wrong Date!Please change date!"){
                            $(".alertForVocher1").prepend('<i class="fa fa-calendar-times mb-2 fa-3x text-danger"></i><br><strong>Your choosen date<span class="dateWrong text-danger"></span> is wrong.Today is <span class="dateWrongCorrect text-primary">(12-23-2018)</span>.Please try another date.</strong>');
                            $(".dateWrong").text("("+day+"-"+month+"-"+year+")");
                        }else if(data=="Wrong Time!Pleae Change time!"){
                            $(".alertForVocher1").prepend('<i class="mb-3 fa fa-clock text-danger fa-3x text-center"></i><br><strong>Your choosen time<span class="timeWrong text-danger"></span> is wrong.Current time is <span class="timeWrongCorrect text-primary"></span></strong>');
                            $(".timeWrong").text("(03:30:00 AM)");
                            $(".timeWrongCorrect").text("(<?php echo date('h:i:s A',time()); ?>)");
                        }else if(data=="Daing close!"){
                            $(".alertForVocher1").prepend('<i class="fa fa-clock fa-3x text-danger"></i><br><strong>Die is close!</strong>')
                        }else{
                            $(".racbalance").html(data);
                            $(".alertForVocher1").prepend('<i class="fa fa-check-circle text-success fa-3x"></i><br><strong>You betted Successfully!</strong><table class=" mt-3 table table-bordered table-dark"><thead><tr><th colspan="2" class="alertForVocher1Date" style="color:white">'+day+'-'+month+'-'+year+'</th><th colspan="2" style="color:white" class="alertForVocher1Time">03:30:00 PM</th></tr><tr>        <th style="color:yellow">2D</th>        <th style="color:yellow">R</th>        <th style="color:yellow">Price</th>    </tr>    </thead> <tbody class="alertForVocher1Tbody"> <tr>     <td colspan="2" style="color:yellow">Total is </td>     <td style="color:yellow" class="alertForVocher1Total">'+TotalBetPriceForThreed+'<span> MMK</span></td> </tr> </tbody></table>');
                            for(var i=0;i<confirmVocherBetPrice1ForThreed.length;i++){
                                var test=confirmVocherThreed1[i].value;
                                if(confirmVocherForThreedCheckbox1[i].checked==true){
                                    $(".alertForVocher1Tbody").prepend('<tr><td>'+test+'</td><td><i class="fa fa-check text-success"></i></td><td class="">'+confirmVocherBetPrice1ForThreed[i].value+' MMK</td>>');
                                }else{
                                    $(".alertForVocher1Tbody").prepend('<tr><td>'+test+'</td><td><i class="fa fa-times text-danger"></i></td><td class="">'+confirmVocherBetPrice1ForThreed[i].value+' MMK</td>>');
                                }
                            }
                        }
                        $(".background").show();
                        $(".alertForVocher1").fadeIn("fast");
                    }
                });
            }else{
                $(".alertForVocher1").prepend('<i class="fa fa-times-circle fa-3x text-danger mb-3"></i><br><strong>3D is only open on <span class="text-danger">1 and 16. </span>But You can pre-bet for next days.</strong><br>');
                $(".background").show();
                $(".alertForVocher1").fadeIn("fast");
            }
        });
        /***********************************************For Confirm 3d vocher end******************************************/

    </script>
</div>
