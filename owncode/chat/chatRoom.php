<?php
require_once "connection.php";
session_start();
if(isset($_COOKIE['user']) ){
    $one=$_COOKIE['userid'];
    $two=$_GET['uid'];
    $onef1=$one+1;
    $onef2=$onef1*$onef1;
    $twof1=$two+1;
    $twof2=$twof1*$twof1;
    $formula=$onef2+$twof2;
    $check=$db->prepare("SHOW TABLES LIKE '{$formula}'");
    $check->execute();
    if($check->rowCount()==0){
        header("location:homeChat.php");
    }
}else{
    header("location:index.php");
}
date_default_timezone_set("Asia/Rangoon");
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
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/fontawesome-free-5.0.11/fontawesome-free-5.0.11/web-fonts-with-css/css/fontawesome-all.css">
    <style>
/*        For Header Start*/
        body{
            font-family: "proxima-nova",  "Source Sans Pro", sans-serif;
        }
        #header{
            width:100%;
            height:50px;
            background-color:  #7798ff;
            position:fixed;
        }
        #username{
            margin:0;
            color:white;
        }
        #time_ago{
            color:white;
        }
        #home{
            color:white;
            float:right;
            text-align:center;
            margin-top:8px;
        }
        /*FOr Header End*/
        /*For body Start*/
        .messages {
            height: auto;
            min-height: calc(100% - 93px);
            max-height: calc(100% - 93px);
            overflow-x: hidden;
        }
       ul{
           margin:0;
           padding:0;
           margin-left:10px;
           margin-right:10px;
       }
        /*That is main tag*/
        li {
            display:inline-block;
            clear:both;
            float:right;
            width:100%;
            margin:1px;
        }
        /*That is main tag*/
        li img{
            width:30px;
            height:30px;
            border-radius:50%;
        }
        li p{
            padding: 10px 15px;
            border-radius:20px;
            color:white;
            font-size:13px;
            max-width:60%;
            overflow:hidden;
        }
        li.replies img{
            float:left;
        }
        li.replies p{
            background-color: #7796ff;
            color:white;
            float:left;
        }
        li.send img{
            float:right;
        }
        li.send p{
            float:right;
            background: #f5f5f5;
            color:black;
        }
         li:first-child{
            padding-top:34px;
        }
        li:last-child{
            padding-bottom:55px;
        }
        #testing{
            color:red;
        }
/*For body Start*/
/*Foooter start*/
        #footer{
            margin:0;
            padding:0;
            position:fixed;
            bottom:0;
            height:47px;
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
    </style>
</head>
<body>
<div class="container-fluid" id="header">
    <a href="homeChat.php" id="home"><i class="fa fa-home fa-2x"></i></a>
    <p id="username">
        <!--                For showing username start-->
        <?php
        $showUsername=$db->prepare("SELECT * FROM users WHERE id={$two}");
        $showUsername->execute();
        $showUsernameData=$showUsername->fetch();
        echo $showUsernameData['username'];
        ?>
        <!--                For showing username End-->
    </p>
    <small id="time_ago">
        <?php
        $userAgo=$db->prepare("select * from login_details where uid={$two}");
        $userAgo->execute();
        $userAgoData=$userAgo->fetch();
        echo user_time_ago($userAgoData['last_activity']);
        ?>
    </small>
</div>
<!--for blank div!--><div style="width:100%;height:50px;"></div><!--for blank div!-->
<div class="container-fluid messages p-0">
    <ul id="card-block">
        <?php
        $test="";
        $retrievetable=$db->prepare("SELECT * FROM `{$formula}`");
        $retrievetable->execute();
        ?>
        <?php foreach($retrievetable->fetchAll() as $item): ?>
            <?php
            $retrieveUser=$db->prepare("select * from users where id={$item['uid']}");
            $retrieveUser->execute();
            $retrieveUserData=$retrieveUser->fetch();
            $pp=json_decode($retrieveUserData['pp']); ?>
            <p class="text-muted" style="text-align:center;margin:0;font-size:12px;<?php if($test == message_time_ago($item['created_at'])){echo "display:none;";} ?>"><?php echo message_time_ago($item['created_at']); ?></p>
            <li class="<?php if($item['uid']==$_COOKIE['userid']){echo "send";}else{echo "replies";} ?>">
                <img src="user/pp/<?php echo $pp ?>">
                <p><?php echo $item['text'] ?></p>
            </li>
<!--           For hide same data start-->
            <?php
            $test=message_time_ago($item['created_at']);
            ?>
            <!--           For hide same data end-->
        <?php endforeach; ?>
    </ul>
</div>
<!--for blank div!--><div style="width:100%;height:46px;background-color:white;"></div><!--for blank div!-->
<div class="container-fluid bg-white" id="footer">
    <textarea type="text" placeholder="Write your message..." id="text"></textarea>
    <button class="attachment"><i class="fa fa-paperclip"></i></button>
    <button class="send" id="sendbtn" data-table="<?php echo $formula; ?>" data-user="<?php echo $_COOKIE['userid']; ?>"><i class="fa fa-paper-plane"></i></button>
</div>
<script src="../bootstrap/js/jquery-3.3.1.min.js"></script>
<script src="../bootstrap/js/popper.min.js"></script>
<script src="../bootstrap/script/tether.js"></script>
<script src="../bootstrap/script/bootstrap.min.js"></script>
<script>
    /**For Insert Message start*/
    var sendbtn=document.getElementById("sendbtn");
    var text=document.getElementById("text");
    var card_block=document.getElementById("card-block");
    sendbtn.onclick=function(){
        if(text.value!=""){
            var thi=this;
            var request=new XMLHttpRequest();
            request.open("POST","insertChatMessage.php",true);
            request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            request.setRequestHeader("X-Requested-With","XMLHttpRequest");
            request.send("user="+thi.getAttribute("data-user")+"&text="+text.value+"&table="+thi.getAttribute("data-table"));
            text.value="";
            autoLoad();
        }
    };
    /**For Insert Message End*/
    /** For auto load message start*/
    function autoLoad(){
        var request=new XMLHttpRequest();
        request.open("GET","readChatMessage.php?tn="+sendbtn.getAttribute("data-table"),true);
        request.setRequestHeader('X-Requested-With',"XMLHttpRequest");
        request.onreadystatechange=function(){
            if(request.readyState==4 && request.status==200){
                var result=request.responseText;
                var json=JSON.parse(result);
                var string="";
                var test="";
                var noneBlock="";
                for(k in json){
                    var fr="replies";
                    if(json[k].id==sendbtn.getAttribute("data-user")){
                        fr="send";
                    }
                    if(test==json[k].created_at){
                     noneBlock="display:none";
                    }else{
                        noneBlock="display:block";
                    }
                    string+='<p class="text-muted" style="text-align:center;margin:0;font-size:12px;'+noneBlock+'">'+json[k].created_at+'</p>\n'+
                            '<li class="'+fr+'">\n'+
                            '<img src="user/pp/'+json[k].pp+'">\n'+
                            '<p>'+json[k].text+'</p>\n'+
                            '</li>';
                    <!--           For hide same data start-->
                    test=json[k].created_at;
                    <!--           For hide same data end-->
                }
                card_block.innerHTML=string;
            }
        };
        request.send();
    }
    setInterval(autoLoad,1000);
    /** for user time ago autoload start*/
    function autoLoad2(){
        var request=new XMLHttpRequest();
        request.open("GET","user_time_ago.php?two="+<?php echo $two; ?>,true);
        request.setRequestHeader("X-Requested-With","XMLHttpRequest");
        request.onreadystatechange=function(){
            if(request.readyState==4 && request.status==200){
              var result=request.responseText;
              $('#time_ago').html(result);
            }
        };
        request.send();
    }
    setInterval(autoLoad2,3000);
    /** for user time ago autoload end*/
    /** For auto load message End*/
    $(document).ready(function(){
        function upDateActivity(){
            var request=new XMLHttpRequest();
            request.open("POST","loginActivityPost.php",true);
            request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            request.setRequestHeader("X-Requested-With","XMLHttpRequest");
            request.send("uid="+<?php echo $_COOKIE['userid'];?>);
        }
        setInterval(upDateActivity,2000);
    });
</script>
</body>
</html>