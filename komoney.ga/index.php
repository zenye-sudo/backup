
 <script>
   alert("This web application is temporlay breaking out.");
</script>
<?php
require_once("connection.php");
date_default_timezone_set("Asia/Rangoon");
$twelveD = "". date("Y-m-d")."12:00:50 PM";
$twelvefiveD ="".date("Y-m-d")."12:03:50 PM";
$twelveD = strtotime($twelveD);
$twelvefiveD = strtotime($twelvefiveD);
$fourthreeD ="". date("Y-m-d")."04:29:50 PM";
$fourthreefiveD ="". date("Y-m-d")."04:33:50 PM";
$fourthreeD = strtotime($fourthreeD);
$fourthreefiveD = strtotime($fourthreefiveD);
//Test start
if(isset($_COOKIE['useridKoMoney']) ){
    $one=$_COOKIE['useridKoMoney'];
    $two=1;
    $onef1=$one+1;
    $onef2=$onef1*$onef1;
    $twof1=$two+1;
    $twof2=$twof1*$twof1;
    $formula=$onef2+$twof2;
    $UserImg=$db->prepare("SELECT pp FROM users WHERE id=:id");
    $UserImg->execute(array(
        "id"=>$_COOKIE['useridKoMoney']
    ));
    $UserImgFetch=$UserImg->fetch();

}

/**for conservation date format start*/
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
function conservation_time_ago($dbData){
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
        return date("M d",$dbData);
    }else{
        return date("M d,Y");
    }
}
/**for conservation date format start*/
/**for user  date format start*/
function user_time_ago($dbData){
    $dbData=strtotime($dbData);
    $now=time();
    $seconds=$now-$dbData;
    $minutes=round($seconds/60);
    $hours=round($seconds/(60*60));
    $days=round($seconds/(60*60*24));
    $weeks=round($seconds/(7*60*60*24));
    $months=round($seconds/(((365+365+365+366)/5/12)*60*60*24));
    $years=round($seconds/(((365+365+365+366)/5)*60*60*24));
    if($seconds<=60){
        return "Just now";
    }else if($minutes<=60){
        if($minutes==1){
            return "one minute ago";
        }else{
            return $minutes." minutes ago";
        }
    }else if($hours<=24){
        if($hours==1){
            return "An hour ago";
        }else{
            return $hours." hours ago";
        }
    }else if($days<=7){
        if($days==1){
            return "Yesterday";
        }else{
            return $days." days ago";
        }
    }else if($weeks<=4.3){
        if($weeks==1){
            return "A week ago";
        }else{
            return $weeks." weeks ago";
        }
    }else if($months<=12){
        if($months==1){
            return "A month ago";
        }else{
            return $months." months ago";
        }
    }else{
        if($years==1){
            return "One year ago";
        }else {
            return $years." years ago";
        }
    }
}

/**for user date format start*/
//Test end
/**For pp and cp start */
$resultTest=$db->prepare("SELECT * FROM users WHERE id={$_COOKIE['useridKoMoney']}");
$resultTest->execute();
$dataTest=$resultTest->fetch();
$cpTest=json_decode($dataTest['cp']);
$ppTest=json_decode($dataTest['pp']);
/** For  pp and cp end */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ko Money 2D\3D</title>
        <link rel="stylesheet" href="http://mywebfont.appspot.com/css?font=yunghkio"/>
     <link rel="stylesheet" href="http://mywebfont.appspot.com/css?font=myanmar3"/>
     <link rel="stylesheet" href="http://mywebfont.appspot.com/css?font=padauk"/>
     <link rel="stylesheet" href="http://mywebfont.appspot.com/css?font=parabaik"/>
     <link rel="stylesheet" href="http://mywebfont.appspot.com/css?font=zawgyi"/>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="2d3d.png"/>
    <link rel="stylesheet" type="text/css" href="bootstrap\fontawesome-free-5.0.11\fontawesome-free-5.0.11\web-fonts-with-css\css\fontawesome-all.css">
    <style>
    *{
        font-family:"Masterpiece Uni Sans",Zawgyi-One,yunghkio;
    }
        #ulf>li,#ul>li{
            padding:12px;
            list-style-type:none;
            font-family:Cambria;
        }
        li{
            list-style-type:none;
        }
        /*******For typing animatin start**************/
        .spinme-left {
            display: inline-block;
            padding: 15px 20px;
            font-size: 14px;
            color: #ccc;
            border-radius: 30px;
            line-height: 1.25em;
            font-weight: 100;
            opacity: 0.2;
        }

        .spinner {
            margin: 0;
            width: 30px;
            text-align: center;
        }

        .spinner > div {
            width: 10px;
            height: 10px;
            border-radius: 100%;
            display: inline-block;
            -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
            animation: sk-bouncedelay 1.4s infinite ease-in-out both;
            background: rgba(0,0,0,1);
        }

        .spinner .bounce1 {
            -webkit-animation-delay: -0.32s;
            animation-delay: -0.32s;
        }

        .spinner .bounce2 {
            -webkit-animation-delay: -0.16s;
            animation-delay: -0.16s;
        }

        @-webkit-keyframes sk-bouncedelay {
            0%,
            80%,
            100% {
                -webkit-transform: scale(0)
            }
            40% {
                -webkit-transform: scale(1.0)
            }
        }

        @keyframes sk-bouncedelay {
            0%,
            80%,
            100% {
                -webkit-transform: scale(0);
                transform: scale(0);
            }
            40% {
                -webkit-transform: scale(1.0);
                transform: scale(1.0);
            }
        }
        /*******For typing animatin end**************/
        /****For ChatPage start***/
        #header{
            width:100%;
            height:12%;
            background-color:  #7798ff;
            position:relative;
        }
        #username{
            margin:0;
            color:white;
        }
        #time_ago{
            color:white;
        }
        #back{
            color:white;
            float:right;
            text-align:center;
            margin-top:2px;
        }
        /*FOr Header End*/
        /*For body Start*/
        #messages ul{
            margin:0;
            padding:0;
            margin-left:10px;
            /*margin-right:10px;*/
        }
        /*!*That is main tag*!*/
        #messages li {
            display:inline-block;
            clear:both;
            float:right;
            width:100%;
            margin:1px;
        }
        /*!*That is main tag*!*/
        #liimg{
            width:30px;
            height:30px;
            border-radius:50%;
        }
        #messages li p{
            padding: 10px 15px;
            border-radius:20px;
            color:white;
            font-size:13px;
            max-width:60%;
            overflow:hidden;
        }
        #messages li.replies img{
            float:left;
        }
        #messages li.replies p{
            background-color: #82eb6a;
            color: #000000;
            float:left;
        }
        #messages li.send img{
            float:right;
        }
        #messages li.send p{
            float:right;
            background: #7796ff;
            color:white;
        }
        #messages li:first-child{
            padding-top:14px;
        }
        /*#messages li:last-child{*/
        /*padding-bottom:55px;*/
        /*}*/
        #testing{
            color:red;
        }
        /*For body Start*/
        /*Foooter start*/


        #footer{
            margin:0;
            padding:0;
            width:100%;
            height:13%;
            position:relative;
        }
        #footer>textarea{
            width:75%;
            margin:0;
            padding:0;
            float:left;
            border:none;
            padding-left:14px;
        }
        #footer>textarea:focus{
            outline:none;
        }
        #footer>.attachment{
            width:10%;
            height:40px;
            float:left;
            border:none;
            font-size: 1.1em;
            color: #435f7a;
            cursor: pointer;
            background-color:white;
            opacity: 0.5;
        }
        #footer>.attachment:hover{
            opacity: 1;
            color:black;
        }
        .attachment:focus{
            outline:none;
        }
        #footer>.send{
            width:15%;
            height:46px;
            margin:0;
            border:none;
            background-color:  #7798ff;
            color:white;
            cursor: pointer;
        }
        .send:focus{
            outline:none;
        }
        /*Foooter start*/
        /****For ChatPage end***/

    </style>
    <!--    Style end-->
    <style>
        .dropdown-toggle::after {
            display: none;
        }

        #loading {
            display: none;
        }

        body {
            background-color: black;
            color: white;
        }

        a {
            color: white;
            font-size: 18px;
            font-family: bold:

        }

        li:hover > a {
            color: white;
        }
        .threed, .dowload, .bet {
            display: none;
        }

        .ui-datepicker {
            font-size: 18px;
        }

        .slipDiv:hover,.balanceDiv:hover {
            cursor: pointer;
        }

        #navbarSupportedContent .active {
            border-bottom: 1px solid black;
            color: black;
        }
    </style>
    <!--    For admin start-->
    <style>
        *{
            margin:0;padding:0;
        }
        #conservationDiv ul>li{
            padding:12px;
            list-style-type:none;
            font-family:Cambria;
        }
        li{
            list-style-type:none;
        }
        /*******For typing animatin start**************/
        .spinme-left {
            display: inline-block;
            padding: 15px 20px;
            font-size: 14px;
            color: #ccc;
            border-radius: 30px;
            line-height: 1.25em;
            font-weight: 100;
            opacity: 0.2;
        }

        .spinner {
            margin: 0;
            width: 30px;
            text-align: center;
        }

        .spinner > div {
            width: 10px;
            height: 10px;
            border-radius: 100%;
            display: inline-block;
            -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
            animation: sk-bouncedelay 1.4s infinite ease-in-out both;
            background: rgba(0,0,0,1);
        }

        .spinner .bounce1 {
            -webkit-animation-delay: -0.32s;
            animation-delay: -0.32s;
        }

        .spinner .bounce2 {
            -webkit-animation-delay: -0.16s;
            animation-delay: -0.16s;
        }

        @-webkit-keyframes sk-bouncedelay {
            0%,
            80%,
            100% {
                -webkit-transform: scale(0)
            }
            40% {
                -webkit-transform: scale(1.0)
            }
        }

        @keyframes sk-bouncedelay {
            0%,
            80%,
            100% {
                -webkit-transform: scale(0);
                transform: scale(0);
            }
            40% {
                -webkit-transform: scale(1.0);
                transform: scale(1.0);
            }
        }
        /*******For typing animatin end**************/
        /****For ChatPage start***/
        #header{
            width:100%;
            height:10%;
            background-color:  #7798ff;
            position:relative;
            overflow:auto;
        }
        #username{
            margin:0;
            color:white;
        }
        #time_ago{
            color:white;
        }
        #back{
            color:white;
            float:right;
            text-align:center;
            margin-top:2px;
        }
        /*FOr Header End*/
        /*For body Start*/
        #messages ul{
            margin:0;
            padding:0;
            margin-left:10px;
            /*margin-right:10px;*/
        }
        /*!*That is main tag*!*/
        #messages li {
            display:inline-block;
            clear:both;
            float:right;
            width:100%;
            margin:1px;
        }
        /*!*That is main tag*!*/
        #liimg{
            width:30px;
            height:30px;
            border-radius:50%;
        }
        #messages li p{
            padding: 10px 15px;
            border-radius:20px;
            color:white;
            font-size:13px;
            max-width:60%;
            overflow:hidden;
        }
        #messages li.replies img{
            float:left;
        }
        #messages li.replies p{
            background-color: #82eb6a;
            color: #000000;
            float:left;
        }
        #messages li.send img{
            float:right;
        }
        #messages li.send p{
            float:right;
            background: #7796ff;
            color:white;
        }
        #messages li:first-child{
            padding-top:14px;
        }
        /*#messages li:last-child{*/
        /*padding-bottom:55px;*/
        /*}*/
        #testing{
            color:red;
        }
        /*For body Start*/
        /*Foooter start*/


        #footer{
            margin:0;
            padding:0;
            width:100%;
            height:10%;
            position:relative;
        }
        #footer>textarea{
            width:75%;
            margin:0;
            padding:0;
            float:left;
            border:none;
            padding-left:14px;
        }
        #footer>textarea:focus{
            outline:none;
        }
        #footer>.attachment{
            width:10%;
            height:40px;
            float:left;
            border:none;
            font-size: 1.1em;
            color: #435f7a;
            cursor: pointer;
            background-color:white;
            opacity: 0.5;
        }
        #footer>.attachment:hover{
            opacity: 1;
            color:black;
        }
        .attachment:focus{
            outline:none;
        }
        #footer>.send{
            width:15%;
            height:46px;
            margin:0;
            border:none;
            background-color:  #7798ff;
            color:white;
            cursor: pointer;
        }
        .send:focus{
            outline:none;
        }
        /*Foooter start*/
        /****For ChatPage end***/

    </style>
    <!--    For admin end-->
</head>
<body>
<div class="m-0 p-0 col-12">
    <!-------------------------------------------------------------------Nav Start------------------------------------------------------------------->
    <div class="header">
        <ul class="nav nav-tabs m-0 p-0" style="background-color:#424242">
            <?php if(isset($_GET['status'])): ?>
            <li class="nav-item col-2 p-0 m-0 choose" data-name="2d">
                <a class="nav-link text-center" href="#">2D</a>
            </li>
            <?php else :?>
            <li class="nav-item col-2 p-0 m-0 choose" data-name="2d">
                <a class="nav-link active text-center" href="#">2D</a>
            </li>
            <?php endif; ?>

            <li class="nav-item col-2 p-0 m-0 choose" data-name="3d">
                <a class="nav-link text-center" href="#">3D</a>
            </li>
            <li class="nav-item col-4 p-0 m-0 choose" data-name="football">
                <a class="nav-link text-center" href="#">ေဘာလံုး</a>
            </li>
            <li class="nav-item col-2 p-0 m-0 choose" data-name="lottery">
                <a class="nav-link text-center" href="#">ထီ</a>
            </li>

            <?php if(isset($_GET['status'])): ?>
            <li class="nav-item col-2 p-0 m-0 choose" data-name="bet" id="specialBet" data-test="bet">
                <a class="nav-link text-center active" href="#">Bet</a>
            </li>
            <?php else: ?>
            <li class="nav-item col-2 p-0 m-0 choose" id="specialBet" data-name="bet" data-test="bet">
                <a class="nav-link text-center" href="#">Bet</a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
    <!-------------------------------------------------------------------Nav end----------------------------------------------------------------->
    <!-------------------------------------------------------------------    FOr 2d start------------------------------------------------------------>
    <div class="twod">
        <table class="table table-bordered m-0" style="background-color: #000000;">
            <tr class="border-0">
                <td id="set" class="pl-2 p-0" style="font-size:15px;width:45%;padding-left:10px;">SET <strong
                            style="color:red;">...</strong></td>
                <td class="col-4 p-0 pl-2" id="setvalue" style="font-size:15px;width:55%;">SET VAL <strong
                            style="color:red;">...</strong>
                </th>
            </tr>
        </table>
        <!-- ----------------------------------------------------------------       Main 2d Live Show start----------------------------------------->
        <div class=" m-0  p-0 text-center">
            <span id="2d1"
                  style="color:red;margin:0;padding:0;font-size:120px;font-family: 'Anton', sans-serif;">!</span>
            <span id="2d2"
                  style="color:red;margin:0;padding:0;font-size:120px;font-family: 'Anton', sans-serif;">!</span>
        </div>
        <!--    -----------------------------------------------------------------    Main 2d Live Show End-------------------------------------------->
        <!-------------------------------------------------------------------------- FOr Time and Search Start----------------------------------------->
        <div class="m-0 mb-2 row justify-content-between">
            <strong class="pt-1" id="jsTime"></strong>
            <button type='text' class="btn btn-primary btn-sm" id="datepickerbtn">Search by Date</button>
        </div>
        <!-------------------------------------------------------------------------- FOr Time and Search end----------------------------------------->
        <!--        For 12:00 and 4:30 start-->
        <input type="hidden" id="datepicker">
        <div id="error" class="text-center"></div>
        <div id="error1" class="text-center" style="display:none;">
            <button class="btn btn-secondary btn-sm return">Return</button>
        </div>
        <!--------------------------------------------------------------------------  AJAX CALL HIDE START-------------------------------------------->
        <div id="AjaxCallHide">
            <!----------------------------------------------------------------------For search result 3d start----------------------------------------->
            <table class='table table-bordered' id="searchResult3d" style="display:none;">
                <tbody>
                <tr class="bg-primary">
                    <td class='p-0 text-center'>Type</td>
                    <td class='p-0 text-center'>Date</td>
                    <td class='p-0 text-center'>3:30PM</td>
                </tr>
                <tr>
                    <td class='p-0 text-center text-primary' style="font-size:18px;">3D</td>
                    <td class='p-0 text-center' style="color:yellow" id="searchResult3dDate">12-23-2028</td>
                    <td class='p-0 text-center' style="color:yellow;font-size:18px;" id="searchResult3d2d">323</td>
                </tr>
                </tbody>
            </table>
            <!----------------------------------------------------------------------For search result 3d end----------------------------------------->
            <table class="table table-bordered">
                <tbody>
                <tr class="bg-primary">
                    <td class="p-0 text-center">Date</td>
                    <td class="p-0 text-center">12:00PM</td>
                    <td class="p-0 text-center">04:30PM</td>
                </tr>
                <tr>
                    <td class="text-center p-0 date" style="color:yellow"><?php echo date('d-m-Y', time()); ?></td>
                    <td class="text-center p-0 holiday" id='maintwelvehour'>
                        <!--                        FOr 12:00 am start-->
                        <?php
                        if (date("D", time()) != "Sat" && date("D", time()) != "Sun") {
                            $twelve = $db->prepare("SELECT 2d FROM 2d WHERE date=:dat AND name=:nam AND channel=:channel AND type=:type");
                            $twelve->execute(array(
                                "dat" => date('Y-m-d', time()),
                                "nam" => "12:00",
                                "channel" => "internet",
                                "type" => 0
                            ));
                            if ($twelve->rowCount() != 0) {
                                $twelveFetch = $twelve->fetch();
                                echo '<strong style="color:yellow;font-size:20px;">' . $twelveFetch['2d'] . '</strong>';
                            } else {
                                echo '<strong style="color:red;font-size:20px;">!!</strong>';
                            }
                        } else {
                            if (date("D", time()) == "Sat") {
                                echo '<strong style="color:red;font-size:14px;">Close on Sat!</strong>';
                            } else {
                                echo '<strong style="color:red;font-size:14px;">Close on Sun!</strong>';
                            }
                        }
                        ?>
                        <!--                        FOr 12:00 am End-->
                    </td>
                    <td class="text-center p-0 holiday" id="mainfourhour">
                        <!--                    FOr 4:00 am start-->
                        <?php
                        if (date("D", time()) != "Sat" && date("D", time()) != "Sun") {
                            $twelve = $db->prepare("SELECT 2d FROM 2d WHERE date=:dat AND name=:nam AND channel=:channel AND type=:type");
                            $twelve->execute(array(
                                "dat" => date('Y-m-d', time()),
                                "nam" => "4:30",
                                "channel" => "internet",
                                "type" => 0
                            ));
                            if ($twelve->rowCount() != 0) {
                                $twelveFetch = $twelve->fetch();
                                echo '<strong style="color:yellow;font-size:20px;">' . $twelveFetch['2d'] . '</strong>';
                            } else {
                                echo '<strong style="color:red;font-size:20px;">!!</strong>';
                            }
                        } else {
                            if (date("D", time()) == "Sat") {
                                echo '<strong style="color:red;font-size:14px;">Close on Sat!</strong>';
                            } else {
                                echo '<strong style="color:red;font-size:14px;">Close on Sun!</strong>';
                            }
                        }

                        ?>
                        <!--                    FOr 4:00 am end-->
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <!--------------------------------------------------------------------------  AJAX CALL HIDE START-------------------------------------------->
        <div id="loading" class="position-relative text-center">
            <img src="loading.gif" alt="Loading...">
            <p class="loadingP"></p>
        </div>
        <!-- Payment proof start -->
        <div id="proof" style="overflow:auto;width:100%;height:800px;border-radius:15px;border:1px solid yellow;">
        <table class="table table-striped table-dark">
            <thead style="text-align:center;background-color:red;background-color:rgb(11,0,24)" rowspan="2">
                <tr>
                    <td style="text-align: center;color:yellow;font-size:20px;" colspan="4">Memberမ်ား၏ ေငြထုတ္ယူမႈ</td>
                </tr>
            </thead>
            <thead>
                <tr>
                    <th scope="col">ရက္စြဲ</th>
                    <th scope="col">နာမည္</th>
                    <th scope="col">ဘဏ္</th>
                    <th scope="col">MMK</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
            <div class="proofAjaxLoading text-center">
              <img src="loading.gif" alt="">
            </div>
            <button class="proofLoad_more1" data-page="1" style="display:none;">Load more</button>
        </div>
        <!-- Payment proof end -->
            
    </div>
    <!-------------------------------------------------------------------    FOr 2d end------------------------------------------------------------>
    <!-------------------------------------------------------------------    FOr 3d start------------------------------------------------------------>
    <div class="threed">
        <table class="table table-bordered">
            <tr class="border-0">
                <td id="set" class="pl-2 p-0 text-center" style="font-size:15px;width:45%;padding-left:10px;"><strong
                            style="color:white;" id="jsTime1"></strong></td>
                <td class="col-4 p-0 pl-2 text-center" id="setvalue" style="font-size:15px;width:55%;"><strong
                            style="color:white;"><?php echo date("d-m-Y", time()) ?></strong>
                </th>
            </tr>
        </table>
        <div class=" m-0 p-0 text-center">
            <strong style='position:absolute' id="3dDate">
                <?php
                $lastestDate = $db->prepare("select date from 2d where type=1 order by date desc limit 1");
                $lastestDate->execute();
                $lastestDateFetch = $lastestDate->fetch();
                $lastestDateFetch = strtotime($lastestDateFetch['date']);
                echo date("d-m-Y", $lastestDateFetch);
                ?>
            </strong>
            <span id="3d"
                  style="color:red;margin:0;padding:0;font-size:120px;font-family: 'Anton', sans-serif;">!</span><br>
        </div>
        <!-- For history of 3d start -->
        <table class="table table-bordered" id="threedLog">
            <?php
            $threedLog = $db->prepare("select * from 2d where type=1 ORDER BY date desc LIMIT 10");
            $threedLog->execute();
            ?>
            <?php foreach ($threedLog->fetchAll() as $key => $value): ?>
                <?php
                $dbDate = $value['date'];
                $uiDate = strtotime($dbDate);
                ?>
                <tr class="m-0 p-0">
                    <td style="width:40%;color:yellow;"
                        class="p-0 m-0 text-center"><?php echo date("d-m-Y", $uiDate); ?></td>
                    <td class="text-center m-0 p-0 test"
                        style="font-size:18px;font-family:bold;color:yellow;"><?php echo $value['2d']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
       <!-- for history of 3d end -->
    </div>
    <!-------------------------------------------------------------------    FOr 3d start------------------------------------------------------------>
    <!--    <div style="position:fixed;width:100%;height:100%;background-color:red;top:0;left:0;"></div>-->
    <!-------------------------------------------------------------------   For bet(lown yan) start--------------------------------------------------->
    <div id="bet" class="bet m-0 p-0" style="overflow: hidden;">
        <!--        FOr Absolute Navbar start-->
        <div class="m-0 p-0 position-relative forNavbar fornav" style="width:100%;">
            <!--navbar start-->
            <nav class="navbar navbar-expand-lg navbar-light bg-light fornav">
                <button class="btn btn-light btn-sm dropdown text-white p-0" id="btn" href="#"
                        style="height:40px;position:relative;margin-top:0;top:0;left:0;">
                    <div class="notMemberBtn">
                        <span class="loginRegister"><i class="fa fa-user-circle text-dark fa-2x"></i></span>
                        <strong class="loginRegister position-relative"
                                style="color:black;bottom:5px;">Login/Register</strong>
                    </div>
                    <div class="memberBtn">
                        <a class="dropdown-toggle" id="dropdownMenuButton"
                           style="position:relative;top:0;left:0;padding:0;display:inline-block;height:10px;margin-top:0;"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="row" style="position:relative;top:0;margin:0;">
                                <div style="">
                                    <i class="fa fa-user-circle fa-2x text-dark"></i>
                                </div>
                                <div style="padding:0;margin-left:4px;">
                                    <p style="color:black;margin:0;padding:0;font-size: 15px;" class="vacUsername"><?php
                                        $userData = $db->prepare("select * from users where id=:id and username=:username");
                                        $userData->execute(array(
                                            "id" => $_COOKIE["useridKoMoney"],
                                            "username" => $_COOKIE["usernameKoMoney"]
                                        ));
                                        $userDataFetch = $userData->fetch();
                                        echo $userDataFetch["username"];
                                        ?></p>
                                    <p class="vacAndRacChange" style="color:black;font-size:10px;margin:0;padding:0;position:relative;left:0;">Virtual Account</p>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item vac" href="#">Vritual Account</a>
                            <a class="dropdown-item rac" href="#">Real Account</a>
                            <a class="dropdown-item logout" href="logout.php">Logout</a>
                        </div>
                    </div>
                </button>
                <a href="" class="navbar-brand p-0 forMemberSetting"><i class="fa fa-cog"></i></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-align-justify" style="font-size:20px;"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link homeLink" style="cursor:pointer;" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link dh" style="cursor:pointer;">Deposit History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link wh" style="cursor:pointer;">Withdraw History</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link howToPlayLink" style="cursor:pointer;">How to play?</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link dowloadApkLink " style="cursor:pointer;">Dowload APK</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!--navbar end-->
            <div class="forMember">
                <div class="row fornavForMoney m-0 p-0">
                    <div class="col-4 bg-danger slipDiv"><i class="fa fa-align-justify pl-2 pt-2 pb-2"></i><span class="pl-1" style="width:100%;">Slips</span></div>
                    <div class="col-8 bg-warning balanceDiv" style="cursor:pointer;"><i class="fa fa-money-bill-alt pl-0 pt-2 pb-2"></i>
                        <span class="pl-1 vacbalance"><?php echo $userDataFetch["vac"]; ?></span>
                        <span class="pl-1 racbalance" style="display:none;"><?php echo $userDataFetch["rac"]; ?></span>
                        <small>MMK</small>
                        <i class="fa fa-minus-circle text-danger position-relative minusFont" style="top:2px;display:none;"></i>
                    </div>
                </div>
                <div class="bg-dark extraDiv" style="height:400px;display:none;overflow:auto;">
                    <div class="slips">

                    </div>
                    <div class="extraDivLoading text-center" style="padding-top:100px;display:none"><img src="loading.gif" alt=""></div>
                </div>
            </div>

        </div>
        <!--        FOr Absolute Navbar end-->
        <div id="loadingForBet" class="position-fixed col-12 text-center" style="z-index:20;display:block;padding-top:160px;left:0;width:100%;height:100%;background-color:rgba(0,0,0,0.7);"><img src="loading.gif" alt=""><p style="color:white">Please wait!</p></div>
        <div class="forChange"></div>
    </div>
    <!-------------------------------------------------------------------   For bet(lown yan) end--------------------------------------------------->
    <!-------------------------------------------------------------------   For chat Div start ------------------------------------------------->
    <div class="chatDivBackground" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;z-index:100;color:black;font-family:'Cambria Math'">
        <div style="display:block;background-color:white;width:98%;margin:1px auto;overflow:hidden;height:91%;border-radius:10px;" class="chatDiv">
            <!-----------------------------For chat navbar div start --------------------------->
            <div style="width:100%;height:11%;background-color:#ffffff;">
                <!--            <div class="container-fluid m-0 p-0" style="position:relative;width:100%;height:10%;">-->
                <div class="card border-bottom-0  " style="border-top-right-radius:0px;border-top-left-radius:0px;border-bottom-left-radius:0px;border-bottom-right-radius:0px; ">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-3 text-center bg-primary text-white" style="line-height:34px;border-radius:5px;">
                                <li style="list-style-type:none;cursor:pointer;" id="messages"><i class="fab fa-facebook-messenger"></i></li>
                            </div>
                            <div class="col-3 text-center" style="line-height:34px;border-radius:5px;">
                                <li style="list-style-type:none;cursor:pointer;" id="contacts"><i class="fa fa-users"></i></li>
                            </div>
                            <div class="col-3 text-center" style="line-height:34px;border-radius:5px;">
                                <li style="list-style-type:none;cursor:pointer;" id="search"><i class="fa fa-search"></i></li>
                            </div>
                            <div class="col-3 text-center" style="line-height:34px;border-radius:5px;">
                                <li style="list-style-type:none;cursor:pointer;" id="profile"><i class="fa fa-cogs"></i></li>
                            </div>
                        </div>
                    </div>
                </div>
                <!--            </div>-->
            </div>
            <!-----------------------------For chat navbar div end   --------------------------->
            <!-------------------------------For Chat Conservation and Friends,searchResult div start ------>
            <div style="margin:0;padding:0;width:100%;height:82%;display:block;overflow-y:auto;overflow-x: hidden">
                <!--       For Message Conservation Section  Div Start-->
                <div class="container" id="messagesdiv" style="display:block">
                    <div class="container-fluid p-0" style="position:relative;top:12px;">
                        <p style="border-bottom: 2px solid blue;font-size:19px;font-family:bold;">
                            Chat Conservation(<span id="conservationCount"><?php
                                $conservationCount=$db->prepare("select count(*) from conservation where uid={$_COOKIE['useridKoMoney']}");
                                $conservationCount->execute();
                                echo $conservationCount->fetchColumn();?></span>)</p>
                    </div>
                    <div class="card-block">

                        <ul class="m-0 p-0" id="ulf">
                            <?php
                            $retrieveConservation=$db->prepare("select * from conservation where uid={$_COOKIE['useridKoMoney']}");
                            $retrieveConservation->execute();
                            ?>
                            <?php  foreach ($retrieveConservation->fetchAll() as $item) : ?>
                                <?php
                                /**for formula start*/
                                $know=$_COOKIE['useridKoMoney'];
                                $know1=($know+1)*($know+1);
                                $sum=$item['tn'];
                                $cal=(sqrt($sum-$know1))-1;
                                /**for formula end*/
                                $retrieveConservation1=$db->prepare("select * from `{$item["tn"]}` ORDER BY id DESC limit 1 ");
                                $retrieveConservation1->execute();
                                $retrieveConservation1Data=$retrieveConservation1->fetch();
                                $showConservationName=$db->prepare("select * from users where id={$cal}");
                                $showConservationName->execute();
                                $showConservationNameData=$showConservationName->fetch();
                                $pp=json_decode($showConservationNameData['pp']);
                                /**for conservation date format start*/
                                $retrieveConservation2=$db->prepare("select * from `{$item["tn"]}` ORDER BY id DESC");
                                $retrieveConservation2->execute();
                                $retrieveConservation2Data=$retrieveConservation2->fetch();
                                $dd="";
                                $tnDbDate=$retrieveConservation2Data['created_at'];
                                $cvDbDate=$item['created_at'];
                                if($tnDbDate!=""){
                                    $dd=conservation_time_ago($tnDbDate);
                                }else{
                                    $dd=conservation_time_ago($cvDbDate);
                                }
                                /**for check active conservation start*/
                                $checkActive=$db->prepare("select * from login_details where uid={$cal}");
                                //$activeUser1=$db->prepare("select users.id,users.username,users.pp from users inner join login_details on login_details.uid=users.id where login_details.last_activity>DATE_SUB(NOW(),INTERVAL 5 SECOND) AND users.id!={$_COOKIE['userid']}");
                                $checkActive->execute();
                                $checkActiveData=$checkActive->fetch();
                                /**for check active conservation end*/
                                /**for conservation date format End*/
                                //FOr Check Friends Active start
                                $test=$db->prepare("select * from friends where ((uid1=:one AND uid2=:two) OR (uid1=:two AND uid2=:one)) AND (friendship_offical='1')");
                                $test->execute(array(
                                    "one"=>$cal,
                                    "two"=>$_COOKIE['useridKoMoney']
                                ));
                                $str="";
                                if($test->rowCount()==0){
                                    $str="";
                                }else{
                                    if(user_time_ago($checkActiveData['last_activity'])=="Just now"){
                                        $str="border:3px solid #00b300;";
                                    }else {
                                        $str="";
                                    }
                                }
                                //check Friends Active start
                                /*********For check Photot start*********/
                                $var=$retrieveConservation1Data['text'];
                                $dotPosition=strpos($var,".");
                                $dotPositionCut=substr($var,$dotPosition);
                                $dotPositionCuted="";
                                if($dotPositionCut==".jpg" || $dotPositionCut==".jpeg" || $dotPositionCut==".gif" || $dotPositionCut==".png"){
                                    $dotPositionCuted="Sent a photo";
                                }else{
                                    $dotPositionCuted=$retrieveConservation1Data['text'];
                                }
                                /*********For check Photot end*********/
                                ?>
                                <?php if($item['tn']=="2d3dgroup"): ?>
                                    <li class="activeCheck pl-0 pr-0"  style="border-radius:5px;background:#faf5f5;margin-bottom:3px;border-bottom:1px solid blue;">
                                        <div class="row m-0">
                                            <div style="border:0;width:17%;text-align:center;"><img src="2d3d.png" style="width:50px;height:50px;border-radius:50%"></div>
                                            <div style="width:63%;padding-left:3px;" class="liConservationGroup">
                                                <span>2D/3D Group</span><br>
                                                <small><?php if($retrieveConservation1Data['uid']==$_COOKIE['useridKoMoney']){echo "You: ".substr($dotPositionCuted,0,25);}else if($retrieveConservation1->rowCount()==0){echo "You are now connected on chatbox.";}else{echo substr($dotPositionCuted,0,25);} ?></small>
                                            </div>
                                            <div class="cd" style="width:20%;text-align:center;">
                                                <small><?php echo $dd; ?></small>
<!--                                                 <a href="#" class="cdbtn" data-uid="<?php echo $_COOKIE['useridKoMoney'] ?>" data-tn="<?php echo $item['tn']; ?>" style="text-decoration:none;display:none;color:red;">X</a> -->
                                            </div>
                                        </div>
                                    </li>
                                <?php else: ?>
                                <?php
                                    $retriveUnseen=$db->prepare("select * from `{$item['tn']}` where uid!={$know} and view=0");
                                    $retriveUnseen->execute();
                                ?>
                                    <li class="activeCheck pl-0 pr-0" data-uid="<?php echo $showConservationNameData['id']; ?>"  style="border-radius:5px;background:#faf5f5;margin-bottom:3px;border-bottom:1px solid blue;">
                                        <div class="row m-0" style="">
                                            <div style="border:0;width:17%;text-align:center;"><img src="user/pp/<?php echo $pp ?>" style="width:50px;height:50px;border-radius:50%;<?php echo $str; ?>"></div>
                                            <div style="width:63%;padding-left:3px;" class="liConservation" data-id="<?php echo $cal; ?>">
                                                <span><?php if($item['tn'] != $formula){echo $showConservationNameData['username'];}else{echo "ေငြသြင္း\ေငြထုတ္";} ?></span><?php if($retriveUnseen->rowCount()!=0){echo '<span class="unseenNumber ml-1 badge badge-pill badge-danger">'.$retriveUnseen->rowCount().'</span>';} ?><br>
                                                <small><?php if($retrieveConservation1Data['uid']==$_COOKIE['useridKoMoney']){echo "You: ".substr($dotPositionCuted,0,25);}else if($retrieveConservation1->rowCount()==0){echo "<small>You are now connected on chatbox.</small>";}else{echo substr($dotPositionCuted,0,25);} ?></small>
                                            </div>
                                            <div class="cd" style="width:20%;text-align:center;">
                                                <small><?php echo $dd; ?></small>
                                                <?php if($item['tn'] != $formula): ?>
                                                <a href="#" class="cdbtn" data-uid="<?php echo $_COOKIE['useridKoMoney'] ?>" data-tn="<?php echo $item['tn']; ?>" style="text-decoration:none;color:white;display:block;color:red;">X</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <!--       For Message Conservation Section end-->
                <!--       For Contacts section start  ----------->
                <div class="container-fluid m-0 p-0" id="contactsdiv" style="display:none">
                    <!--             For Sub Navigation Start-->
                    <div class="container-fluid m-0 p-0" style="overflow-y:auto;overflow-x:hidden">
                        <div class="card-header p-1 m-0 bg-white border-0" style="border:1px solid blue;background-color: rgba(0,0,0,0.1)">
                            <div class="row">
                                <div class="col-6 text-center" id="friends" style="background-color: #5876ff;color:white;">
                                    <li style="cursor:pointer"><i class="fa fa-user-friends"></i></li>
                                </div>
                                <div class="col-6 text-center" id="ra" style="background-color:rgba(0,0,0,0.1);">
                                    <li style="cursor:pointer"><i class="fa fa-reply-all"></i></li>
                                </div>
                            </div>
                        </div>
                        <div class="card-block m-3 m-0 p-0">
                            <div class="container-fluid m-0 p-0" id="friendsdiv" style="display:block">
                                <!--For count active friends start-->
                                <p style="border-bottom:2px solid blue;color:black;font-family:'Arial Black'">Active Friends<span id="act"><?php
                                        $activeUser1=$db->prepare("select users.id,users.username,users.pp from users inner join login_details on login_details.uid=users.id where login_details.last_activity>DATE_SUB(NOW(),INTERVAL 5 SECOND) AND users.id!={$_COOKIE['useridKoMoney']}");
                                        $activeUser1->execute();
                                        $test=0;
                                        foreach($activeUser1->fetchAll() as $item){
                                            $checkFriend1=$db->prepare("select COUNT(*) from friends where ((uid1=:one AND uid2=:two) OR (uid1=:two AND uid2=:one)) AND (friendship_offical='1')");
                                            $checkFriend1->execute(array(
                                                "one"=>$item['id'],
                                                "two"=>$_COOKIE['useridKoMoney']
                                            ));
                                            $test=$test+$checkFriend1->fetchColumn();
                                        }
                                        echo "(".$test.")";
                                        ?></span></p>
                                <!--For count active friends end-->
                                <!--For preload Active Friends start-->
                                <div style="margin:0;padding:0">
                                    <ul style="margin:0;padding:0;" id="activeFriend">
                                        <?php
                                        $activeUser=$db->prepare("select users.id,users.username,users.pp from users inner join login_details on login_details.uid=users.id where login_details.last_activity>DATE_SUB(NOW(),INTERVAL 5 SECOND) AND users.id!={$_COOKIE['useridKoMoney']}");
                                        $activeUser->execute();
                                        foreach($activeUser->fetchAll() as $item){
                                            $checkFriend=$db->prepare("select * from friends where ((uid1=:one AND uid2=:two) OR (uid1=:two AND uid2=:one)) AND (friendship_offical='1')");
                                            $checkFriend->execute(array(
                                                "one"=>$item['id'],
                                                "two"=>$_COOKIE['useridKoMoney']
                                            ));
                                            $checkFriend1=$db->prepare("select COUNT(*) from friends where ((uid1=:one AND uid2=:two) OR (uid1=:two AND uid2=:one)) AND (friendship_offical='1')");
                                            $checkFriend1->execute(array(
                                                "one"=>$item['id'],
                                                "two"=>$_COOKIE['useridKoMoney']
                                            ));
                                            $test=$test+$checkFriend1->fetchColumn();
                                            $pp=json_decode($item['pp']);
                                            if($checkFriend->rowCount()>0){
                                                echo '<li class="activeCheck1 toTalkDiv"  data-id="'.$item["id"].'"><div style="padding-bottom:14px;">
                                      <img src="user/pp/' .$pp.'" alt="user" style="width:50px;height:50px;border-radius:50%;"> 
                                      <span style="display:inline">'.$item["username"].'</span>
                                      <i class="fa fa-circle" style="color:#00c500;position:relative;right:0;float:right;"></i>
                                      </div></li>';
                                            }
                                        }
                                        if($test==0){
                                            echo '<li><div><small class="text-muted">There is no active friend Sir.</small></div></li>';
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <!--                    <!--For preload Active Friends End-->
                                <!--                           FOr count Friend List Start-->
                                <p style="margin-top:24px;border-bottom:2px solid blue;font-family:'Arial Black'">Friends List (<span id="friendCount"><?php
                                        $result11=$db->prepare("SELECT COUNT(*) FROM friends WHERE (uid2=:uid2 OR uid1=:uid2) AND friendship_offical='1'");
                                        $result11->execute(array(
                                            "uid2"=>$_COOKIE['useridKoMoney']
                                        ));
                                        echo $result11->fetchColumn();?></span>)</p>
                                <!--                           FOr count Friend List ENd-->
                                <div class="container-fluid m-0 p-0" style="margin:0;padding:0;">
                                    <!--Preload Friend List Start-->
                                    <ul style="margin:0;padding:0;" id="fladd">
                                        <?php
                                        $test="";
                                        $result=$db->prepare("SELECT * FROM friends WHERE (uid1=:uid1 OR uid2=:uid1) AND friendship_offical='1'");
                                        $result->execute(array(
                                            "uid1"=>$_COOKIE['useridKoMoney']
                                        ));
                                        foreach ($result->fetchAll() as $item){
                                            $hey=$db->prepare("select * from users where (id=:id OR id=:id1)");
                                            $hey->execute(array(
                                                "id"=>$item['uid1'],
                                                "id1"=>$item['uid2']
                                            ));
                                            foreach($hey->fetchAll() as $data){
                                                if($data['id']!=$_COOKIE['useridKoMoney']){
                                                    $pp=json_decode($data['pp']);
                                                    echo '<li class="pr-0 pl-0 container-fluid"  style="position:relative;">
                                                <div class="pl-0 pr-0 pb-3 activeCheck1 toTalkDiv" data-id="'.$data["id"].'">
                                                <img src="user/pp/'.$pp.'" alt="user" style="width:50px;height:50px;border-radius:50%;">
                                                 <span style="display:inline">'.$data["username"].'</span>
                                                 </div>
                                                <button class="bg-danger text-white unfri" data-id="'.$item["id"].'" style="position:absolute;top:14%;right:0;display:inline;float:right;border:0;border-radius:5px;margin-left:4px;margin-top:10px;">Unfriend</button>
                                                 </li>';
                                                }
                                            }

                                        }
                                        if($result->rowCount()==0){
                                            echo '<li><div><small class="text-muted">Search your friends on the searchbar <br>You can search your friends on the searchbar by typing their name Or Id </small></div></li>';
                                        }

                                        ?>
                                    </ul>
                                    <!--                               Preload Friend List End-->
                                </div>
                            </div>
                            <div class="container-fluid m-0 p-0" id="radiv" style="display:none">
                                <!--                           For count Friend Request Count-->
                                <p style="border-bottom:2px solid blue;font-family:'Arial Black'">Friend Requests(<span id="acceptCount"><?php
                                        $result101=$db->prepare("SELECT COUNT(*) FROM friends WHERE uid2=:uid2 AND friendship_offical='0'");
                                        $result101->execute(array(
                                            "uid2"=>$_COOKIE['useridKoMoney']
                                        ));
                                        echo $result101->fetchColumn();
                                        ?></span>)</p>
                                <!--                           For count Friend Request Count-->
                                <div>
                                    <ul id="fradd" style="margin:0;padding:0;">
                                        <!--                 Preload Accept Friend Start-->
                                        <?php
                                        $result=$db->prepare("SELECT * FROM friends WHERE uid2=:uid2 AND friendship_offical='0'");
                                        $result->execute(array(
                                            "uid2"=>$_COOKIE['useridKoMoney']
                                        ));
                                        $test="";
                                        foreach ($result->fetchAll() as $item){
                                            $result01=$db->prepare("select * from users where id=:id");
                                            $result01->execute(array(
                                                "id"=>$item['uid1']
                                            ));
                                            $data=$result01->fetch();
                                            $pp=json_decode($data['pp']);
                                            $test.='<div class="mb-3"><img src="user/pp/'.$pp.'" alt="user" style="width:50px;height:50px;border-radius:50%;"> <span style="display:inline">'.$data["username"].'</span><button class="bg-danger text-white del" data-id="'.$item["id"].'" style="display: inline;float:right;border:0;border-radius:5px;margin-left:10px;margin-top:10px;"><i class="fa fa-times fa-2x" style="font-size:20px;"></i></button><button class="bg-primary text-white acc" data-id="'.$item["id"].'"   style="display:inline;float:right;border:0;border-radius:5px;margin-top:10px;"><i class="fa fa-check text-white" style="font-size:20px;"></i></button></div>';
                                        }
                                        if($result->rowCount()==0){
                                            echo '<li><div><small class="text-muted">There is no friend request sir.</small></div></li>';
                                        }else{
                                            echo $test;
                                        }
                                        ?>
                                        <!--Preload Accept Friend ENd-->
                                    </ul>
                                </div>
                                <p style="border-bottom:2px solid blue;font-family:'Arial Black';padding-top:20px;">Add Friends</p>
                                <div id="afadd">
                                    <!--                            <div class="p-2">-->
                                    <!--                                <img src="user/pp/1528195481_this.jpg" alt="user" style="width:50px;height:50px;border-radius:10%;">-->
                                    <!--                                <span style="display:inline">Aung Myat Thu</span>-->
                                    <!--                                <button class="bg-primary text-white" style="float:right;border:0;border-radius:5px;margin-left:4px;margin-top:10px;">Asadd Friend</button>-->
                                    <!--                                <button class="bg-warning text-white" style="float:right;border:0;border-radius:5px;margin-left:4px;margin-top:10px;display:none;">Cancel Request</button>-->
                                    <!--                            </div>-->
                                    <small class="text-muted">This feature is comming soon!You can search your friends on the search bar by typing name!</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--             For Sub Navigation End-->
                </div>
                <!--       For Contacts section end    ----------->
                <!--       For search Result start     ----------->
                <div id="searchdiv" style="display:none;width:100%;height:100%;overflow:auto">
                    <p style="padding-left:10px;text-align:center;display:none;" class="m-0 p-0 searchResultCharacterDiv">Search Result For: "<strong style="color:blue;" class="searchResultCharacterSpan"></strong>"</p>
                    <ul id="ul" class="m-0 p-0"></ul>
                    <div id="ploading" class="text-center" style="display:none;" data-page="0">
                        <img src="loading.gif"  style="cursor:pointer;">
                    </div>
                </div>
                <!--       For search result end       ----------->
                <!--       For Profile section start   ----------->
                <div id="profilediv" style="display:none;">
                    <!--            FOr cover photo start-->
                    <div class="container" style="width:100%;height:220px;position:relative;">
                        <img src="user/cp/<?php echo $cpTest; ?>" id="cpimg" class="col-12 p-0 img-thumbnail" alt="" style="height:220px;">
                        <div class="col-md-3 col-7 position-absolute" style="top:0;background-color:rgba(0,0,0,0.4)">
                            <input type="file" class="custom-file-input" id="cp1" name="file1">
                            <i class="fa fa-camera fa-2x " style="position:absolute;top:2px;color:#cdcdcd;" id="cp2"><p style="font-size:12px;position:relative;top:-20px;left:39px">Update Cover Photo</p></i>
                        </div>
                    </div>
                    <!--            FOr cover photo End-->
                    <!--            FOr pp Start-->
                    <div class="container" style="text-align:center;position:relative;bottom:30px;width:100%;height:140px;" id="pp">
                        <img src="user/pp/<?php echo $ppTest; ?>" class="col-4 col-md-2 p-0 img-thumbnail" id="ppimg" style="width:130px;height:110px;">
<!--                        <h4 style="display:inline-block;position:relative;bottom:20px;color:white;padding:0;margin:0" id="h4">--><?php //echo $dataTest['username']; ?><!--</h4>-->
                        <div class="p-0 position-relative col-4 col-md-2 text-center" style="top:-37px;background-color: rgba(0,0,0,0.4);margin:0 auto;width:130px;">
                            <input type="file" class="custom-file-input" id="pp1" name="file" style="">
                            <i class="fa fa-camera fa-1x" style="position: absolute;top:11px;left:45%;color:#cdcdcd" id="pp2"></i>
                        </div>
                        <h3 style="position:relative;bottom:30px;"><?php echo $dataTest['username']; ?></h3>
                    </div>
                    <!--            FOr pp End-->
                </div>
                <!--       For Profile section end     ----------->
            </div>
            <!-------------------------------For Chat Conservation and Friends,searchResult div end ----------->
            <!-------------------------------For searchBar div start------------------------------------->
            <div style="width:100%;height:7%">
                <form class="m-0 p-0">
                    <div class="form-group m-0 p-0">
                        <input type="text" class="form-control" id="keywords" name="keywords" style="border-radius:0;" placeholder="Search by name or email" autocomplete="off">
                    </div>
                </form>
            </div>
            <!-------------------------------For searchBar div end------------------------------------->
        </div>
        <div style="display:none;background-color:white;width:98%;margin:1px auto;overflow:hidden;height:91%;border-radius:10px;" class="talkDiv">
            <!--   Header start         -->
            <div class="container-fluid" id="header">
                <i class="fa fa-backward fa-2x text-white pt-2 toConservation" style="float:right;" ></i>
                <p id="username" class="chatUsername pt-1">Ko Money</p>
                <small id="time_ago" class="chatUserTimeAgo">Just now</small>
            </div>

            <!--   Header end         -->
            <!--   Body start         -->
            <div class="chatBody" style="color:black;width:100%;height:80%;overflow-y:auto;overflow-x:auto;">
                <div class="loadMore text-center">
                    <img src="loading.gif" id="loadMore" alt="Loading..." data-page="" style="display:none">
                </div>
                <div class="container-fluid messages p-0" id="messages">
                    <ul id="card-block"></ul>
                </div>
            </div>
            <!--   Body end         -->
            <!--   footer start         -->
            <div class="container-fluid bg-white m-0 p-0" id="footer">
                <textarea type="text" placeholder="Write your message..." id="text" ></textarea>
                <button class=" col-1 text-justify m-0 p-0"  style="width:100%;height:100%;border:0;background-color:white;">
                    <input type="file" name="imgSend" style="padding:0;margin:0;position:absolute;height:200px;top:0;overflow:hidden" class="bg-danger col-12 custom-file-input" id="imgSend" multiple>
                    <i class="fa fa-camera fa-1x text-primary" style="text-align:center;padding-left:30%"></i>
                </button>
                <button class="m-0 p-0 send" id="sendbtn" data-table="" data-user="<?php echo $_COOKIE['useridKoMoney']; ?>"><i class="fa fa-paper-plane"></i></button>
            </div>
            <!--   footer end         -->
        </div>
    </div>
    <!-------------------------------------------------------------------   For chat Div end ------------------------------------------------->
    <!------------------------------------------------------------------For chat btn start ---------------------------------------------------------->
    <?php if(isset($_COOKIE['useridKoMoney'])):?>
    <div class="chatBtn" id="chatBtnId" style="position:fixed;bottom:0;right:20px;z-index:101;" data-status="open">
        <!-- <i class="fab fa-facebook-messenger fa-3x text-primary"></i> -->
        <img src="img/fa.png" style="width:50px;height:50px;">
    </div>
    <?php endif; ?>
    <!------------------------------------------------------------------For chat btn end ---------------------------------------------------------->
        <div class="lottery" style="width:100%;height:700px;">
                <div id="loadingForLottery" class="position-fixed col-12 text-center" style="z-index:20;display:block;padding-top:160px;left:0;width:100%;height:100%;"><img src="loading.gif" alt=""><p style="color:red">အခ်က္အလက္မ်ားရယူေနသည္</p></div>
        <div class="lotteryForChange"></div>
    </div>
    <div class="football" style="width:100%;height:700px;">
                <div id="loadingForFootball" class="position-fixed col-12 text-center" style="z-index:20;display:block;padding-top:160px;left:0;width:100%;height:100%;"><img src="loading.gif" alt=""><p style="color:red">အခ်က္အလက္မ်ားရယူေနသည္</p></div>
     <div class="footballForChange"></div>
    </div>
</div>
<!------------------------------------------------------------------For fullscreen Img start ---------------------------------------------------------->
<!--<div id="fullScreenImgDiv" style="position:absolute;width:100%;height:100%;top:0;text-align:center;z-index:1000;display:none;">-->
<!--        <button id="fullScreenImgBack" style="position:absolute;">Back</button>-->
<!--    <br>-->
<!--    <span style="display:inline-block;height:100%;vertical-align: middle;"></span>-->
<!--        <img src="" alt="" id="fullScreenImg" style="display:inline-block;vertical-align:middle;">-->
<!--</div>-->
<!--<div id="fullScreenImgDiv" style="position:relative;text-align:center;width:100%;height:100%;background-color:#CCC">-->
<!--    <img src="" alt="" id="fullScreenImg" style="position:absolute;top:0;margin:auto;left:0;right:0;bottom:0;width:auto;">-->
<!--</div>-->
<!-- <div class="fullScreenImgDiv" style="width:100%;height:100%;overflow:hidden;">
    <div style="border:1px solid black;height:100%;display:flex;align-item:center;">
        <img src="" alt="" id="fullScreenImg" style="height:auto;width:100%;align-self: center">
    </div>
</div> -->
<!------------------------------------------------------------------For fullscreen Img end ---------------------------------------------------------->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!--<script src="bootstrap/script/jquery-3.3.1.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<!--<script src="bootstrap/script/popper.min.js"></script>-->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<!--<script src="bootstrap/script/bootstrap.min.js"></script>-->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!--<script src="bootstrap/script/jquery-ui.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<!--<script src="bootstrap/script/jquery.cookie.js"></script>-->
<script src="Framework/src/jquery.waitforimages.js"></script>
<script>
                function hey(){
                   $("#loadingForFootball").css("display","none");
                   $("#loadingForLottery").css("display","none");
        }
    $(document).ready(function () {
        // getApi();
        /**********************************************For server time update start**************************************/
        var timeTest=parseInt("<?php echo time(); ?>");
        setInterval(function(){
            timeTest++;
        },1000);
        /**********************************************For server time update start**************************************/
        //FOr choose start
         var chooseClass=document.getElementsByClassName('choose');
         chooseClass[0].onclick=function(){
                $('.twod').css('display', 'block');
                $('.threed').css('display', 'none');
                $('.bet').css('display', 'none');
               $('.lottery').css('display', 'none');
                $('.football').css('display', 'none');
         }
         chooseClass[1].onclick=function(){
                $('.threed').css('display', 'block');
                $('.twod').css('display', 'none');
                $('.bet').css('display', 'none');
                $('.lottery').css('display', 'none');
                $('.football').css('display', 'none');
         }
         chooseClass[3].onclick=function(){
                $('.threed').css('display', 'none');
                $('.twod').css('display', 'none');
                $('.bet').css('display', 'none');
                $('.lottery').css('display', 'block');
                $('.football').css('display', 'none');
                if($(".lotteryForChange").html()==""){
                   $("#loadingForLottery").show();
                   $(".lotteryForChange").html('<iframe src="http://myanmarelottery.com/" onload="hey()" width="100%" height="700px" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>');
                };
         }
         chooseClass[2].onclick=function(){
                $('.lottery').css('display', 'none');
                $('.football').css('display', 'block');
                $('.threed').css('display', 'none');
                $('.twod').css('display', 'none');
                $('.bet').css('display', 'none');
                                if($(".footballForChange").html()==""){
                   $("#loadingForFootball").show();
                   $(".footballForChange").html('<iframe src="https://goalscore.com" onload="hey()" width="100%" height="700px" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>');
                };
         }
         $("#specialBet").click(function(){
                if($(this).attr('data-test')=='bet'){
                    if ($(".forChange #howtoplay").attr('id') == undefined) { //This is checking exist or not exits webpage that you want start
                        $('.threed').css('display', 'none');
                        $('.twod').css('display', 'none');
                        $('.bet').css('display', 'block');
                        if (typeof $.cookie('useridKoMoney') != 'undefined' && typeof $.cookie('usernameKoMoney') != 'undefined') {
                            $(".memberBtn").show();
                            $(".notMemberBtn").hide();
                            $(".forMemberSetting").show();
                            $(".forMember").css('display', 'block');
                            if ($("#vac").attr('id') == undefined) {
                                $.get({
                                    url: "vac.php",
                                    type: "GET",
                                    beforeSend: function () {
                                        $("#loadingForBet").css('display', 'block');
                                    },
                                    success: function (data) {
                                        $("#loadingForBet").css('display', 'none');
                                        $("#howtoplay").css('display', 'none');
                                        $("#loginAndRegister").css('display', 'none');
                                        $("#home").css('display', 'none');
                                        $("#dowloadApk").hide();
                                        $(".forMember").show();
                                        $(".forChange").append(data);
                                    }
                                });
                            } else {
                                $("#vac").fadeIn('fast');
                            }

                        } else {
                            $(".forMember").css("display", 'none');
                            $(".memberBtn").hide();
                            $(".notMemberBtn").show();
                            $(".forMemberSetting").hide();
                            $.get({
                                url: "howtoplay.php",
                                type: "GET",
                                beforeSend: function () {
                                    $("#loadingForBet").css('display', 'block');
                                },
                                success: function (data) {
                                    $("#loadingForBet").css('display', 'none');
                                    $(".forChange").append(data);
                                }
                            });
                        }
                        //For Login and Register start
                        $(".loginRegister").click(function () {
                            if($(this).hasClass('loginRegister')==true){
                                if ($("#loginAndRegister").attr('id') == undefined) {
                                    $.get({
                                        url: "loginAndRegister.php",
                                        type: "GET",
                                        beforeSend: function () {
                                            $("#loadingForBet").css('display', 'block');
                                        },
                                        success: function (data) {
                                            $("#loadingForBet").css('display', 'none');
                                            $("#howtoplay").css('display', 'none');
                                            $("#dowloadApk").css('display', 'none');
                                            $("#home").css('display', 'none');
                                            $("#vac").hide();
                                            $("#balance").hide();
                                            $("#rac").hide();
                                            $("#dh").hide();
                                            $("#wh").hide();
                                            $(".forChange").append(data);
                                        }
                                    });
                                } else {
                                    $("#howtoplay").hide();
                                    $("#dowloadApk").hide();
                                    $("#home").hide();
                                    $("#vac").hide();
                                    $("#balance").hide();
                                    $("#rac").hide();
                                    $("#dh").hide();
                                    $("#wh").hide();
                                    $("#loginAndRegister").fadeIn('fast');
                                }
                            } else {
                                $("#howtoplay").hide();
                                $("#dowloadApk").hide();
                                $("#home").hide();
                                $("#vac").hide();
                                $("#balance").hide();
                                $("#rac").hide();
                                $("#dh").hide();
                                $("#wh").hide();
                                $("#loginAndRegister").fadeIn('fast');
                            }
                            $(this).removeClass('loginRegister');

                        });
                        //For Login and Register end
                        //FOr how to play link start
                        $(".howToPlayLink").click(function () {
                            $(this).parent().parent().children('li').removeClass('active');
                            $(this).parent().addClass('active');
                            if($(this).hasClass('howToPlayLink')==true){
                                if ($(".forChange #howtoplay").attr('id') == undefined) {
                                    $.get({
                                        url: "howtoplay.php",
                                        type: "GET",
                                        beforeSend: function () {
                                            $("#loadingForBet").css('display', 'block');
                                        },
                                        success: function (data) {
                                            $("#loadingForBet").css('display', 'none');
                                            $("#loginAndRegister").hide();
                                            $("#dowloadApk").hide();
                                            $("#home").hide();
                                            $("#vac").hide();
                                            $("#balance").hide();
                                            $("#rac").hide();
                                            $("#dh").hide();
                                            $("#wh").hide();
                                            $(".forChange").append(data);
                                        }
                                    });
                                } else {
                                    $("#loginAndRegister").hide();
                                    $("#dowloadApk").hide();
                                    $("#home").hide();
                                    $("#vac").hide();
                                    $("#balance").hide();
                                    $("#rac").hide();
                                    $("#dh").hide();
                                    $("#wh").hide();
                                    $("#howtoplay").fadeIn("slow");
                                }
                            } else {
                                $("#loginAndRegister").hide();
                                $("#dowloadApk").hide();
                                $("#home").hide();
                                $("#vac").hide();
                                $("#balance").hide();
                                $("#rac").hide();
                                $("#dh").hide();
                                $("#wh").hide();
                                $("#howtoplay").fadeIn("slow");
                            }
                            $(this).removeClass('howToPlayLink');
                        });
                        //FOr how to play link start
                        //FOr dowload apk link start
                        $(".dowloadApkLink").click(function () {
                            $(this).parent().parent().children('li').removeClass('active');
                            $(this).parent().addClass('active');
                            if($(this).hasClass("dowloadApkLink")==true){
                                if ($("#dowloadApk").attr('id') == undefined) {
                                    $.get({
                                        url: "dowloadApk.php",
                                        type: "GET",
                                        beforeSend: function () {
                                            $("#loadingForBet").css('display', 'block');
                                        },
                                        success: function (data) {
                                            $("#loadingForBet").css('display', 'none');
                                            $("#howtoplay").css('display', 'none');
                                            $("#loginAndRegister").css('display', 'none');
                                            $("#home").css('display', 'none');
                                            $("#vac").hide();
                                            $("#balance").hide();
                                            $("#rac").hide();
                                            $("#dh").hide();
                                            $("#wh").hide();
                                            $(".forChange").append(data);
                                        }
                                    });
                                } else {
                                    $("#loginAndRegister").hide();
                                    $("#howtoplay").hide();
                                    $("#home").hide();
                                    $("#balance").hide();
                                    $("#vac").hide();
                                    $("#rac").hide();
                                    $("#dh").hide();
                                    $("#wh").hide();
                                    $("#dowloadApk").fadeIn("slow");

                                }
                            }else {
                                $("#loginAndRegister").hide();
                                $("#howtoplay").hide();
                                $("#home").hide();
                                $("#balance").hide();
                                $("#vac").hide();
                                $("#rac").hide();
                                $("#dh").hide();
                                $("#wh").hide();
                                $("#dowloadApk").fadeIn("slow");

                            }
                            $(this).removeClass('dowloadApkLink');
                        });
                        //FOr dowload apk link start
                        //For deposit history start
                        $(".dh").click(function () {
                            $(this).parent().parent().children('li').removeClass('active');
                            $(this).parent().addClass('active');
                            if($(this).hasClass("dh")==true){
                                if ($("#dh").attr('id') == undefined) {
                                    $.get({
                                        url: "dh.php",
                                        type: "GET",
                                        beforeSend: function () {
                                            $("#loadingForBet").css('display', 'block');
                                        },
                                        success: function (data) {
                                            $("#loadingForBet").css('display', 'none');
                                            $("#howtoplay").css('display', 'none');
                                            $("#loginAndRegister").css('display', 'none');
                                            $("#home").css('display', 'none');
                                            $("#vac").hide();
                                $("#dowloadApk").hide();
                                            $("#balance").hide();
                                            $("#rac").hide();
                                            $("#wh").hide();
                                            $(".forChange").append(data);
                                        }
                                    });
                                } else {
                                    $("#loginAndRegister").hide();
                                    $("#howtoplay").hide();
                                    $("#home").hide();
                                $("#dowloadApk").hide();
                                    $("#balance").hide();
                                    $("#vac").hide();
                                    $("#rac").hide();
                                    $("#wh").hide();
                                    $("#dh").fadeIn("slow");

                                }
                            }else {
                                $("#loginAndRegister").hide();
                                $("#howtoplay").hide();
                                $("#home").hide();
                                $("#balance").hide();
                                $("#vac").hide();
                                $("#rac").hide();
                                $("#wh").hide();
                                $("#dowloadApk").hide();
                                $("#dh").fadeIn("slow");

                            }
                            $(this).removeClass('dh');
                        });
                        //For deposit history end
                        //For withdraw history start
                        $(".wh").click(function () {
                            $(this).parent().parent().children('li').removeClass('active');
                            $(this).parent().addClass('active');
                            if($(this).hasClass("wh")==true){
                                if ($("#wh").attr('id') == undefined) {
                                    $.get({
                                        url: "wh.php",
                                        type: "GET",
                                        beforeSend: function () {
                                            $("#loadingForBet").css('display', 'block');
                                        },
                                        success: function (data) {
                                            $("#loadingForBet").css('display', 'none');
                                            $("#howtoplay").css('display', 'none');
                                            $("#loginAndRegister").css('display', 'none');
                                            $("#home").css('display', 'none');
                                            $("#vac").hide();
                                            $("#balance").hide();
                                            $("#rac").hide();
                                            $("#dh").hide();
                                $("#dowloadApk").hide();
                                            $(".forChange").append(data);
                                        }
                                    });
                                } else {
                                    $("#loginAndRegister").hide();
                                    $("#howtoplay").hide();
                                    $("#home").hide();
                                $("#dowloadApk").hide();
                                    $("#balance").hide();
                                    $("#vac").hide();
                                    $("#rac").hide();
                                    $("#dh").hide();
                                    $("#wh").fadeIn("slow");

                                }
                            }else {
                                $("#loginAndRegister").hide();
                                $("#howtoplay").hide();
                                $("#home").hide();
                                $("#balance").hide();
                                $("#vac").hide();
                                $("#rac").hide();
                                $("#dh").hide();
                                $("#dowloadApk").hide();
                                $("#wh").fadeIn("slow");

                            }
                            $(this).removeClass('wh');
                        });
                        //FOr withdraw history end
                        //FOr Home app link start
                        $(".homeLink").click(function () {
                            $(this).parent().parent().children('li').removeClass('active');
                            $(this).parent().addClass('active');
                            if($(this).hasClass('homeLink')==true){
                                if ($("#home").attr('id') == undefined) {
                                    $.get({
                                        url: "home.php",
                                        type: "GET",
                                        beforeSend: function () {
                                            $("#loadingForBet").css('display', 'block');
                                        },
                                        success: function (data) {
                                            $("#loadingForBet").css('display', 'none');
                                            $("#howtoplay").css('display', 'none');
                                            $("#loginAndRegister").css('display', 'none');
                                            $("#dowloadApk").css('display', 'none');
                                            $("#balance").hide();
                                            $("#vac").hide();
                                            $("#rac").hide();
                                            $("#dh").hide();
                                            $("#wh").hide();
                                            $(".forChange").append(data);
                                        }
                                    });
                                } else {
                                    $("#loginAndRegister").hide();
                                    $("#howtoplay").hide();
                                    $("#dowloadApk").hide();
                                    $("#balance").hide();
                                    $("#vac").hide();
                                    $("#rac").hide();
                                    $("#dh").hide();
                                    $("#wh").hide();
                                    $("#home").fadeIn('fast');
                                }
                            } else {
                                $("#loginAndRegister").hide();
                                $("#howtoplay").hide();
                                $("#dowloadApk").hide();
                                $("#balance").hide();
                                $("#vac").hide();
                                $("#rac").hide();
                                $("#dh").hide();
                                $("#wh").hide();
                                $("#home").fadeIn('fast');
                            }
                            $(this).removeClass('homeLink');
                        });
                        //FOr home app link end
                        //For Virtual account start
                        $(".vac").click(function(){
                            $(".vacAndRacChange").text("Virtual Account");
                            $(".vacbalance").show();
                            $(".racbalance").hide();
                            $(".minusFont").hide();
                            if($(this).hasClass('vac')==true){
                                if ($("#vac").attr('id') == undefined) {
                                    $.get({
                                        url: "vac.php",
                                        type: "GET",
                                        beforeSend: function () {
                                            $("#loadingForBet").css('display', 'block');
                                        },
                                        success: function (data) {
                                            $("#loadingForBet").css('display', 'none');
                                            $("#howtoplay").css('display', 'none');
                                            $("#loginAndRegister").css('display', 'none');
                                            $("#home").css('display', 'none');
                                            $("#dowloadApk").hide();
                                            $("#balance").hide();
                                            $("#rac").hide();
                                            $("#dh").hide();
                                            $("#wh").hide();
                                            $(".forMember").show();
                                            $(".forChange").append(data);
                                        }
                                    });
                                } else {
                                    $("#howtoplay").hide();
                                    $("#loginAndRegister").hide();
                                    $("#home").hide();
                                    $("#dowloadApk").hide();
                                    $("#balance").hide();
                                    $("#rac").hide();
                                    $("#dh").hide();
                                    $("#wh").hide();
                                    $("#vac").fadeIn('fast');
                                }
                            }else {
                                $("#howtoplay").hide();
                                $("#loginAndRegister").hide();
                                $("#home").hide();
                                $("#dowloadApk").hide();
                                $("#balance").hide();
                                $("#rac").hide();
                                $("#dh").hide();
                                $("#wh").hide();
                                $("#vac").fadeIn('fast');
                            }
                            $(this).removeClass('vac');
                        });
                        //For Virtual account end
                        //For Real account start
                        $(".rac").click(function(){
                            $(".vacAndRacChange").text("Real Account");
                            $(".vacbalance").hide();
                            $(".racbalance").show();
                            $(".minusFont").show();
                            if($(this).hasClass('rac')==true){
                                if ($("rac").attr('id') == undefined) {
                                    $.get({
                                        url: "rac.php",
                                        type: "GET",
                                        beforeSend: function () {
                                            $("#loadingForBet").css('display', 'block');
                                        },
                                        success: function (data) {
                                            $("#loadingForBet").css('display', 'none');
                                            $("#howtoplay").css('display', 'none');
                                            $("#loginAndRegister").css('display', 'none');
                                            $("#home").css('display', 'none');
                                            $("#dowloadApk").hide();
                                            $("#balance").hide();
                                            $("#vac").hide();
                                            $("#dh").hide();
                                            $("#wh").hide();
                                            $(".forMember").show();
                                            $(".forChange").append(data);
                                        }
                                    });
                                } else {
                                    $("#howtoplay").hide();
                                    $("#loginAndRegister").hide();
                                    $("#home").hide();
                                    $("#dowloadApk").hide();
                                    $("#balance").hide();
                                    $("#vac").hide();
                                    $("#dh").hide();
                                    $("#wh").hide();
                                    $("#rac").fadeIn('fast');
                                }
                            }else {
                                $("#howtoplay").hide();
                                $("#loginAndRegister").hide();
                                $("#home").hide();
                                $("#dowloadApk").hide();
                                $("#balance").hide();
                                $("#vac").hide();
                                $("#dh").hide();
                                $("#wh").hide();
                                $("#rac").fadeIn('fast');
                            }
                            $(this).removeClass('rac');
                        });
                        $(".balanceDiv").click(function(){
                            if($(".vacAndRacChange").text()=="Real Account"){
                                if($(this).hasClass('balanceDiv')==true){
                                    if ($("#balance").attr('id') == undefined) {
                                        $.get({
                                            url: "balance.php",
                                            type: "GET",
                                            beforeSend: function () {
                                                $("#loadingForBet").css('display', 'block');
                                            },
                                            success: function (data) {
                                                $("#loadingForBet").css('display', 'none');
                                                $("#howtoplay").css('display', 'none');
                                                $("#loginAndRegister").css('display', 'none');
                                                $("#home").css('display', 'none');
                                                $("#dowloadApk").hide();
                                                $("#vac").hide();
                                                $("#rac").hide();
                                                $("#dh").hide();
                                                $("#wh").hide();
                                                $(".forMember").show();
                                                $(".forChange").append(data);
                                            }
                                        });
                                    } else {
                                        $("#howtoplay").hide();
                                        $("#loginAndRegister").hide();
                                        $("#home").hide();
                                        $("#dowloadApk").hide();
                                        $("#vac").hide();
                                        $("#dh").hide();
                                        $("#wh").hide();
                                        $("#rac").hide();
                                        $("#balance").fadeIn('fast');
                                    }
                                }else {
                                    $("#howtoplay").hide();
                                    $("#loginAndRegister").hide();
                                    $("#home").hide();
                                    $("#dowloadApk").hide();
                                    $("#vac").hide();
                                    $("#rac").hide();
                                    $("#dh").hide();
                                    $("#wh").hide();
                                    $("#balance").fadeIn('fast');
                                }
                                $(this).removeClass('balanceDiv');
                            }
                        });
                        //For Real account end
                        // For scroll Start
                        window.onscroll=function(){
                            hello();
                        };
                        var forNavbar = document.getElementsByClassName("fornav")[0].offsetTop;
                        function hello() {
                            if (window.pageYOffset >= forNavbar) {
                                $(".fornav").css({
                                    'position': 'fixed',
                                    'top': 0,
                                    'left': 0,
                                    'width': '100%',
                                    'z-index': '100'
                                });
                                $(".fornavForMoney").css({
                                    'position': 'fixed',
                                    'left': 0,
                                    'width': '100%',
                                    'z-index': '10',
                                    'top': "55px"
                                });
                            } else {
                                $(".fornav").css('position', 'relative');
                                $(".fornavForMoney").css({'position': 'relative', 'top': '0px'});
                            }
                        }

                        //For scroll End
                    } else {//This is checking exists or not exists webpage that you want end
                        $('.threed').hide();
                        $('.twod').hide();
                        $(".bet").fadeIn('fast');
                    }
                } else {
                    $('.threed').hide();
                    $('.twod').hide();
                    $(".bet").fadeIn('fast');
                }
                $(this).attr("data-test","preventMultipleRequest");
         });
    //For auto static start//
    <?php if(isset($_GET['status'])): ?>
        $("#specialBet").click();
    <?php endif; ?>
   //For auto static end//



        //FOr choose End
        /************************************************************For save auto save 2d start*****************************************************/
        var now = "<?php echo time(); ?>";
        now = parseInt(now);
        if ("<?php echo date('D', time()) ?>" != "Sun" && "<?php echo date("D", time()) ?>" != "Sat") {
            setInterval(twelveSave, 10000);
            setInterval(fourSave, 10000);
            var last;
            var num = 0;

            function twelveSave() {
                if (now >= "<?php echo $twelveD ?>" && now < "<?php echo $twelvefiveD ?>") {
                    $.get("https://api.thingspeak.com/apps/thinghttp/send_request?api_key=YJWOLP2MIKTTIH63", function (data) {
                        $.get('https://api.thingspeak.com/apps/thinghttp/send_request?api_key=DPOUCEM5DFLDOJUJ', function (data1) {
                            var split = data.split('.')[1];
                            var twod1 = split.slice(1, 2);
                            var split1 = data1.split('.')[0];
                            var twod2 = split1.slice(-1);
                            var type = "internet";
                            var choose = 0;
                            var name = "12:00";
                            var date = "<?php echo date('Y-m-d', time()); ?>";
                            var twod = twod1 + twod2;
                            if (last == twod) {
                                num++;
                            } else {
                                num = 0;
                            }
                            last = twod;
                            if (($('#2d1').html() && $("#2d2").html()) != "") {
                                if (num == 4) {
                                    $.ajax({
                                        url: 'saveDatas.php',
                                        type: "POST",
                                        data: {
                                            twod1: twod1,
                                            twod2: twod2,
                                            date: date,
                                            type: type,
                                            choose: choose,
                                            name: name
                                        },
                                        success: function (data) {
                                            var data = "<strong style='color:yellow;font-size:20px;'>" + twod + "</strong>";
                                            $("#maintwelvehour").html(data);
                                        }
                                    });
                                }
                            }
                        });
                    });
                }
                now += 10;
            }

            function fourSave() {
                if (now >= "<?php echo $fourthreeD ?>" && now < "<?php echo $fourthreefiveD ?>") {
                    $.get("https://api.thingspeak.com/apps/thinghttp/send_request?api_key=YJWOLP2MIKTTIH63", function (data) {
                        $.get('https://api.thingspeak.com/apps/thinghttp/send_request?api_key=DPOUCEM5DFLDOJUJ', function (data1) {
                            var split = data.split('.')[1];
                            var twod1 = split.slice(1, 2);
                            var split1 = data1.split('.')[0];
                            var twod2 = split1.slice(-1);
                            var type = "internet";
                            var choose = 0;
                            var name = "4:30";
                            var date = "<?php echo date('Y-m-d', time()); ?>";
                            var twod = twod1 + twod2;
                            if (last == twod) {
                                num++;
                            } else {
                                num = 0;
                            }
                            last = twod;
                            if ($('#2d1').html() && $("#2d2").html() != "") {
                                if(num==4){
                                   $.ajax({
                                    url: 'saveDatas.php',
                                    type: "POST",
                                    data: {
                                        twod1: twod1,
                                        twod2: twod2,
                                        date: date,
                                        type: type,
                                        choose: choose,
                                        name: name
                                    },
                                    success: function (data) {
                                        var data = "<strong style='color:yellow;font-size:20px;'>" + twod + "</strong>";
                                        $("#mainfourhour").html(data);
                                    }
                                }); 
                                }
      
                            }
                        });
                    });
                }
                now += 10;
            }

        }
        /****************************************************************For save auto save 2d end*****************************************************/
        $('.nav-item').click(function () {
            $('.nav-item').children().removeClass('active');
            $(this).children().addClass('active');
            $(this).addClass('active');
        });
        $("#2d").html("??");
        var one = 0;
        var two = 0;
        var three = 0;

        function getApi() {
            //Ajax start
            $.ajax({
                url: "https://api.thingspeak.com/apps/thinghttp/send_request?api_key=YJWOLP2MIKTTIH63",
                type: 'get',
                success: function (data) {
                    // var set = data.substr(4, 8);
                    var set=data;
                    var split = data.split('.')[1];
                    var slice1 = split.slice(1, 2);
                    if (one == slice1) {
                        $("#2d1").html(slice1);
                        $("#2d1").css('color', 'yellow');
                        $('#set').html("SET   <strong style='color:yellow;'>" + set + "</strong>");
                    } else {
                        $("#2d1").html(slice1);
                        $("#2d1").css("color", "red");
                        $('#set').html("SET   <strong style='color:red;'>" + set + "</strong>");
                    }
                    one = slice1;
                }
            });
            $.ajax({
                url: "https://api.thingspeak.com/apps/thinghttp/send_request?api_key=DPOUCEM5DFLDOJUJ",
                type: 'get',
                success: function (data) {
                    if (data == "<td>-</td>") {
                        $('#2d2').html("!");
                    } else {
                        // var set = data.substr(4, 8);
                        var set=data;
                        var split = data.split('.')[0];
                        var slice2 = split.slice(-1);
                        if (two == slice2) {
                            $("#2d2").html(slice2);
                            $("#2d2").css('color', 'yellow');
                            $('#setvalue').html("SET Val   <strong style='color:yellow;'>" + set + "</strong>");
                        } else {
                            $("#2d2").html(slice2);
                            $("#2d2").css("color", "red");
                            $('#setvalue').html("SET Val   <strong style='color:red;'>" + set + "</strong>");
                        }
                        two = slice2;
                    }
                }
            });
            //3d start
            $.ajax({
                url: " https://api.thingspeak.com/apps/thinghttp/send_request?api_key=A83M60Q83N8NQ086",
                type:"GET",
                dataType:'text',
                success: function (data) {
                    data=data.replace(/<[^>]+>/g,'').replace(/\s/g,"");
                    data = data.slice(3, 6);
                    var lastThreedNum = $(".test").eq(0).html();
                    if (data != lastThreedNum) {
                        var type = "internet";
                        var choose = 1;
                        var name = "3:30";
                        var data1 = data;
                        $.ajax({
                            url: 'saveDatas.php',
                            type: "POST",
                            data: {
                                threed: data,
                                type: type,
                                choose: choose,
                                name: name
                            },
                            success: function (data) {
                                $("#3dDate").html($("#date").html());
                                //No Important(Dangerous)
                                $("#threedLog").prepend('<tr class="m-0 p-0"><td style="width:40%;color:yellow;" class="p-0 m-0 text-center">' + $("#3dDate").text().replace(/\s/g,'') + '</td><td class="text-center m-0 p-0 test" style="font-size:20px;font-family:bold;color:yellow;">' + data1 + '</td></tr>');
                                //No Important(Dangerous)
                            }
                        });
                    }
                    if (three == data) {
                        $("#3d").html(data);
                        $("#3d").css('color', 'yellow');
                    } else {
                        $("#3d").html(data);
                        $("#3d").css("color", "red");
                    }
                    three = data;
                }
            });
            //3d end
            //Ajax end

        }

        setInterval(getApi,5000);
        function jsTime(){
            var date = new Date();
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var seconds = date.getSeconds();
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            if (hours == 0) {
                hours = 12;
            }
            hours = hours < 10 ? '0' + hours : hours;
            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;
            var strTime = hours + ':' + minutes + ':' + seconds + " " + ampm;
            $("#jsTime").html(strTime);
            $("#jsTime1").html(strTime);
        }
        jsTime();
        setInterval(jsTime, 1000);
        //For search Date Function start
        $.datepicker.setDefaults({
            dateFormat: 'yy-mm-dd'
        });
        $("#datepicker").datepicker({
            onSelect: function () {
                var date = $("#datepicker").val();
                var new_date = new Date(date);
                var holiday = new_date.toDateString().substr(0, 3);
                $("#AjaxCallHide").hide();
                $("#loading").show();
                $(".loadingP").text("Loading Datas for " + date);
                //Test start
                $.ajax({
                    url: "getDatas.php",
                    type: "GET",
                    data: {
                        date: date
                    },
                    success: function (data) {
                        $("#loading").hide();
                        $("#AjaxCallHide").fadeIn('fast');
                        $('.date').text(date);
                        var json = JSON.parse(data);
                        if (json.length == 0) {
                            if (date == "<?php echo date('Y-m-d', time()) ?>") {
                                if (holiday == "Sun" || holiday == "Sat") {
                                    if (holiday == "Sun") {
                                        $("#searchResult3d").hide();
                                        $("#maintwelvehour").html('<strong style="color:red;font-size:14px;">Close on Sunday!</strong>');
                                        $("#mainfourhour").html('<strong style="color:red;font-size:14px;">Close on Sunday!</strong>');
                                    } else {
                                        $("#searchResult3d").hide();
                                        $("#maintwelvehour").html('<strong style="color:red;font-size:14px;">Close on Saturady!</strong>');
                                        $("#mainfourhour").html('<strong style="color:red;font-size:14px;">Close on Saturaday!</strong>');
                                    }
                                } else {
                                    $("#searchResult3d").hide();
                                    $("#maintwelvehour").html('<strong style="color:red;font-size:20px;">!!</strong>');
                                    $("#mainfourhour").html('<strong style="color:red;font-size:20px;">!!</strong>');
                                }
                            } else if (holiday == "Sun" || holiday == "Sat") {
                                $("#searchResult3d").hide();
                                $("#error").hide();
                                $("#error1").hide();
                                if (holiday == "Sun") {
                                    $("#maintwelvehour").html('<strong style="color:red;font-size:14px;">Close on sunday!</strong>');
                                    $("#mainfourhour").html('<strong style="color:red;font-size:14px;">Close on sunday!</strong>');
                                } else {
                                    $("#maintwelvehour").html('<strong style="color:red;font-size:14px;">Close on saturaday!</strong>');
                                    $("#mainfourhour").html('<strong style="color:red;font-size:14px;">Close on saturaday!</strong>');
                                }
                            } else {
                                $("#AjaxCallHide").hide();
                                $("#error").show();
                                $("#error1").show();
                                $("#error").html("<strong style='color:red'>Sorry,No datas found for " + date + " </strong>");

                            }
                        } else {
                            $("#searchResult3d").hide();
                            $("#error").hide('fast');
                            $("#error1").hide('fast');
                            var twelve = 0;
                            var fourthree = 0;
                            for (type in json) {
                                if (json[type].type == 1) {
                                    //If your condition is change,You must update data start(Important)
                                    if (json[type].type.length == 1) {
                                        $("#maintwelvehour").html('<strong style="color:red;font-size:20px;">!!</strong>');
                                        $("#mainfourhour").html('<strong style="color:red;font-size:20px;">!!</strong>');
                                    }
                                    if (holiday == "Sun" || holiday == "Sat") {
                                        if (holiday == "Sun") {
                                            $("#maintwelvehour").html('<strong style="color:red;font-size:14px;">Close on sunday!</strong>');
                                            $("#mainfourhour").html('<strong style="color:red;font-size:14px;">Close on sunday!</strong>');
                                        } else {
                                            $("#maintwelvehour").html('<strong style="color:red;font-size:14px;">Close on saturaday!</strong>');
                                            $("#mainfourhour").html('<strong style="color:red;font-size:14px;">Close on saturaday!</strong>');
                                        }
                                    }
                                    //If your condition is change,You must update data end(important)
                                    $("#searchResult3d").slideDown();
                                    $("#searchResult3dDate").text(date);
                                    $("#searchResult3d2d").text(json[type].twod);

                                } else {
                                    if (json[type].name == "12:00") {
                                        twelve = json[type].twod;
                                    }
                                    if (json[type].name == "4:30") {
                                        fourthree = json[type].twod;
                                    }


                                }
                            }
                            //FOr the uppper item start
                            if (twelve != 0) {
                                $("#maintwelvehour").html('<strong style="color:yellow;font-size:20px;">' + twelve + '</strong>');
                            } else {
                                $("#maintwelvehour").html('<strong style="color:red;font-size:20px;">!!</strong>');
                            }
                            if (fourthree != 0) {
                                $("#mainfourhour").html('<strong style="color:yellow;font-size:20px;">' + fourthree + '</strong>');
                            } else {
                                $("#mainfourhour").html('<strong style="color:red;font-size:20px;">!!</strong>');
                            }
                            //FOr the uppper item end
                        }
                    }
                });
                //Test end

            }
        });
        $("#datepickerbtn").click(function () {
            $("#datepicker").datepicker("show");
        });
        $(function () {
            $('.return').click(function () {
                var date = "<?php echo date('Y-m-d', time()); ?>";
                $("#error").hide();
                $("#error1").hide();
                $("#loading").show();
                $(".loadingP").text("Loading Datas for " + date);
                $.ajax({
                    url: "getDatas.php",
                    type: "GET",
                    data: {
                        date: date
                    },
                    success: function (data) {
                        $("#loading").hide();
                        $("#searchResult3d").hide();
                        $("#AjaxCallHide").fadeIn('fast');
                        var new_date = new Date(date);
                        var holiday = new_date.toDateString().substr(0, 3);
                        if (holiday == "Sun" || holiday == "Sat") {
                            $("#AjaxCallHide").show();
                            $("#error").hide();
                            $("#error1").hide();
                            if ("<?php echo date('D', time()) == 'Sat' ?>") {
                                $(".holiday").html('<strong style="color:red;font-size:14px;">Close on Sat!</strong>');
                            } else {
                                $(".holiday").html('<strong style="color:red;font-size:14px;">Close on Sun!</strong>');
                            }
                            $('.date').text(date);
                            $("#loading").hide();
                        } else {
                            $('.date').text(date);
                            var json = JSON.parse(data);
                            if (json.length == 0) {
                                $("#maintwelvehour").html('<strong style="color:red;font-size:20px;">!!</strong>');
                                $("#mainfourhour").html('<strong style="color:red;font-size:20px;">!!</strong>');
                            } else {
                                for (k in json) {
                                    if (json[k].name == "12:00") {
                                        $("#maintwelvehour").html('<strong style="color:yellow;font-size:20px;">' + json[k].twod + '</strong>');
                                    } else if (json[k].name = "4:30") {
                                        $("#mainfourhour").html('<strong style="color:yellow;font-size:20px;">' + json[k].twod + '</strong>');
                                    }
                                }
                            }
                        }

                    }
                });
            });
        });
        //FOr search end
        //Main start
        //Main End
        //For slip section start
        $(".slipDiv").click(function(){
            if($(this).data("delete")=="delete"){
                $(".extraDiv").slideUp('fast');
                $(this).data("delete","notDelete");
            }else{
                $(".extraDivLoading").show();
                $(".slips").html("");
                if($(".vacAndRacChange").text()=="Virtual Account"){
                    $.ajax({
                        url:"vacSlips.php",
                        type:"GET",
                        success:function(data){
                            $(".extraDivLoading").hide();
                            $(".slips").html(data);
                        }
                    });
                }else{
                    $.ajax({
                        url:"racSlips.php",
                        type:"GET",
                        success:function(data){
                            $(".extraDivLoading").hide();
                            $(".slips").html(data);
                        }
                    });
                }

                $(".extraDiv").slideDown('fast');
                $(this).addClass("slipDivRemove");
                $(this).data("delete","delete");
            }
        });
        //For slip section end
        $('.forChange').click(function(){
            $(".extraDiv").slideUp('fast');
        });
    });
</script>
<!------------------------------------------------------------------------From ChatSection(ChatHOmePage) start------------------------------------------------------------------>
<script>
    /***************************************************************************************For chat section start**************************************************************/
    /**********for toggle chat btn start********/
    $(".chatBtn").click(function(){
        if($(this).attr('data-status')=="open"){
            $(".chatDivBackground").show();
            $(this).attr({'data-status':'close'})
        }else{
            $(".chatDivBackground").hide();
            $(this).attr({'data-status':'open'});
        }
    });
    /**********for toggle chat btn end********/
    var messages=document.getElementById("messages");
    var contacts=document.getElementById("contacts");
    var search=document.getElementById("search");
    var profile=document.getElementById("profile");
    var messagesdiv=document.getElementById("messagesdiv");
    var contactdiv=document.getElementById("contactsdiv");
    var searchdiv=document.getElementById("searchdiv");
    var profilediv=document.getElementById("profilediv");
    var pp=document.getElementById("pp");
    var h4=document.getElementById("h4");
    var keywords=document.getElementById("keywords");
    var keywordsbtn=document.getElementById("keywordsbtn");
    var ul=document.getElementById("ul");
    var uldiv=document.getElementById("uldiv");
    if($.cookie('useridKoMoney')!=undefined){
        var sessionUserId=$.cookie('useridKoMoney');
    }else{
        var sessionUserId="";
    }
    var friends=document.getElementById("friends");
    var ra=document.getElementById("ra");
    var friendsdiv=document.getElementById("friendsdiv");
    var radiv=document.getElementById("radiv");
    var fladd=document.getElementById("fladd");
    var fradd=document.getElementById("fradd");
    var afadd=document.getElementById("afadd");
    var acceptCount=document.getElementById("acceptCount");
    var friendCount=document.getElementById("friendCount");
    var conservation_date=document.getElementById("conservation_date");
    var conservationCount=document.getElementById("conservationCount");
    var activeFriend=document.getElementById("activeFriend");
    var act=document.getElementById("act");
    //For Each Button Start
    messages.onclick=function(){
        messages.parentElement.classList.add("bg-primary");
        messages.style.color="white";
        contacts.style.color="black";
        profile.style.color="black";
        search.style.color="black";
        contacts.parentElement.classList.remove("bg-primary");
        profile.parentElement.classList.remove("bg-primary");
        search.parentElement.classList.remove('bg-primary');
        messagesdiv.style.display="block";
        contactdiv.style.display="none";
        profilediv.style.display="none";
        searchdiv.style.display="none";

    };
    contacts.onclick=function(){
        contacts.parentElement.classList.add("bg-primary");
        messages.style.color="black";
        contacts.style.color="white";
        profile.style.color="black";
        search.style.color="black";
        messages.parentElement.classList.remove("bg-primary");
        profile.parentElement.classList.remove("bg-primary");
        search.parentElement.classList.remove("bg-primary");
        messagesdiv.style.display="none";
        contactdiv.style.display="block";
        profilediv.style.display="none";
        searchdiv.style.display="none";
    };
    $("#search").click(function(){
        search.parentElement.classList.add("bg-primary");
        messages.style.color="black";
        search.style.color="white";
        profile.style.color="black";
        contacts.style.color="black";
        messages.parentElement.classList.remove("bg-primary");
        profile.parentElement.classList.remove("bg-primary");
        contacts.parentElement.classList.remove("bg-primary");
        messagesdiv.style.display="none";
        searchdiv.style.display="block";
        profilediv.style.display="none";
        contactdiv.style.display="none";
    });
    profile.onclick=function(){
        profile.parentElement.classList.add("bg-primary");
        messages.style.color="black";
        contacts.style.color="black";
        search.style.color="black";
        profile.style.color="white";
        contacts.parentElement.classList.remove("bg-primary");
        messages.parentElement.classList.remove("bg-primary");
        search.parentElement.classList.remove("bg-primary");
        messagesdiv.style.display="none";
        contactdiv.style.display="none";
        searchdiv.style.display="none";
        profilediv.style.display="block";
    };
    friends.onclick=function(){
        friends.style.backgroundColor="#5876ff";
        ra.style.backgroundColor="rgba(0,0,0,0.1)";
        friends.style.color="white";
        ra.style.color="black";
        friendsdiv.style.display="block";
        radiv.style.display="none";
    };
    ra.onclick=function(){
        ra.style.backgroundColor="#5876ff";
        friends.style.backgroundColor="rgba(0,0,0,0.1)";
        ra.style.color="white";
        friends.style.color="black";
        radiv.style.display="block";
        friendsdiv.style.display="none";
    };
    //For Each Button End
    //For Window resize Action Start
    // window.addEventListener("resize",resize);
    // function resize(){
    //     var width=window.innerWidth;
    //     if(width>=990){
    //         pp.style.bottom="100px";
    //         h4.style.fontSize="30px";
    //     }else{
    //         pp.style.bottom="55px";
    //         h4.style.fontSize="20px";
    //     }
    // }
    // resize();
    //For Window resize Action End
    //For search Fetures Start
    $("#searchdiv").scroll(function(){
        var currentY=$("#searchdiv").prop('scrollTop')+$("#searchdiv").prop('clientHeight');
        var scrollHeight=$("#searchdiv").prop("scrollHeight");
        var currentYMinus=currentY+1;
        if(currentY==scrollHeight || currentYMinus==scrollHeight){
            keywordsf();
        }
    });
    var searchCharacterCount=0;
    keywords.addEventListener("input",function(){$("#ploading").attr('data-page', '0');keywordsf();searchCharacterCount=keywords.value.length;});
    var rip=false;
    function keywordsf() {
        var value = keywords.value;
        if (value.length >= 2) {
            $(".searchResultCharacterDiv").show();
            $(".searchResultCharacterSpan").html(keywords.value);
            if(rip){return;}
            rip=true;
            if(searchCharacterCount!=keywords.value.length){
                $("#ul").html("");
            }
            $("#search").click();
            ul.style.display = "block";
            $("#ploading").show();
            // document.getElementById("ploading").style.display="block";
            var request = new XMLHttpRequest();
            request.open("GET", "zenChat/search/search.php?keywords=" + value + "&own=" + sessionUserId+" &dataPage="+parseInt($("#ploading").attr('data-page')), true);
            request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    $("#ploading").hide();
                    // document.getElementById("ploading").style.display="none";
                    var result = request.responseText;
                    var json = JSON.parse(result);
                    var string = "";
                    if(json[0].blank=="noSearchResult") {
                        ul.innerHTML="<h1>NO search result!</h1>";
                    }else if(json[0].blank=="loadMoreEnd"){
                    }else{
                        for (k in json) {
                            //For Friend Request start
                            var btn;
                            if (json[k].status == -1) {
                                btn = '<button class="btn-primary af" style="float:right;border:0;border-radius:5px;margin-left:4px;margin-top:10px;" data-uid2="' + json[k].uid + '">Add Friend</button>';
                            } else if (json[k].status == 0) {
                                btn = '<button class="btn-warning cr" style="float:right;border:0;border-radius:5px;margin-left:4px;margin-top:10px;" data-uid2="' + json[k].uid + '">Cancel Request</button>';
                            } else if (json[k].status == 1) {
                                btn = '<button class="btn-danger unf" style="float:right;border:0;border-radius:5px;margin-left:4px;margin-top:10px;" data-uid2="' + json[k].uid + '">Unfriend</button>';
                            }//For friend accepter start
                            else if (json[k].status == "accepter") {
                                btn = '<button class="bg-danger text-white sdel" data-uid2="' + json[k].uid + '" style="float:right;border:0;border-radius:5px;margin-left:4px;margin-top:10px;">Delete</button><button class="bg-primary text-white sacc" data-uid2="' + json[k].uid + '" style="float:right;border:0;border-radius:5px;margin-top:10px;">Accept</button>';
                            }//For friend accepter end
                            //For Friend Request End
                            string += '<li><img src="user/pp/' + json[k].pp + '" alt="profile" style="width:50px;height:50px;border-radius:50%;display:inline;"><a href="search/searchPerson.php" style="display:inline;color:black;text-decoration:none;">' + json[k].username + '</a>' + btn + '<button class="btn-primary af" style="float:right;display:none;border:0;border-radius:5px;margin-left:4px;margin-top:10px;" data-uid2="' + json[k].uid + '">Add Friend</button><button  class="btn-warning cr" style="float:right;display:none;border:0;border-radius:5px;margin-left:4px;margin-top:10px;" data-uid2="' + json[k].uid + '">Cancel Request</button><button class="btn-danger unf" style="float:right;display:none;border:0;border-radius:5px;margin-left:4px;margin-top:10px;" data-uid2="' + json[k].uid + '">Unfriend</button><button class="bg-danger text-white sdel" data-uid2="' + json[k].uid + '" style="float:right;border:0;border-radius:5px;margin-left:4px;margin-top:10px;display:none;">Delete</button><button class="bg-primary text-white sacc" data-uid2="' + json[k].uidid + '" style="float:right;border:0;border-radius:5px;margin-top:10px;display:none;">Accept</button></li>';
                        }
                        if($("#ploading").attr('data-page') == "0"){
                            ul.innerHTML = string;
                        }else{
                            ul.innerHTML += string;
                        }
                        //For Friend System feature Start
                        var af = document.getElementsByClassName("af");
                        var cr = document.getElementsByClassName("cr");
                        var unf = document.getElementsByClassName("unf");
                        var sacc = document.getElementsByClassName("sacc");
                        var sdel = document.getElementsByClassName("sdel");
                        // For Friend Request Feature Start
                        for (var i = 0; i < af.length; i++) {
                            af[i].addEventListener("click", function () {
                                this.style.display = "none";
                                this.parentElement.children[4].style.display = "block";
                                var thi = this;
                                var request = new XMLHttpRequest();
                                request.open("POST", "zenChat/request.php", true);
                                request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
                                request.send("uid1a=" + sessionUserId + "&uid2a=" + this.getAttribute("data-uid2"));
                            })
                        }
                        // For Friend Request Feature End

                        //For Friend Request Cancel Feature Start
                        for (var i = 0; i < cr.length; i++) {
                            cr[i].addEventListener("click", function () {
                                this.style.display = "none";
                                this.parentElement.children[3].style.display = "block";
                                var request = new XMLHttpRequest();
                                request.open("POST", "zenChat/request.php", true);
                                request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
                                request.send("uid1c=" + sessionUserId + "&uid2c=" + this.getAttribute("data-uid2"));
                            })
                        }
                        //For Friend Request Cancel Feature End

                        //For Unfriend Feature Start
                        for (var i = 0; i < unf.length; i++) {
                            unf[i].addEventListener("click", function () {
                                this.style.display = "none";
                                this.parentElement.children[3].style.display = "block";
                                var request = new XMLHttpRequest();
                                request.open("POST", "zenChat/request.php", true);
                                request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
                                request.send("uid1c=" + sessionUserId + "&uid2c=" + this.getAttribute("data-uid2"));
                            });
                        }
                        //For Unfriend Feature End
                        //For Searchbar accept button Start
                        for (var i = 0; i < sacc.length; i++) {
                            sacc[i].addEventListener("click", function () {
                                this.style.display = "none";
                                this.previousElementSibling.style.display = "none";
                                this.parentElement.children[6].style.display = "block";
                                var request = new XMLHttpRequest();
                                request.open("POST", "zenChat/request.php", true);
                                request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
                                request.send("uid1acc=" + sessionUserId + "&uid2acc=" + this.getAttribute("data-uid2"));
                            });
                        }
                        //For Searchbar accept button End
                        //For Searchbar Delete button Start
                        for (var i = 0; i < sdel.length; i++) {
                            sdel[i].addEventListener("click", function () {
                                this.style.display = "none";
                                this.nextElementSibling.style.display = "none";
                                this.parentElement.children[4].style.display = "block";
                                var request = new XMLHttpRequest();
                                request.open("POST", "zenChat/request.php", true);
                                request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
                                request.send("uid1del=" + sessionUserId + "&uid2del=" + this.getAttribute("data-uid2"));
                            });
                        }
                        //For Searchbar Delete button End
                        //For Friend System Feature End
                        $("#ploading").attr('data-page', (json[k].dataPage));
                        // $("#ploading").hide();
                    }
                    rip=false;
                }
                ;
            };
            request.send();
        } else {
            ul.style.display = "none";
            $(".searchResultCharacterDiv").hide();
        }
    }
    //For search Features End
    //Test start

    //Test end
    /**AutoLoad Function start*/
    function autoLoad(){
        var request=new XMLHttpRequest();
        request.open("GET","zenChat/autoload.php?uid2="+sessionUserId,true);
        request.setRequestHeader("X-Requested-With","XMLHttpRequest");
        request.onreadystatechange=function(){
            if(request.readyState==4 && request.status==200){
                var result=request.responseText;
                var json=JSON.parse(result);
                if(json.friends.length!=0){
                    friendCount.innerHTML=json.friends.length;
                }else{
                    friendCount.innerHTML=0;
                }
                if(json.accept.length!=0){
                    acceptCount.innerHTML=json.accept.length;
                }else{
                    acceptCount.innerHTML=0;
                }
                if(json.activeFriend.length!=0){
                    act.innerHTML="("+json.activeFriend.length+")";
                }else{
                    act.innerHTML="("+0+")";
                    document.getElementById('activeFriend').innerHTML="<li><div><small class='text-muted'>There is no active friend Sir.</small></div></li>";
                }
                var string="";
                var string1="";
                var string2="";
                for(k in json.friends){
                    string+='<li class="position-relative pr-0 pl-0 container-fluid"><div class="pl-0 pr-0 pb-3 activeCheck1 toTalkDiv" data-id="'+json.friends[k].id+'"><img src="user/pp/'+json.friends[k].pp+'" alt="user" style="width:50px;height:50px;border-radius:50%;"> <span style="display:inline">'+json.friends[k].username+'</span> </div> <button class="bg-danger text-white unfri" data-id="'+json.friends[k].id1+'" style="position:absolute;top:14%;right:0;display: inline;float:right;border:0;border-radius:5px;margin-left:4px;margin-top:10px;">Unfriend</button> </li>';
                }
                for(k in json.activeFriend){
                    string2+='<li class="activeCheck1 toTalkDiv" data-id="'+json.activeFriend[k].id+'"><div style="padding-bottom:14px;"><img src="user/pp/'+json.activeFriend[k].pp+'" alt="user" style="width:50px;height:50px;border-radius:50%;"> <span style="display:inline">'+json.activeFriend[k].username+'</span><i class="fa fa-circle" style="color:#00c500;position:relative;right:0;float:right;"></i></div></li>';
                }
                for(k in json.accept){
                    string1+='<div class="mb-3">\n' +
                        '<img src="user/pp/'+json.accept[k].pp+'" alt="user" style="width:50px;height:50px;border-radius:50%;">\n' +
                        '<span style="display:inline">'+json.accept[k].username+'</span>\n' +
                        '<button class="bg-danger text-white del" data-id="'+json.accept[k].id1+'" style="display: inline;float:right;border:0;border-radius:5px;margin-left:10px;margin-top:10px;"><i class="fa fa-times" style="font-size:20px;"></i></button>\n' +
                        '<button class="bg-primary text-white acc" data-id="'+json.accept[k].id1+'"  style="display:inline;float:right;border:0;border-radius:5px;margin-top:10px;"><i class="fa fa-check" style="font-size:20px;"></i></button>\n' +
                        '</div>';
                }
                fradd.innerHTML=string1;
                // fladd.innerHTML=string;
                if(json.activeFriend.length!=0){
                    document.getElementById("activeFriend").innerHTML=string2;
                }else{
                    document.getElementById('activeFriend').innerHTML="<li><div><small class='text-muted'>There is no active friend Sir.</small></div></li>";
                }
                if(json.friends.length!=0){
                    fladd.innerHTML=string;
                }else{
                    fladd.innerHTML="<li><div><small class='text-muted'>Search your friends on the searchbar <br> You can search your friends on the searchbar by typing their name Or Id </small></div></li>";
                }
                if(json.accept.length!=0){
                    fradd.innerHTML=string1;
                }else{
                    fradd.innerHTML="<li><div><small class='text-muted'>There is no friend request sir!</small></div></li>";
                }
                $(".activeCheck1").click(function(){
                    $(this).css('backgroundColor',"#e0ebff");
                });
                //Test
                //For friend accept Delete Button Start
                var del=document.getElementsByClassName("del");
                for(var i=0;i<del.length;i++){
                    del[i].addEventListener("click",function(){
                        var thi=this;
                        this.parentElement.remove();
                        var request=new XMLHttpRequest();
                        request.open("POST","zenChat/request.php",true);
                        request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                        request.setRequestHeader("X-Requested-With","XMLHttpRequest");
                        request.send("del="+this.getAttribute("data-id"));
                        //For display Friend Count Start
                        var request1=new XMLHttpRequest();
                        request1.open("GET","zenChat/autoload.php?uidx="+sessionUserId,true);
                        request1.setRequestHeader("X-Requested-With","XMLHttpRequest");
                        request1.onreadystatechange=function(){
                            if(request1.readyState==4 && request1.status==200){
                                var result=request1.responseText;
                                var json=JSON.parse(result);
                                acceptCount.innerHTML=json.acceptCount;
                            }
                        };
                        request1.send();
                        //For display Friend Count End
                    });
                }
                //For friend accept Delete Button End
                //For friend accept Button Start
                var accept=document.getElementsByClassName("acc");
                for(var i=0;i<accept.length;i++){
                    accept[i].addEventListener("click",function(){
                        var thi=this;
                        this.parentElement.remove();
                        var request=new XMLHttpRequest();
                        request.open("POST","zenChat/request.php",true);
                        request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                        request.setRequestHeader("X-Requested-With","XMLHttpRequest");
                        request.send("acc="+this.getAttribute("data-id"));
                        //For display Friend Count Start
                        var request1=new XMLHttpRequest();
                        request1.open("GET","zenChat/autoload.php?uidx="+sessionUserId,true);
                        request1.setRequestHeader("X-Requested-With","XMLHttpRequest");
                        request1.onreadystatechange=function(){
                            if(request1.readyState==4 && request1.status==200){
                                var result=request1.responseText;
                                var json=JSON.parse(result);
                                acceptCount.innerHTML=json.acceptCount;
                            }
                        };
                        request1.send();
                        //For display Friend Count End
                    });
                }
                //For friend accept Button End
                //For Unfriend Button Start
                var unfri=document.getElementsByClassName("unfri");
                for(var i=0;i<unfri.length;i++){
                    unfri[i].addEventListener("click",function(){
                        var thi=this;
                        this.parentElement.remove();
                        var request=new XMLHttpRequest();
                        request.open("POST","zenChat/request.php",true);
                        request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                        request.setRequestHeader("X-Requested-With","XMLHttpRequest");
                        request.send("unfri="+this.getAttribute("data-id"));
                        // //For display Friend Count Start
                        var request1=new XMLHttpRequest();
                        request1.open("GET","zenChat/autoload.php?uid="+sessionUserId,true);
                        request1.setRequestHeader("X-Requested-With","XMLHttpRequest");
                        request1.onreadystatechange=function(){
                            if(request1.readyState==4 && request1.status==200){
                                var result=request1.responseText;
                                var json=JSON.parse(result);
                                friendCount.innerHTML=json.friendCount;
                            }
                        };
                        request1.send();
                        // //For display Friend Count End
                    });
                }
                //For Unfriend Button End
                //For main chat button start
                var send=document.getElementsByClassName("toTalkDiv");
                for(var i=0;i<send.length;i++){
                    send[i].addEventListener("click",function(){
                        var thi=this;
                        var request=new XMLHttpRequest();
                        request.open("POST","zenChat/conservation&tablemarker.php",true);
                        request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                        request.setRequestHeader("X-Requested-With","XMLHttpRequest");
                        request.onreadystatechange=function(){
                            if(request.readyState==4 && request.status==200){
                                var result=request.responseText;
                                if(result=="table and conservation created"){
                                    chatDivToTalkDiv(thi);
                                }
                            }
                        };
                        request.send("one="+sessionUserId+"&two="+this.getAttribute("data-id"));

                    });
                }
                //For main chat button End
            }
        };
        request.send();
    }
    setInterval(autoLoad,3000);
    /**for contact function start*/
        //For friend accept Button Start
    var acc=document.getElementsByClassName("acc");
    for(var i=0;i<acc.length;i++){
        acc[i].addEventListener("click",function(){
            this.parentElement.remove();
            var request=new XMLHttpRequest();
            request.open("POST","zenChat/request.php",true);
            request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            request.setRequestHeader("X-Requested-With","XMLHttpRequest");
            request.send("acc="+this.getAttribute("data-id"));
            //For display Friend Count Start
            var request1=new XMLHttpRequest();
            request1.open("GET","zenChat/autoload.php?uidx="+sessionUserId,true);
            request1.setRequestHeader("X-Requested-With","XMLHttpRequest");
            request1.onreadystatechange=function(){
                if(request1.readyState==4 && request1.status==200){
                    var result=request1.responseText;
                    var json=JSON.parse(result);
                    acceptCount.innerHTML=json.acceptCount;
                }
            };
            request1.send();
            //For display Friend Count End
        });
    }
    //For friend accept Button End
    //For friend accept Delete Button Start
    var del=document.getElementsByClassName("del");
    for(var i=0;i<del.length;i++){
        del[i].addEventListener("click",function(){
            var thi=this;
            this.parentElement.remove();
            var request=new XMLHttpRequest();
            request.open("POST","zenChat/request.php",true);
            request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            request.setRequestHeader("X-Requested-With","XMLHttpRequest");
            request.send("del="+this.getAttribute("data-id"));
            //For display Friend Count Start
            var request1=new XMLHttpRequest();
            request1.open("GET","zenChat/autoload.php?uidx="+sessionUserId,true);
            request1.setRequestHeader("X-Requested-With","XMLHttpRequest");
            request1.onreadystatechange=function(){
                if(request1.readyState==4 && request1.status==200){
                    var result=request1.responseText;
                    var json=JSON.parse(result);
                    acceptCount.innerHTML=json.acceptCount;
                }
            };
            request1.send();
            //For display Friend Count End
        });
    }
    //For friend accept Delete Button End
    //For Unfriend Button Start
    var unfri=document.getElementsByClassName("unfri");
    for(var i=0;i<unfri.length;i++){
        unfri[i].addEventListener("click",function(){
            var thi=this;
            this.parentElement.remove();
            var request=new XMLHttpRequest();
            request.open("POST","zenChat/request.php",true);
            request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            request.setRequestHeader("X-Requested-With","XMLHttpRequest");
            request.send("unfri="+this.getAttribute("data-id"));
            //For display Friend Count Start
            var request1=new XMLHttpRequest();
            request1.open("GET","zenChat/autoload.php?uidx="+sessionUserId,true);
            request1.setRequestHeader("X-Requested-With","XMLHttpRequest");
            request1.onreadystatechange=function(){
                if(request1.readyState==4 && request1.status==200){
                    var result=request1.responseText;
                    var json=JSON.parse(result);
                    friendCount.innerHTML=json.acceptCount;
                }
            };
            request1.send();
            //For display Friend Count End
        });
    }
    //For Unfriend Button End
    //For main send button start
    var send=document.getElementsByClassName("toTalkDiv");
    for(var i=0;i<send.length;i++){
        send[i].addEventListener("click",function(){
            var thi=this;
            var request=new XMLHttpRequest();
            request.open("POST","zenChat/conservation&tablemarker.php",true);
            request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            request.setRequestHeader("X-Requested-With","XMLHttpRequest");
            request.onreadystatechange=function(){
                if(request.readyState==4 && request.status==200){
                    var result=request.responseText;
                    if(result=="table and conservation created"){
                        chatDivToTalkDiv(thi);
                    }
                }
            };
            request.send("one="+sessionUserId+"&two="+this.getAttribute("data-id"));
        });
    }
    //For main send button End
    /**for contact section end*/
    /**AutoLoad Function End*/
    /**AutoLoad2 Function Start*/
    var ulf=document.getElementById("ulf");
    function autoLoad2(){
        var request=new XMLHttpRequest();
        request.open("GET","zenChat/conservationAutoload.php?fnum="+sessionUserId,true);
        request.setRequestHeader("X-Requested-With","XMLHttpRequest");
        request.onreadystatechange=function(){
            if(request.readyState==4 && request.status==200){
                var result=request.responseText;
                var json=JSON.parse(result);
                var string="";
                var specialLiConservationGroup="";
                if($(".liConservationGroup").attr('data-table')!=null){
                    specialLiConservationGroup="data-table='2d3dgroup'";
                }
                for(k in json){
                    var test;
                    if(json[k].tnUser==sessionUserId){test="You: "+json[k].tnText}else if(json[k].tnRowCount==0){test="<small>You are now connected on chatBox</small>"}else{test=json[k].tnText};
                    if(json[k].cal==null){
                        string+='<li class=" pl-0 pr-0"  style="border-radius:5px;background:#faf5f5;margin-bottom:3px;border-bottom:1px solid blue;">\n'+
                            '<div class="row m-0">\n'+
                            '<div style="border:0;width:17%;text-align:center;"><img src="2d3d.png" style="width:50px;height:50px;border-radius:50%;'+json[k].nb+'"></div>\n'+
                            '<div style="width:63%;padding-left:3px;" class="liConservationGroup " '+specialLiConservationGroup+'>\n'+
                            '<span>2D/3D Group</span><br>\n'+
                            '<small>'+test+'</small>\n'+
                            '</div>\n'+
                            '<div class="cd" style="width:20%;text-align:center;">\n'+
                            '<small>'+json[k].cdf+'</small>\n'+
                            '</div>\n'+
                            '</div>\n'+
                            '</li>';
                    }else{
                        var unseenRowCount="";
                        if(json[k].unseenRowCount!=0){
                            unseenRowCount='<span class="unseenNumber ml-1 badge badge-pill badge-danger">'+json[k].unseenRowCount+'</span>';
                        }
                        /*****For Deposit and withdraw conservation start**/
                        if(json[k].tn!=<?php echo $formula ?>){
                        string+='<li class=" pl-0 pr-0" style="border-radius:5px;background:#faf5f5;margin-bottom:3px;border-bottom:1px solid blue;">\n'+
                            '<div class="row m-0">\n'+
                            '<div style="border:0;width:17%;text-align:center;"><img src="user/pp/'+json[k].pp+'" style="width:50px;height:50px;border-radius:50%;'+json[k].nb+'"></div>\n'+
                            '<div style="width:63%;padding-left:3px;" class="liConservation" data-id="'+json[k].cal+'">\n'+
                            '<span>'+json[k].username+'</span>'+unseenRowCount+'<br>'+
                            '<small>'+test+'</small>\n'+
                            '</div>\n'+
                            '<div class="cd" style="width:20%;text-align:center;">\n'+
                            '<small>'+json[k].cdf+'</small>\n'+
                            '<a href="#" class="cdbtn" data-uid='+sessionUserId+' data-tn="'+json[k].tn+'" style="text-decoration:none;color:white;display:block;color:red;">X</a>\n'+
                            '</div>\n'+
                            '</div>\n'+
                            '</li>';
                        }else{
                            string+='<li class=" pl-0 pr-0" style="border-radius:5px;background:#faf5f5;margin-bottom:3px;border-bottom:1px solid blue;">\n'+
                            '<div class="row m-0">\n'+
                            '<div style="border:0;width:17%;text-align:center;"><img src="user/pp/'+json[k].pp+'" style="width:50px;height:50px;border-radius:50%;'+json[k].nb+'"></div>\n'+
                            '<div style="width:63%;padding-left:3px;" class="liConservation" data-id="'+json[k].cal+'">\n'+
                            '<span>ေငြသြင္း\\ေငြထုတ္</span>'+unseenRowCount+'<br>'+
                            '<small>'+test+'</small>\n'+
                            '</div>\n'+
                            '<div class="cd" style="width:20%;text-align:center;">\n'+
                            '<small>'+json[k].cdf+'</small>\n'+
                            '</div>\n'+
                            '</div>\n'+
                            '</li>';
                        }
                        /*****For Deposit and withdraw conservation start**/

                    }

                }
                ulf.innerHTML=string;
                if(json.length==0){
                    conservationCount.innerHTML=0;
                }else{
                    conservationCount.innerHTML= json[0].conservationCount ;
                }
                var li=document.getElementsByClassName("liConservation");
                var cd=document.getElementsByClassName("cd");
                var cdbtn=document.getElementsByClassName("cdbtn");
                $(".liConservationGroup").click(function(){
                    var thi=this;
                    liConservationGroup(thi);
                });
                for(var i=0;i<li.length;i++){
                    li[i].addEventListener("click",click);
                }
                for(var i=0;i<cdbtn.length;i++){
                    cdbtn[i].addEventListener("click",cdbtnClick);
                }
                function click(){
                    this.parentElement.parentElement.style.backgroundColor="#6f6fff";
                    this.style.color="white";
                    this.nextElementSibling.style.color="white";
                    var thi=this;
                    chatDivToTalkDiv(thi);
                }
                function cdbtnClick(event){
                    this.parentElement.parentElement.parentElement.remove();
                    event.preventDefault();
                    var request=new XMLHttpRequest();
                    request.open("POST","zenChat/request.php",true);
                    request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                    request.setRequestHeader("X-Requested-With","XMLHttpRequest");
                    request.send("uidc="+this.getAttribute("data-uid")+"&tn="+this.getAttribute("data-tn"));
                    var request1=new XMLHttpRequest();
                    request1.open("GET","zenChat/conservationAutoload.php?fnum1="+sessionUserId,true);
                    request1.setRequestHeader("X-Requested-With","XMLHttpRequest");
                    request1.onreadystatechange=function(){
                        if(request1.readyState==4 && request1.status==200){
                            var json=JSON.parse(request1.responseText);
                            conservationCount.innerHTML=json[0].conservationCount;
                        }
                    };
                    request1.send();
                }
            }
        };
        request.send();
    }
    setInterval(autoLoad2,5000);
    /**For conservation section start*/
    var li=document.getElementsByClassName("liConservation");
    var cd=document.getElementsByClassName("cd");
    var cdbtn=document.getElementsByClassName("cdbtn");
    for(var i=0;i<li.length;i++){
        li[i].addEventListener("click",click);
    }
    for(var i=0;i<cdbtn.length;i++){
        cdbtn[i].addEventListener("click",cdbtnClick);
    }
    function click(){
        var thi=this;
        this.parentElement.parentElement.style.backgroundColor="#6f6fff";
        this.style.color="white";
        this.nextElementSibling.style.color="white";
        chatDivToTalkDiv(thi);

    }
    function cdbtnClick(event){
        this.parentElement.parentElement.parentElement.remove();
        event.preventDefault();
        var request=new XMLHttpRequest();
        request.open("POST","zenChat/request.php",true);
        request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        request.setRequestHeader("X-Requested-With","XMLHttpRequest");
        request.send("uidc="+this.getAttribute("data-uid")+"&tn="+this.getAttribute("data-tn"));
        var request1=new XMLHttpRequest();
        request1.open("GET","zenChat/conservationAutoload.php?fnum1="+sessionUserId,true);
        request1.setRequestHeader("X-Requested-With","XMLHttpRequest");
        request1.onreadystatechange=function(){
            if(request1.readyState==4 && request1.status==200){
                var json=JSON.parse(request1.responseText);
                conservationCount.innerHTML= json[0].conservationCount ;
            }
        };
        request1.send();
    }
    /**For conservation section end*/
    /**AutoLoad Function ENd*/
    /**From chatDiv to talkDiv changer start***/
    function chatDivToTalkDiv(thi){
        //////////////////////////////////////////////////////////////////////Test start///////////////////////////////////////////////////
        $("#loadMore").show();
        document.getElementById("username").setAttribute('data-uid',thi.getAttribute('data-id'));
        $.ajax({
            url:"zenChat/forUsernameAndTimeago.php",
            type:"GET",
            data:{
                uid:thi.getAttribute('data-id')
            },
            success:function(data){
                var json=JSON.parse(data);
                document.getElementById("sendbtn").setAttribute("data-table",json[0].formula);
                $(".chatUsername").text(json[0].username);
                $(".chatUserTimeAgo").text(json[0].userAgo);
            }
        });
        $.ajax({
            url:"zenChat/adminMessages.php",
            type:"GET",
            data:{
                uid:thi.getAttribute('data-id')
            },
            success:function(data){
                // $("#messages ul").html(data);
                $("#messages ul").html(data).waitForImages(function(){
                    $(".chatBody").scrollTop($(".chatBody").prop('scrollHeight'));
                });
                $(".chatDiv").hide();
                $(".talkDiv").show();
                $(".fullScreenImg").click(function(){
                    var thi=$(this);
                    var src=thi.attr('src');
                    fullScreenImg(src);
                });
                if($(thi).hasClass("toTalkDiv")){
                    $(thi).css({'backgroundColor':'white','color':'black'});
                }else{
                    thi.parentElement.parentElement.style.backgroundColor="#FAF5F5";
                    thi.style.color="black";
                    thi.nextElementSibling.style.color="black";
                }
            }
        });
        var dataUid=thi.getAttribute('data-id');
        var timer=setInterval(function(){
            if($("#messages #card-block").html()!=""){
                $.ajax({
                    url:"zenChat/msgWatcher.php",
                    type:"POST",
                    data:{
                        u2:dataUid
                    }
                });
            }else{
                clearInterval(timer);
            }
        },1000);
        $(this).children(".unseenNumber").remove();
        //////////////////////////////////////////////////////////////////////Test end///////////////////////////////////////////////////
    }
    /**From chatDiv to talkDiv changer end***/
    $(document).ready(function(){
        function upDateActivity(){
            var request=new XMLHttpRequest();
            request.open("POST","loginActivityPost.php",true);
            request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            request.setRequestHeader("X-Requested-With","XMLHttpRequest");
            request.send("uid="+sessionUserId);
        }
        setInterval(upDateActivity,2000);
    });
    /**for profile pictures start*/
    $("#pp1").on("change",function(){
        var img=document.getElementById("pp1").files[0];
        var img_name=img.name;
        var img_size=img.size;
        var extension=img_name.split(".").pop().toLowerCase();
        if($.inArray(extension,["jpeg","jpg","gif","png"])== -1){
            $("#alertbar").html("Invaild Picture<span class=\"float-right\" data-dismiss=\"alert\" style=\"cursor:pointer;font-size:19px;\" id=\"alert1\">X</span>\n");
            document.getElementById("alertbar").style.display="block";
        }else{
            var form_data=new FormData();
            form_data.append("file",img);
            $.ajax({
                url:"zenChat/insertPhoto.php",
                method : "POST",
                data:form_data,
                contentType:false,
                cache:false,
                processData:false,
                success:function(data){
                    document.getElementById("ppimg").src="user/pp/"+data;
                }
            });
        }
    });
    /**For profile pictiures end*/
    /**for cover pictures start*/
    $("#cp1").on("change",function(){
        var img=document.getElementById("cp1").files[0];
        var img_name=img.name;
        var img_size=img.size;
        var extension=img_name.split(".").pop().toLowerCase();
        if($.inArray(extension,["jpeg","jpg","gif","png"])== -1){
            $("#alertbar").html("Invaild Picture<span class=\"float-right\" data-dismiss=\"alert\" style=\"cursor:pointer;font-size:19px;\" id=\"alert1\">X</span>\n");
            document.getElementById("alertbar").style.display="block";
        }
        else{
            var form_data1=new FormData();
            form_data1.append("file1",img);
            $.ajax({
                url:"zenChat/aaa.php",
                method : "POST",
                data:form_data1,
                contentType:false,
                cache:false,
                processData:false,
                beforeSend:function(){
                    document.getElementById("cp1").nextElementSibling.innerHTML="<p style=\"font-size:12px;position:relative;top:-20px;left:39px\">Uploading!Please wait</p>";
                },
                success:function(data){
                    document.getElementById("cp1").nextElementSibling.innerHTML="<p style=\"font-size:12px;position:relative;top:-20px;left:39px\">Update Cover Photo</p>";
                    document.getElementById("cpimg").src="user/cp/"+data;
                }
            });
        }
    });
    /**For cover pictiures end*/
    $(".activeCheck1").click(function(){
        $(this).css('backgroundColor',"#e0ebff");
    });
</script>
<!------------------------------------------------------------------------From ChatSection(ChatHomePage) end------------------------------------------------------------------>
<!------------------------------------------------------------------------From ChatPage start------------------------------------------------------------------>
<script>
    /****From Change to chatDiv from TalkDiv start ******/
    $(".toConservation").click(function(){
        $(".chatDiv").show();
        $(".talkDiv ul").html("");
        $(".talkDiv").hide();
        $("#loadMore").hide();
        $("#loadMore").attr("data-page",null);
        $("#loadMore").attr("data-table",null);
        $(".liConservationGroup").attr('data-table',null);
        $(".chatUsername").attr('data-uid',null);
    });
    /****From Change to ChatDiv From TalkDiv end    *****/
    /**********For Checking Scroll Bottom start ***********/
    function scrollIsBottom(){
        var scrollTop=Math.floor($(".chatBody").scrollTop());
        var scrollHeight=$(".chatBody").prop("scrollHeight");
        var clientHeight=Math.floor($(".chatBody").innerHeight());
        var poundLet=scrollTop+clientHeight;
        var poundLet1=poundLet+1;
        if(parseInt(poundLet1)==parseInt(scrollHeight) || parseInt(poundLet)==parseInt(scrollHeight)) {
            return true;
        }else{
            return false;
        }
    }
    /**********For Checking Scroll Bottom end ***********/
    /********************For LoadMore btn start(Old messages) start********************/
    $("#loadMore").click(function(e){
        hiddenValue=$(".chatBody").prop("scrollHeight");
        e.preventDefault();
        var data_page=$(this).attr('data-page');
        var data_table=$(this).attr('data-table');
        var scrollTop=$(".chatBody").scrollTop();
        var height=$("#card-block").height();
        $.ajax({
            cache:false,
            url:"zenChat/adminMessages1.php",
            type:"GET",
            data:{
                data_page:data_page,
                data_table:data_table
            },
            success:function(data){
                $(data).waitForImages(function(){
                    $("#messages ul").prepend(data);
                    var new_height=$("#card-block").height();
                    var newScrollTop=scrollTop+new_height- height;
                    $(".chatBody").scrollTop(newScrollTop);
                    $(".fullScreenImg").click(function(){
                        var thi=$(this);
                        var src=thi.attr('src');
                        fullScreenImg(src);
                    });
                });
            }
        });
    });
    /***************For LoadMore btn start(Old messages) end*********************/
    /*****To get Previous Message start*******/
    function previousElement(){
        var previousElement=$("#card-block .li").last().data('id');
        return previousElement;
    }
    /*****To get Previous Message end*******/
    /*****For Insert Message and photo start******/
    var new_message;
    $('#text').keypress(function(event){
        if(event.which==13){
            if($("#text").val()!=""){
                $("#sendbtn").click();
                event.preventDefault();
            }
        }
    });
    var success=0;
    $('#sendbtn').click(function(){
        if($("#text").val().trim()!=""){
            changeToZero();
            new_message=text.value.replace('</','');
            new_message=new_message.replace('>','');
            new_message=new_message.replace('<','');
            new_message=new_message.replace(';','');
            //Test Start
            var temtem="<?php echo $ppTest; ?>";
            console.log($("#card-block li").length);
            if($("#card-block li").length==0){
                document.getElementById("card-block").innerHTML+="<li class='li send' style='margin-top:10px;' data-id='1'><i data-success="+success+" class='pt-2 checkCircle "+ success +" fa fa-check-circle text-danger pt-1' style='float:right;font-size:10px;'></i><img id='liimg' src='user/pp/"+temtem+"'><p>"+text.value+"</p></li><li style='display:none' class='seen' id='seen1'><small style='float:right;' class='text-muted'>Seen</small><i class='fa fa-check text-success' style='float:right'></i></li>";
            }else{
                document.getElementById("card-block").innerHTML+="<li class='li send' data-id="+parseInt(parseInt(previousElement())+1)+"><i data-success="+success+" class='pt-2 checkCircle "+ success +" fa fa-check-circle text-danger pt-1' style='float:right;font-size:10px;'></i><img id='liimg' src='user/pp/"+temtem+"'><p>"+text.value+"</p></li><li style='display:none' class='seen' id='seen"+parseInt(parseInt(previousElement())+1)+"'><small style='float:right;' class='text-muted'>Seen</small><i class='fa fa-check text-success' style='float:right'></i></li>";
            }
            $(".chatBody").scrollTop($('.chatBody').prop('scrollHeight'));
            //Test End
            var thi=this;
            var request=new XMLHttpRequest();
            request.open("POST","insertChatMessage.php",true);
            request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            request.setRequestHeader("X-Requested-With","XMLHttpRequest");
            request.onreadystatechange=function() {
                if (request.readyState == 4 && request.status == 200) {
                    var result = request.responseText;
                    $("."+success+"").removeClass('text-danger');
                    $("."+success+"").addClass('text-success');
                }
            };
            request.send("user="+thi.getAttribute("data-user")+"&text="+new_message+"&table="+thi.getAttribute("data-table"));
            text.value="";
        }
    });
    var storeImg=[];
    $('#imgSend').on('change',function(event){
        var img=document.getElementById("imgSend").files;
        for(var i=0;i<img.length;i++){
            //For Client IMg send start
            var temtem="<?php echo $ppTest; ?>";
            if(document.getElementById("card-block").children.length==0){
                $("#card-block").append("<li class='li send' data-id=1><i data-success="+success+" class='pt-2 checkCircle "+ success +" fa fa-check-circle text-danger pt-1' style='float:right;font-size:10px;'></i><img id='liimg' src='user/pp/"+temtem+"'><img src='"+URL.createObjectURL(event.target.files[i])+"'  class=' p-0 img-thumbnail' style='width:50%;margin-bottom:5px;'></li><li style='display:none' class='seen' id='seen1'><small style='float:right;' class='text-muted'>Seen</small><i class='fa fa-check text-success' style='float:right'></i></li>");
            }else{
                $("#card-block").append("<li class='li send' data-id="+parseInt(parseInt(previousElement())+1)+"><i data-success="+success+" class='pt-2 checkCircle "+ success +" fa fa-check-circle text-danger pt-1' style='float:right;font-size:10px;'></i><img id='liimg' src='user/pp/"+temtem+"'><img src='"+URL.createObjectURL(event.target.files[i])+"'  class=' p-0 img-thumbnail' style='width:50%;margin-bottom:5px;'></li><li style='display:none' class='seen' id='seen"+parseInt(parseInt(previousElement())+1)+"'><small style='float:right;' class='text-muted'>Seen</small><i class='fa fa-check text-success' style='float:right'></i></li>").waitForImages(function(){
                    $(".chatBody").scrollTop($(".chatBody").prop('scrollHeight'));
                });
            }
            //Test Client Img Send End
            var img_name=img[i].name;
            var img_size=img[i].size;
            var img_extension=img_name.split('.').pop().toLowerCase();
            if($.inArray(img_extension,['jpg','jpeg','gif','png']) == -1 ){
                alert('invaild img!');
            }else{
                storeImg[i]=img_name;
            }
            var heyTest=$(".chatBody").prop('scrollHeight');
            $(".chatBody").scrollTop(heyTest);
        }
        console.log(storeImg);
        for(var j=0;j<storeImg.length;j++){
            var form_data=new FormData();
            form_data.append("imgSend",img[j]);
            form_data.append('table',document.getElementById("sendbtn").getAttribute("data-table"));
            form_data.append('user',document.getElementById("sendbtn").getAttribute("data-user"));
            $.ajax({
                url:"insertChatMessage.php",
                type : "POST",
                data:form_data,
                contentType:false,
                cache:false,
                processData:false,
                beforeSend:function(){
                    //     document.getElementById("pp1").nextElementSibling.innerHTML="<small>Uploading..<small>";
                },
                success:function(data){
                    $("."+success+"").removeClass('text-danger');
                    $("."+success+"").addClass('text-success');
                    // document.getElementById("pp1").nextElementSibling.innerHTML="<small>Update PP<small>";
                    // document.getElementById("ppimg").src="user/pp/"+data;
                    $(".chatBody").scrollTop($('.chatBody').prop('scrollHeight'));
                    var heyTest1=$(".chatBody").prop('scrollHeight');
                }
            });
        }
    });
    /*****For Insert Message and photo start******/
    /**For seen message function start**/
    function seenMessages(){
        if($("#messages #card-block").html()!=""){
            var uid=document.getElementById("username").getAttribute('data-uid');
            $.ajax({
                url:"seenMessages.php",
                type:"GET",
                data:{
                    'uid2':parseInt(uid)
                },
                success:function(data){
                    $(".seen").hide();
                    if(scrollIsBottom()==true){
                        $("#seen"+data+"").show();
                        $(".chatBody").scrollTop($(".chatBody").prop('scrollHeight'));
                    }else{
                        $("#seen"+data+"").show();
                    }
                    /**for hide checkCircle start***/
                    var previousCheckCircle=$("#seen"+data+"").prevAll('.send').children(".checkCircle");
                    previousCheckCircle.next().css({"margin-right":"10px"});
                    previousCheckCircle.css({"display":"none"});
                    /**for hide checkCircle start***/
                }
            });
        }
    }
    setInterval(seenMessages,1000);
    seenMessages();
    /**For seen message function end**/
    $(".chatBody").scroll(function(){
        if($(".chatBody").scrollTop()<=0){
            $("#loadMore").click();
        }
    });
    /********To receive new Message start***************/
    var facebookFunctionPrevent=false;
    function facebook(){
        if($("#card-block").html()!=""){
            if($(".li").length!=0){
                var nextId=parseInt($("#card-block>.li").last().attr('data-id'))+1;
            }else{
                var nextId=1;
            }
            var uid=parseInt($(".chatUsername").attr('data-uid'));
            var data_table=$(".liConservationGroup").attr('data-table');
            if(!isNaN(uid) || data_table!=undefined){
                if(facebookFunctionPrevent){return;}
                facebookFunctionPrevent=true;
                $.ajax({
                    url:"facebook.php",
                    type:"GET",
                    dataType:"json",
                    data:{
                        nextId:nextId,
                        otherUid:uid,
                        data_table:data_table
                    },
                    success:function(data){
                        console.log(data);
                        console.log(data[0].typingNowId);
                        facebookFunctionPrevent=false;
                            if( data[0].typingNowId != undefined ){
                                $(".remove").remove();
                                for(k in data){
                                    $("<li class='replies remove'><img id='liimg' src='user/pp/"+data[k].typingNowPp+"'><div class='sp-ms10'><span class='spinme-left'><div class='spinner'><div class='bounce1'></div><div class='bounce2'></div><div class='bounce3'></div></div></span></div></li>").insertAfter($("#card-block li").last()).waitForImages(function(){
                                    $(".chatBody").scrollTop($(".chatBody").prop('scrollHeight'));
                                });
                                }

                            }else{
                                $(".remove").remove();
                            }

                        if(data[0].id!=undefined){
                            $(".remove").remove();
                            var status=scrollIsBottom();
                            var imgP;
                            var extension=data[0].text.split('.').pop().toLowerCase();
                            if(extension=="jpg" || extension== "jpeg" || extension== "gif" || extension == "png"){
                                imgP='<img src="SendImg/'+data[0].text+'"  class=" p-0 img-thumbnail" alt="" style="width:50%;margin-bottom:5px;">';
                            }else{
                                imgP='<p>'+data[0].text+'</p>';
                            }
                            //For img end
                            //For RepliesUsernmae start//
                            var repliesUsername="";
                            if($(".liConservationGroup").attr('data-table')!=undefined){
                                repliesUsername='<li style="margin:0;padding:0;line-height:15px;"><small style="font-size:10px;margin:0;padding-left:35px;">'+data[0].username+'</small></li>';
                            }
                            //For RepliesUsernmae start//
                            $("#messages ul").append(repliesUsername+"<li class='li replies' data-id='"+data[0].id+"'><img id='liimg' src='user/pp/"+data[0].pp+"'>"+imgP+"</li>").waitForImages(function(){
                                if(data.length!=0 && status==true){
                                    $(".chatBody").scrollTop($(".chatBody").prop('scrollHeight'));
                                }
                            });
                        }

                    }
                });
            }

        }
    }
    setInterval(facebook,2000);
    /*********For receive new message start***************/
    /***********************For typing status start*********/
    /**For insert and update typing status start****/
    lastKeyUp=0;
    var ajaxRequest=false;
    $("#text").keyup(function(event){
        if(event.which != 13){
            if(ajaxRequest){return;}
            ajaxRequest=true;
            lastKeyUp=0;
            $.ajax({
                url:"typingStatus.php",
                type:"POST",
                data:{
                    typing_status:parseInt(1),
                    table:document.getElementById("sendbtn").getAttribute('data-table')
                },
                success:function(data){
                    lastKeyUp=0;
                    ajaxRequest=false;
                }
            });
        }
    });
    setInterval(function(){
        lastKeyUp = ++lastKeyUp % 360 + 1;
        if((lastKeyUp>5 && $("#text").val()!="") || ($("#text").val()=="")){
            if(ajaxRequest){return;}
            ajaxRequest=true;
            $.ajax({
                url:"typingStatus.php",
                type:"POST",
                data:{
                    typing_status:parseInt(0),
                    table:document.getElementById("sendbtn").getAttribute('data-table')
                },
                success:function(data){
                    lastKeyUp=0;
                    ajaxRequest=false;
                }
            });
        }
    },2000);
    function changeToZero(){
        if(ajaxRequest){return;}
        ajaxRequest=true;
        $.ajax({
            url:"typingStatus.php",
            type:"POST",
            data:{
                typing_status:parseInt(0),
                table:document.getElementById("sendbtn").getAttribute('data-table')
            },
            success:function(){
                ajaxRequest=false;

            }
        });
    }
    /**For insert and update typing status start****/
    /****************************For typing status start*******/
</script>
<!------------------------------------------------------------------------From ChatPage end------------------------------------------------------------------>
<!------------------------------------------------------------------------GroupChat start------------------------------------------------------------------>
<script>
    $(".liConservationGroup").click(function(){
        var thi=this;
        liConservationGroup(thi);
    });
    function liConservationGroup(thi){
        $(".liConservationGroup").attr('data-table','2d3dgroup');
        console.log($(".liConservationGroup").attr('data-table'));
        thi.parentElement.parentElement.style.backgroundColor="#6f6fff";
        thi.style.color="white";
        thi.nextElementSibling.style.color="white";
        $("#loadMore").show();
        $.ajax({
            url:"zenChat/group/userAgo.php",
            type:"POST",
            success:function(data){
                $("#sendbtn").attr('data-table',$(thi).attr('data-table'));
                $(".chatUsername").text("2D\\3D Group");
                $(".chatUserTimeAgo").text(data);
            }
        });
        $.ajax({
            url:"zenChat/adminMessages.php",
            type:"GET",
            data:{
                data_table:$(thi).attr('data-table')
            },
            success:function(data){
                // $("#messages ul").html(data);
                $("#messages ul").html(data).waitForImages(function(){
                    $(".chatBody").scrollTop($(".chatBody").prop('scrollHeight'));
                });
                $(".chatDiv").hide();
                $(".talkDiv").show();
                thi.parentElement.parentElement.style.backgroundColor="#FAF5F5";
                thi.style.color="black";
                thi.nextElementSibling.style.color="black";
                $(".fullScreenImg").click(function(){
                    var thi=$(this);
                    var src=thi.attr('src');
                    fullScreenImg(src);
                });
            }
        });
        var timer=setInterval(function(){
            if($("#messages #card-block").html()!=""){
                $.ajax({
                    url:"zenChat/msgWatcher.php",
                    type:"POST",
                    data:{
                        data_table:$(thi).attr("data-table")
                    }
                });
            }else{
                clearInterval(timer);
            }
        },1000);
        $(this).children(".unseenNumber").remove();
    }
</script>
<!------------------------------------------------------------------------GroupChat end------------------------------------------------------------------>
<!--FOr fulll size Image start-->
<script>
    function fullScreenImg(source){
        $("#fullScreenImg").attr('src',source);
        $("#fullScreenImgDiv").show();
        $("#fullScreenImgBack").click(function(){
            $("#fullScreenImgDiv").hide();
        });
    }
</script>
<!--FOr fulll size Image end-->
<!---Script start---->
                <script>
        var request_in_progress=false;
        function proofSetPage1(page){
         $(".proofLoad_more1").data('page',page);
        }
        function proofLoad_more10(){
            if(request_in_progress==true){return;}
            request_in_progress=true;
            $(".proofAjaxLoading").show();
            var page=$(".proofLoad_more1").data('page');
            page=page+1;
            $.ajax({
                url:'proofAjax.php',
                type:'get',
                data:{
                    pageNumber:$(".proofLoad_more1").data('page')
                },
                success:function(data){
                    $(".proofAjaxLoading").hide();
                    request_in_progress=false;
                    proofSetPage1(page);
                    $("#proof tbody").append(data);
                }
            });
        }
        $(".proofLoad_more1").click(function(){
            proofLoad_more10();
        });
        function proofScrollReaction1(){
         var contentHeight=$("#proof").prop("scrollHeight");
         var current_y=$("#proof").scrollTop()+$("#proof").innerHeight();
         if(current_y>=contentHeight){
             proofLoad_more10();
         }
        }
        $("#proof").scroll(function(){
            proofScrollReaction1();
        });
        proofLoad_more10();
    </script>
            <!---Script end------>
</body>
</html>
