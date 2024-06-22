<?php
require_once "../connection.php";
/************Check Admin section start*********/
$email=$_COOKIE['KoMoneyEmail'];
$password=$_COOKIE['KoMoneyPassword'];
$checkAdmin=$db->prepare("select * from users where id=1");
$checkAdmin->execute();
$checkAdminFetch=$checkAdmin->fetch();
$dbEmail=md5($checkAdminFetch['email']);
$dbPassword=md5($checkAdminFetch['password']);
if($email!=$dbEmail && $password!=$dbPassword){
    header("location:../index.php");
}
$UserImg=$db->prepare("SELECT pp FROM users WHERE id=:id");
$UserImg->execute(array(
    "id"=>1
));
$UserImgFetch=$UserImg->fetch();
/************Check Admin section start*********/
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
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel</title>
        <link rel="stylesheet" href="http://mywebfont.appspot.com/css?font=yunghkio"/>
     <link rel="stylesheet" href="http://mywebfont.appspot.com/css?font=myanmar3"/>
     <link rel="stylesheet" href="http://mywebfont.appspot.com/css?font=padauk"/>
     <link rel="stylesheet" href="http://mywebfont.appspot.com/css?font=parabaik"/>
     <link rel="stylesheet" href="http://mywebfont.appspot.com/css?font=zawgyi"/>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="../2d3d.png"/>
<!--     <link rel="stylesheet" type="text/css" href="bootstrap\fontawesome-free-5.0.11\fontawesome-free-5.0.11\web-fonts-with-css\css\fontawesome-all.css"> -->
    <style>
        body{
        background-color:rgb(11,0,24);
        }
            *{
        font-family:"Masterpiece Uni Sans",Zawgyi-One,yunghkio;
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
</head>
<body>
    <form action="addTwod.php" method="POST">
      <input type="name" name="name" id="name" placeholder="name"><br>
<input type="channel" name="channel" id="channel" placeholder="channel"><br>
<input type="twod" name="twod" id="twod" placeholder="twod"><br>
<input type="type" name="type" id="type" placeholder="type"><br>
<input type="name" name="date" id="date" placeholder="date">
<input type="submit" id="submit">  
    </form>

<!----------------------------------------------------------------------For chat section start --------------------------------------------------------------->
<!-------------------------------------------------------------------   For chat Div start ------------------------------------------------->
<div class="chatDivBackground" style="font-family:Cambria;display:none;position:fixed;top:0;left:0;width:100%;height:100%;z-index:100">
    <div style="background-color:#FFFAFA;width:98%;margin:1px auto;height:91%;overflow:hidden;border-radius:10px;;" class="chatDiv">
        <div id="conservationDiv" style="background-color:#FFFAFA">
            <div class="container-fluid p-0" style="margin-top:15px">
                <p style="border-bottom: 2px solid blue;text-align:center;font-size:19px;font-family:bold;">
                    Chat Conservation(<span id="conservationCount"><?php
                        $conservationCount=$db->prepare("select count(*) from conservation where uid=1");
                        $conservationCount->execute();echo $conservationCount->fetchColumn();?></span>)</p>
            </div>
            <div class="card-block">

                <ul class="m-0 p-0" id="ulf">
                    <?php
                    $retrieveConservation=$db->prepare("select * from conservation where uid=1");
                    $retrieveConservation->execute();
                    ?>
                    <?php  foreach ($retrieveConservation->fetchAll() as $item) : ?>
                        <?php
                        /**for formula start*/
                        $know=1;
                        $know1=($know+1)*($know+1);
                        $sum=$item['tn'];
                        $cal=(sqrt($sum-$know1))-1;
                        /**for formula end*/
                        $retrieveConservation1=$db->prepare("select * from `{$item["tn"]}` ORDER BY id DESC limit 1 ");
                        $retrieveConservation1->execute();
                        $retrieveConservation1Data=$retrieveConservation1->fetch();
                        $showConservationName=$db->prepare("select * from users where id={$cal}");
                        $showConservationName->execute();
                        $retriveUnseen=$db->prepare("select * from `{$item['tn']}` where uid!={$know} and view=0");
                        $retriveUnseen->execute();
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
//                        $activeUser1=$db->prepare("select users.id,users.username,users.pp from users inner join login_details on login_details.uid=users.id where login_details.last_activity>DATE_SUB(NOW(),INTERVAL 5 SECOND) AND users.id!={$_COOKIE['userid']}");
                        $checkActive->execute();
                        $checkActiveData=$checkActive->fetch();
                        /**for check active conservation end*/
                        /**for conservation date format End*/
                        //FOr Check Friends Active start
                        $str="";
                        if(user_time_ago($checkActiveData['last_activity'])=="Just now"){
                            $str="display:block";
                        }else {
                            $str="display:none";
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

                        <li class="activeCheck" data-uid="<?php echo $showConservationNameData['id']; ?>"  style="border-radius:5px;background:#faf5f5;margin-bottom:3px;border-bottom:1px solid blue;">
                            <div class="row m-0">
                                <i class="fa fa-circle" style=";color:#00c500;position:absolute;<?php echo $str; ?>"></i>
                                <div style="border:0;width:17%;text-align:center;"><img src="../user/pp/<?php echo $pp ?>" style="width:50px;height:50px;border-radius:50%;"></div>
                                <div style="width:63%;padding-left:3px;" class="conservationLi" data-uid="<?php echo $cal; ?>">
                                    <span><?php echo $showConservationNameData['username']; ?></span><?php if($retriveUnseen->rowCount()!=0){echo '<span class="unseenNumber ml-1 badge badge-pill badge-danger">'.$retriveUnseen->rowCount().'</span>';} ?><br>
                                    <small><?php if($retrieveConservation1Data['uid']==1){echo "You: ".substr($dotPositionCuted,0,25);}else if($retrieveConservation1->rowCount()==0){echo "You are now connected on chatbox.";}else{echo substr($dotPositionCuted,0,25);} ?></small>
                                </div>
                                <div class="cd" style="width:20%;text-align:center;">
                                    <small><?php echo $dd; ?></small>
                                    <a href="#" class="cdbtn" data-uid="1" data-tn="<?php echo $item['tn']; ?>" style="text-decoration:none;color:white;display:none;color:red;">X</a>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div id="chatDiv" style="display:none;background-color:#fffafa;width:100%;margin:1px auto;height:100%;overflow:hidden;border-radius:10px;;">
            <div class="container-fluid" id="header">
                <i class="fa fa-backward fa-2x text-white pt-2 toConservation" style="float:right;" ></i>
                <p id="username" class="chatUsername">Ko Money</p>
                <small id="time_ago" class="chatUserTimeAgo">Just now</small>
            </div>
            <div class="chatBody" style="color:black;width:100%;height:75%;overflow-y:auto;overflow-x:auto;">
                <div class="loadMore text-center">
                    <!--                    <button id="loadMore" data-page="1">LoadMore</button>-->
                    <img src="../loading.gif" id="loadMore" alt="Loading..." data-page="1">
                </div>
                <div class="container-fluid messages p-0" id="messages">
                    <ul id="card-block"></ul>
                </div>
            </div>
            <div class="container-fluid bg-white m-0 p-0" id="footer">
                <textarea type="text" placeholder="Write your message..." id="text" ></textarea>
                <button class=" col-1 text-justify m-0 p-0"  style="width:100%;height:100%;border:0;background-color:white;">
                    <input type="file" name="imgSend" style="padding:0;margin:0;position:absolute;height:200px;top:0;overflow:hidden" class="bg-danger col-12 custom-file-input" id="imgSend" multiple>
                    <i class="fa fa-camera fa-1x text-primary" style="text-align:center;padding-left:30%"></i>
                </button>
                <button class="m-0 p-0 send" id="sendbtn" data-table="" data-user="1"><i class="fa fa-paper-plane"></i></button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------   For chat Div end ------------------------------------------------->
<!------------------------------------------------------------------For chat btn start ---------------------------------------------------------->
<div class="chatBtn" id="chatBtnId" style="position:fixed;bottom:0;right:20px;z-index:101;" data-status="open">
    <i class="fab fa-facebook-messenger fa-3x text-primary"></i>
</div>
<!------------------------------------------------------------------For chat btn end ---------------------------------------------------------->
<!----------------------------------------------------------------------For chat section end --------------------------------------------------------------->
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
<script src="../Framework/src/jquery.waitforimages.js"></script>
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
    /**********For conservation autoload start**************/
    var sessionUserId=1;
    var conservationCount=document.getElementById("conservationCount");
    var ulf=document.getElementById("ulf");
    function autoLoad2(){
        var request=new XMLHttpRequest();
        request.open("GET","conservationAutoload.php?fnum="+sessionUserId,true);
        request.setRequestHeader("X-Requested-With","XMLHttpRequest");
        request.onreadystatechange=function(){
            if(request.readyState==4 && request.status==200){
                var result=request.responseText;
                var json=JSON.parse(result);
                var string="";
                for(k in json){
                    var test;
                    var unseen="";
                    var img_name=json[k].tnText;
                    var img_extension=img_name.split('.').pop().toLowerCase();
                    var tnText;
                    if($.inArray(img_extension,['jpg','jpeg','gif','png']) == -1 ){
                        tnText=json[k].tnText;
                    }else{
                        tnText="Sent a photo";
                    }
                    if(json[k].unseen!=0){unseen='<span class="unseenNumber ml-1 badge badge-pill badge-danger">'+json[k].unseen+'</span>'}
                    if(json[k].tnUser==sessionUserId){test="You: "+tnText}else if(json[k].tnRowCount==0){test="You are now connected on chatBox"}else{test=tnText};
                    string+='<li  style="border-radius:5px;background:#faf5f5;margin-bottom:3px;border-bottom:1px solid blue;">\n'+
                        '<div class="row m-0">\n'+
                        '<i class="fa fa-circle" style=";color:#00c500;position:absolute;'+json[k].nb+'"></i>\n<div style="border:0;width:17%;text-align:center;"><img src="../user/pp/'+json[k].pp+'" style="width:50px;height:50px;border-radius:50%;"></div>\n'+
                        '<div style="width:63%;padding-left:3px;" class="conservationLi" data-uid="'+json[k].cal+'">\n'+
                        '<span>'+json[k].username+'</span>'+unseen+'<br>\n'+
                        '<small>'+test+'</small>\n'+
                        '</div>\n'+
                        '<div class="cd" style="width:20%;text-align:center;">\n'+
                        '<small>'+json[k].cdf+'</small>\n'+
                        '<a href="#" class="cdbtn" data-uid='+sessionUserId+' data-tn="'+json[k].tn+'" style="text-decoration:none;color:white;display:none;color:red;">X</a>\n'+
                        '</div>\n'+
                        '</div>\n'+
                        '</li>';
                }
                ulf.innerHTML=string;
                if(json.length==0){
                    conservationCount.innerHTML=0;
                }else{
                    conservationCount.innerHTML= json[0].conservationCount ;
                }
                var li=document.getElementsByClassName("conservationLi");
                var cd=document.getElementsByClassName("cd");
                var cdbtn=document.getElementsByClassName("cdbtn");
                for(var i=0;i<li.length;i++){
                    li[i].addEventListener("click",click);
                    li[i].addEventListener("mouseenter",mouseenter);
                    li[i].addEventListener("mouseleave",mouseleave);
                }
                for(var i=0;i<cd.length;i++){
                    cd[i].addEventListener("mouseenter",cdMouseEnter);
                    cd[i].addEventListener("mouseleave",cdMouseLeave);
                }
                for(var i=0;i<cdbtn.length;i++){
                    cdbtn[i].addEventListener("click",cdbtnClick);
                }
                function click(){
                    document.getElementById("username").setAttribute('data-uid',this.getAttribute('data-uid'));
                    $("#loadMore").show();
                    $.ajax({
                        url:"forUsernameAndTimeago.php",
                        type:"GET",
                        data:{
                            uid:this.getAttribute('data-uid')
                        },
                        success:function(data){
                            var json=JSON.parse(data);
                            document.getElementById("sendbtn").setAttribute("data-table",json[0].formula);
                            $(".chatUsername").text(json[0].username);
                            $(".chatUserTimeAgo").text(json[0].userAgo);
                        }
                    });
                    $.ajax({
                        url:"adminMessages.php",
                        type:"GET",
                        data:{
                            uid:this.getAttribute('data-uid')
                        },
                        success:function(data){
                            $(".chatDivBackground #conservationDiv").hide();
                            $(".chatDivBackground #chatDiv").show();
                            $("#chatDiv ul").html(data).waitForImages(function(){
                                $(".chatBody").scrollTop($(".chatBody").prop('scrollHeight'));
                            });
                        }
                    });
                    var dataUid=this.getAttribute('data-uid');
                    var timer=setInterval(function(){
                        if($("#chatDiv #card-block").html()!=""){
                            $.ajax({
                                url:"../msgWatcher.php",
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
                }
                function mouseenter(){
                    this.nextElementSibling.children[1].style.display="block";
                }
                function mouseleave(){
                    this.nextElementSibling.children[1].style.display="none";
                }
                function cdMouseEnter(){
                    this.children[1].style.display="block";
                }
                function cdMouseLeave(){
                    this.children[1].style.display="none";
                }
                function cdbtnClick(event){
                    this.parentElement.parentElement.parentElement.remove();
                    event.preventDefault();
                    var request=new XMLHttpRequest();
                    request.open("POST","request.php",true);
                    request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                    request.setRequestHeader("X-Requested-With","XMLHttpRequest");
                    request.send("uidc="+this.getAttribute("data-uid")+"&tn="+this.getAttribute("data-tn"));
                    var request1=new XMLHttpRequest();
                    request1.open("GET","conservationAutoload.php?fnum1="+sessionUserId,true);
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
    var li=document.getElementsByClassName("conservationLi");
    var cd=document.getElementsByClassName("cd");
    var cdbtn=document.getElementsByClassName("cdbtn");
    for(var i=0;i<li.length;i++){
        li[i].addEventListener("click",click);
        li[i].addEventListener("mouseenter",mouseenter);
        li[i].addEventListener("mouseleave",mouseleave);
    }
    for(var i=0;i<cd.length;i++){
        cd[i].addEventListener("mouseenter",cdMouseEnter);
        cd[i].addEventListener("mouseleave",cdMouseLeave);
    }
    for(var i=0;i<cdbtn.length;i++){
        cdbtn[i].addEventListener("click",cdbtnClick);
    }
    function click(){
        $("#loadMore").show();
        document.getElementById("username").setAttribute('data-uid',this.getAttribute('data-uid'));
        $.ajax({
            url:"forUsernameAndTimeago.php",
            type:"GET",
            data:{
                uid:this.getAttribute('data-uid')
            },
            success:function(data){
                var json=JSON.parse(data);
                document.getElementById("sendbtn").setAttribute("data-table",json[0].formula);
                $(".chatUsername").text(json[0].username);
                $(".chatUserTimeAgo").text(json[0].userAgo);
            }
        });
        $.ajax({
            url:"adminMessages.php",
            type:"GET",
            data:{
                uid:this.getAttribute('data-uid')
            },
            success:function(data){
                $("#chatDiv ul").html(data);
                $(".chatDivBackground #conservationDiv").hide();
                $(".chatDivBackground #chatDiv").show();
                $("#chatDiv ul").html(data).waitForImages(function(){
                    $(".chatBody").scrollTop($(".chatBody").prop('scrollHeight'));
                });
            }
        });
        var dataUid=this.getAttribute('data-uid');
        var timer=setInterval(function(){
            if($("#chatDiv #card-block").html()!=""){
                $.ajax({
                    url:"../msgWatcher.php",
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
    }
    function mouseenter(){
        this.nextElementSibling.children[1].style.display="block";
    }
    function mouseleave(){
        this.nextElementSibling.children[1].style.display="none";
    }
    function cdMouseEnter(){
        this.children[1].style.display="block";
    }
    function cdMouseLeave(){
        this.children[1].style.display="none";
    }
    function cdbtnClick(event){
        this.parentElement.parentElement.parentElement.remove();
        event.preventDefault();
        var request=new XMLHttpRequest();
        request.open("POST","request.php",true);
        request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        request.setRequestHeader("X-Requested-With","XMLHttpRequest");
        request.send("uidc="+this.getAttribute("data-uid")+"&tn="+this.getAttribute("data-tn"));
        var request1=new XMLHttpRequest();
        request1.open("GET","conservationAutoload.php?fnum1="+sessionUserId,true);
        request1.setRequestHeader("X-Requested-With","XMLHttpRequest");
        request1.onreadystatechange=function(){
            if(request1.readyState==4 && request1.status==200){
                var json=JSON.parse(request1.responseText);
                conservationCount.innerHTML= json[0].conservationCount ;
            }
        };
        request1.send();
    }
    /**********For conservation autoload end**************/
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
    /**********To conservation start***********************/
    $(".toConservation").click(function(){
        $(".chatDivBackground #conservationDiv").show();
        $(".chatDivBackground #chatDiv ul").html("");
        $(".chatDivBackground #chatDiv").hide();
    });
    /**********To conservation end***********************/
    /**********For update login_details start***/
    function upDateActivity(){
        var request=new XMLHttpRequest();
        request.open("POST","../loginActivityPost.php",true);
        request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        request.setRequestHeader("X-Requested-With","XMLHttpRequest");
        request.send("uid="+1);
    }
    setInterval(upDateActivity,5000);
    /**********For update login_details end***/
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
            url:"adminMessages1.php",
            type:"GET",
            data:{
                data_page:data_page,
                data_table:data_table
            },
            success:function(data){
                $(data).waitForImages(function(){
                    $("#chatDiv ul").prepend(data);
                            var new_height=$("#card-block").height();
                            var newScrollTop=scrollTop+new_height- height;
                            $(".chatBody").scrollTop(newScrollTop);
                });
            }
        });
    });
    /***************For LoadMore btn start(Old messages) end*********************/
    /*****To get Previous Message start*******/
    function previousElement(){
        var previousElement=$(".li").last().data('id');
        return previousElement;
    }
    /*****To get Previous Message end*******/
    /**For Insert Message and photo start*/
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
            new_message=text.value.replace('<','');
            //Test Start
            var temtem=<?php echo $UserImgFetch["pp"]; ?>;
            if(document.getElementById("card-block").children.length==0){
                document.getElementById("card-block").innerHTML+="<li class='li send' data-id='1'><i data-success="+success+" class='pt-2 checkCircle "+ success +" fa fa-check-circle text-danger pt-1' style='float:right;font-size:10px;'></i><img id='liimg' src='../user/pp/"+temtem+"'><p>"+text.value+"</p></li><li style='display:none' class='seen' id='seen1'><small style='float:right;' class='text-muted'>Seen</small><img src='../2d3d.png' alt='' style='float:right;width:20px;height:20px;'></li>";
            }else{
                document.getElementById("card-block").innerHTML+="<li class='li send' data-id="+parseInt(parseInt(previousElement())+1)+"><i data-success="+success+" class='pt-2 checkCircle "+ success +" fa fa-check-circle text-danger pt-1' style='float:right;font-size:10px;'></i><img id='liimg' src='../user/pp/"+temtem+"'><p>"+text.value+"</p></li><li style='display:none' class='seen' id='seen"+parseInt(parseInt(previousElement())+1)+"'><small style='float:right;' class='text-muted'>Seen</small><img src='../2d3d.png' alt='' style='float:right;width:20px;height:20px;'></li>";
            }
            $(".chatBody").scrollTop($('.chatBody').prop('scrollHeight'));
            //Test End
            var thi=this;
            var request=new XMLHttpRequest();
            request.open("POST","../insertChatMessage.php",true);
            request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            request.setRequestHeader("X-Requested-With","XMLHttpRequest");
            request.onreadystatechange=function() {
                if (request.readyState == 4 && request.status == 200) {
                    var result = request.responseText;
                    $("."+success+"").removeClass('text-danger');
                    $("."+success+"").addClass('text-success');
                }
            };
            request.send("user="+thi.getAttribute("data-user")+"&text="+text.value.replace('<','')+"&table="+thi.getAttribute("data-table"));
            text.value="";
        }
    });
    var storeImg=[];
    $('#imgSend').on('change',function(event){
        var img=document.getElementById("imgSend").files;
        for(var i=0;i<img.length;i++){
            //For Client IMg send start
            var temtem=<?php echo $UserImgFetch["pp"]; ?>;
            if(document.getElementById("card-block").children.length==0){
                // document.getElementById("card-block").innerHTML+="<li class='li send' data-id=1><i data-success="+success+" class='pt-2 checkCircle "+ success +" fa fa-check-circle text-danger pt-1' style='float:right;font-size:10px;'></i><img id='liimg' src='../user/pp/"+temtem+"'><img src='"+URL.createObjectURL(event.target.files[i])+"'  class=' p-0 img-thumbnail' style='width:50%;margin-bottom:5px;'></li><li style='display:none' class='seen' id='seen1'><small style='float:right;' class='text-muted'>Seen</small><img src='../2d3d.png' alt='' style='float:right;width:20px;height:20px;'></li>";
                $("#card-block").append("<li class='li send' data-id=1><i data-success="+success+" class='pt-2 checkCircle "+ success +" fa fa-check-circle text-danger pt-1' style='float:right;font-size:10px;'></i><img id='liimg' src='../user/pp/"+temtem+"'><img src='"+URL.createObjectURL(event.target.files[i])+"'  class=' p-0 img-thumbnail' style='width:50%;margin-bottom:5px;'></li><li style='display:none' class='seen' id='seen1'><small style='float:right;' class='text-muted'>Seen</small><img src='../2d3d.png' alt='' style='float:right;width:20px;height:20px;'></li>");
            }else{
                // document.getElementById("card-block").innerHTML+="<li class='li send' data-id="+parseInt(parseInt(previousElement())+1)+"><i data-success="+success+" class='pt-2 checkCircle "+ success +" fa fa-check-circle text-danger pt-1' style='float:right;font-size:10px;'></i><img id='liimg' src='../user/pp/"+temtem+"'><img src='"+URL.createObjectURL(event.target.files[i])+"'  class=' p-0 img-thumbnail' style='width:50%;margin-bottom:5px;'></li><li style='display:none' class='seen' id='seen"+parseInt(parseInt(previousElement())+1)+"'><small style='float:right;' class='text-muted'>Seen</small><img src='../2d3d.png' alt='' style='float:right;width:20px;height:20px;'></li>";
                $("#card-block").append("<li class='li send' data-id="+parseInt(parseInt(previousElement())+1)+"><i data-success="+success+" class='pt-2 checkCircle "+ success +" fa fa-check-circle text-danger pt-1' style='float:right;font-size:10px;'></i><img id='liimg' src='../user/pp/"+temtem+"'><img src='"+URL.createObjectURL(event.target.files[i])+"'  class=' p-0 img-thumbnail' style='width:50%;margin-bottom:5px;'></li><li style='display:none' class='seen' id='seen"+parseInt(parseInt(previousElement())+1)+"'><small style='float:right;' class='text-muted'>Seen</small><img src='../2d3d.png' alt='' style='float:right;width:20px;height:20px;'></li>").waitForImages(function(){
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
        for(var j=0;j<storeImg.length;j++){
            var form_data=new FormData();
            form_data.append("imgSend",img[j]);
            form_data.append('table',document.getElementById("sendbtn").getAttribute("data-table"));
            form_data.append('user',document.getElementById("sendbtn").getAttribute("data-user"));
            $.ajax({
                url:"../insertChatMessage.php",
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
    /**For Insert Message and photo End*/
    /**For seen message function start**/
    function seenMessages(){
        if($("#chatDiv #card-block").html()!=""){
            var uid=document.getElementById("username").getAttribute('data-uid');
            $.ajax({
                url:"../seenMessages.php",
                type:"GET",
                data:{
                    'uid2':parseInt(uid),
                    'uid1':1
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
            if(!isNaN(uid)){
                if(facebookFunctionPrevent){return;}
                facebookFunctionPrevent=true;
                $.ajax({
                    url:"../facebook.php",
                    type:"GET",
                    dataType:"json",
                    data:{
                        nextId:nextId,
                        uid:1,
                        otherUid:uid
                    },
                    success:function(data){
                        facebookFunctionPrevent=false;
                        console.log(data);
                        if(data!=""){
                            if(data[0].typingNowId!=undefined){
                                $(".remove").remove();
                                $("<li class='replies remove'><img id='liimg' src='../user/pp/"+data[0].typingNowPp+"'><div class='sp-ms10'><span class='spinme-left'><div class='spinner'><div class='bounce1'></div><div class='bounce2'></div><div class='bounce3'></div></div></span></div></li>").insertAfter($("#card-block li").last()).waitForImages(function(){
                                    $(".chatBody").scrollTop($(".chatBody").prop('scrollHeight'));
                                });
                            }else{
                                $(".remove").remove();
                            }
                                if(data[0].id!=undefined){
                                var status=scrollIsBottom();
                                var imgP;
                                var extension=data[0].text.split('.').pop().toLowerCase();
                                if(extension=="jpg" || extension== "jpeg" || extension== "gif" || extension == "png"){
                                    imgP='<img src="../SendImg/'+data[0].text+'"  class=" p-0 img-thumbnail" alt="" style="width:50%;margin-bottom:5px;">';
                                }else{
                                    imgP='<p>'+data[0].text+'</p>';
                                }
                                //For img end
                                $("#chatDiv ul").append("<li class='li replies' data-id='"+data[0].id+"'><img id='liimg' src='../user/pp/"+data[0].pp+"'>"+imgP+"</li>").waitForImages(function(){
                                    if(data.length!=0 && status==true){
                                        $(".chatBody").scrollTop($(".chatBody").prop('scrollHeight'));
                                    }
                                });
                            }
                        }else{
                            $(".remove").remove();
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
                url:"../typingStatus.php",
                type:"POST",
                data:{
                    typing_status:parseInt(1),
                    myId:1,
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
            $.ajax({
                url:"../typingStatus.php",
                type:"POST",
                data:{
                    typing_status:parseInt(0),
                    myId:1,
                    table:document.getElementById("sendbtn").getAttribute('data-table')
                },
                success:function(data){
                    lastKeyUp=0;
                }
            });
        }
    },1000);
    function changeToZero(){
        $.ajax({
            url:"../typingStatus.php",
            type:"POST",
            data:{
                typing_status:parseInt(0),
                myId:1,
                table:document.getElementById("sendbtn").getAttribute('data-table')
            }
        });
    }
    /**For insert and update typing status start****/
    /****************************For typing status start*******/
    /*********************************************************************************For chat section end*****************************************************************/
</script>
</body>
</html>