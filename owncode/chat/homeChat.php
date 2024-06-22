<?php
session_start();
if(isset($_COOKIE['user']) ){
}else{
    header("location:index.php");
}
/**for conservation date format start*/
date_default_timezone_set("Asia/Rangoon");
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

/**for conservation date format end*/
/**for check active conservation start*/
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
/**for check active conservation end*/
?>
<!--Lo tar shi yin yu yan a twet db nae connect lote tal-->
<?php
require_once "connection.php";
$resultTest=$db->prepare("SELECT * FROM users WHERE id={$_COOKIE['userid']}");
$resultTest->execute();
$dataTest=$resultTest->fetch();
$cpTest=json_decode($dataTest['cp']);
$ppTest=json_decode($dataTest['pp']);
?>
<!--Lo tar shi yin yu yan a twet db nae connect lote tal-->
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
        ul>li{
            padding:12px;
            list-style-type:none;
            font-family:Cambria;
        }
        li{
            list-style-type:none;
        }
    </style>
</head>
<body>
<div class="container-fluid alert alert-warning alert-dismissible" id="alertbar" role="alert" style="display:none;position:absolute;z-index:34;"></div>
<!--FOr joining php and javascript start--><input type="text" id="sessionuserid" value="<?php if($_COOKIE['userid']){echo $_COOKIE['userid']; }else{echo "other";} ?>" style="display:none;"><!--FOr joining php and javascript ENd-->

<!--For mainnavbar div start --><div class="container-fluid m-0 p-0" style="position:fixed;z-index:10;">
    <div class="card border-bottom-0  " style="border-top-right-radius:0px;border-top-left-radius:0px;border-bottom-left-radius:0px;border-bottom-right-radius:0px; ">
        <div class="card-header">
            <div class="row">
                <div class="col-4 text-center" style="line-height:34px;border-radius:5px;">
                    <li style="list-style-type:none;cursor:pointer;" id="messages">Messages</li>
                </div>
                <div class="col-4 text-center bg-primary text-white" style="line-height:34px;border-radius:5px;">
                    <li style="list-style-type:none;cursor:pointer;" id="contacts">Contacts</li>
                </div>
                <div class="col-4 text-center" style="line-height:34px;border-radius:5px;">
                    <li style="list-style-type:none;cursor:pointer;" id="profile">Profile</li>
                </div>
            </div>
        </div>
    </div>
</div><!--For main navbar div end -->

<!--Hide Navbar area Start--><div style="height:60px;"></div><!--Hide Navbar area End-->

<!--For Main body Tag Start--><div class="card border-0" style="border-radius:0px;">
    <div class="card-block border-0">
        <!--       Message Div Start-->
        <div class="container" id="messagesdiv" style="display:none">
            <div class="container-fluid p-0" style="margin-top:15px">
                <p style="border-bottom: 2px solid blue;font-size:19px;font-family:bold;">
                    Chat Conservation(<span id="conservationCount"><?php
                        $conservationCount=$db->prepare("select count(*) from conservation where uid={$_COOKIE['userid']}");
                        $conservationCount->execute();
                        echo $conservationCount->fetchColumn();?></span>)</p>
            </div>
            <div class="card-block">

                <ul class="m-0 p-0" id="ulf">
                    <?php
                    $retrieveConservation=$db->prepare("select * from conservation where uid={$_COOKIE['userid']}");
                    $retrieveConservation->execute();
                    ?>
                    <?php  foreach ($retrieveConservation->fetchAll() as $item) : ?>
                        <?php
                        /**for formula start*/
                        $know=$_COOKIE['userid'];
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
                        $checkActive->execute();
                        $checkActiveData=$checkActive->fetch();
                        $str="";
                        if(user_time_ago($checkActiveData['last_activity'])=="Just now"){
                            $str="display:block";
                        }else{
                            $str="display:none";
                        }
                        /**for check active conservation end*/
                        /**for conservation date format End*/
                        ?>
                        <li class="activeCheck" data-uid="<?php echo $showConservationNameData['id']; ?>"  style="border-radius:5px;background:#faf5f5;margin-bottom:3px;border-bottom:1px solid blue;">
                            <div class="row m-0">
                                <i class="fa fa-circle" style=";color:#00c500;position:absolute;<?php echo $str; ?>"></i>
                                <div style="border:0;width:17%;text-align:center;"><img src="user/pp/<?php echo $pp ?>" style="width:50px;height:50px;border-radius:50%;"></div>
                                <div style="width:63%;padding-left:3px;" class="li" data-uid="<?php echo $cal; ?>">
                                    <span><?php echo $showConservationNameData['username']; ?></span><br>
                                    <small><?php if($retrieveConservation1Data['uid']==$_COOKIE['userid']){echo "You: ".substr($retrieveConservation1Data['text'],0,25)." ...";}else if($retrieveConservation1->rowCount()==0){echo "You are now connected on chatbox.";}else{echo substr($retrieveConservation1Data['text'],0,25)."....";} ?></small>
                                </div>
                                <div class="cd" style="width:20%;text-align:center;">
                                    <small><?php echo $dd; ?></small>
                                    <a href="#" class="cdbtn" data-uid="<?php echo $_COOKIE['userid'] ?>" data-tn="<?php echo $item['tn']; ?>" style="text-decoration:none;color:white;display:none;color:red;">X</a>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <!--            For Message Conservation Section Start-->
        <div id="contactsdiv" style="display:block">
            <!--             For Sub Navigation Start-->
            <div class="container-fluid" style="height:570px;overflow:auto">
                <div class="card-header p-1 m-0 bg-white border-0" style="border:1px solid blue;background-color: rgba(0,0,0,0.1)">
                    <div class="row">
                        <div class="col-6 text-center" id="friends" style="background-color: #5876ff;color:white;">
                            <li style="cursor:pointer">Friends</li>
                        </div>
                        <div class="col-6 text-center" id="ra" style="background-color:rgba(0,0,0,0.1);">
                            <li style="cursor:pointer">Request and Add</li>
                        </div>
                    </div>
                </div>
                <div class="card-block m-3 m-0 p-0">
                    <div class="container-fluid m-0 p-0" id="friendsdiv" style="display:block">
                        <!--<!--For count active friends start-->
                        <p style="border-bottom:2px solid blue;color:black;font-family:'Arial Black'">Active Friends<span id="act"><?php
                                $activeUser1=$db->prepare("select users.id,users.username,users.pp from users inner join login_details on login_details.uid=users.id where login_details.last_activity>DATE_SUB(NOW(),INTERVAL 5 SECOND) AND users.id!={$_COOKIE['userid']}");
                                $activeUser1->execute();
                                $test=0;
                                foreach($activeUser1->fetchAll() as $item){
                                    $checkFriend1=$db->prepare("select COUNT(*) from friends where ((uid1=:one AND uid2=:two) OR (uid1=:two AND uid2=:one)) AND (friendship_offical='1')");
                                    $checkFriend1->execute(array(
                                        "one"=>$item['id'],
                                        "two"=>$_COOKIE['userid']
                                    ));
                                    $test=$test+$checkFriend1->fetchColumn();
                                }
                                echo "(".$test.")";
                                ?></span></p>
                        <!--For count active friends end-->
                        <!--For preload Active Friends start-->
                        <div id="activeFriend" style="margin:0;padding:0">
                            <?php
                            $activeUser=$db->prepare("select users.id,users.username,users.pp from users inner join login_details on login_details.uid=users.id where login_details.last_activity>DATE_SUB(NOW(),INTERVAL 5 SECOND) AND users.id!={$_COOKIE['userid']}");
                            $activeUser->execute();
                            foreach($activeUser->fetchAll() as $item){
                                $checkFriend=$db->prepare("select * from friends where ((uid1=:one AND uid2=:two) OR (uid1=:two AND uid2=:one)) AND (friendship_offical='1')");
                                $checkFriend->execute(array(
                                    "one"=>$item['id'],
                                    "two"=>$_COOKIE['userid']
                                ));
                                $pp=json_decode($item['pp']);
                                if($checkFriend->rowCount()>0){
                                    echo '<div style="padding-bottom:14px;">
                                      <i class="fa fa-circle" style="color:#00c500;position:relative;left:;"></i>
                                      <img src="user/pp/' .$pp.'" alt="user" style="width:50px;height:50px;border-radius:50%;"> 
                                      <span style="display:inline">'.$item["username"].'</span>
                                      <button class="bg-primary text-white send" data-id="'.$item["id"].'" style="display:inline;float:right;border:0;border-radius:5px;margin-top:10px;"><i class="fa fa-paper-plane"></i></button>
                                      </div>';
                                }
                            }
                            ?>
                        </div>
                        <!--                    <!--For preload Active Friends End-->
                        <!--                           FOr count Friend List Start-->
                        <p style="margin-top:24px;border-bottom:2px solid blue;font-family:'Arial Black'">Friends List (<span id="friendCount"><?php
                                $result11=$db->prepare("SELECT COUNT(*) FROM friends WHERE (uid2=:uid2 OR uid1=:uid2) AND friendship_offical='1'");
                                $result11->execute(array(
                                    "uid2"=>$_COOKIE['userid']
                                ));
                                echo $result11->fetchColumn();?></span>)</p>
                        <!--                           FOr count Friend List ENd-->
                        <div id="fladd">
                            <!--Preload Friend List Start-->
                            <?php
                            $test="";
                            $result=$db->prepare("SELECT * FROM friends WHERE (uid1=:uid1 OR uid2=:uid1) AND friendship_offical='1'");
                            $result->execute(array(
                                "uid1"=>$_COOKIE['userid']
                            ));
                            foreach ($result->fetchAll() as $item){
                                $hey=$db->prepare("select * from users where (id=:id OR id=:id1)");
                                $hey->execute(array(
                                    "id"=>$item['uid1'],
                                    "id1"=>$item['uid2']
                                ));
                                foreach($hey->fetchAll() as $data){
                                    if($data['id']!=$_COOKIE['userid']){
//                                        echo $it['id']."<br>";
                                        $pp=json_decode($data['pp']);
                                        $test.='<div class="p-2"><img src="user/pp/'.$pp.'" alt="user" style="width:50px;height:50px;border-radius:50%;"> <span style="display:inline">'.$data["username"].'</span><button class="bg-danger text-white unfri" data-id="'.$item["id"].'" style="display: inline;float:right;border:0;border-radius:5px;margin-left:4px;margin-top:10px;">Unfriend</button><button class="bg-primary text-white send" data-id="'.$data["id"].'" style="display:inline;float:right;border:0;border-radius:5px;margin-top:10px;"><i class="fa fa-paper-plane"></i></button></div>';
                                    }
                                }
                            } echo $test;
                            ?>
                            <!--                               Preload Friend List End-->
                        </div>
                    </div>
                    <div class="container-fluid m-0 p-0" id="radiv" style="display:none">
                        <!--                           For count Friend Request Count-->
                        <p style="border-bottom:2px solid blue;font-family:'Arial Black'">Friend Requests(<span id="acceptCount"><?php
                                $result101=$db->prepare("SELECT COUNT(*) FROM friends WHERE uid2=:uid2 AND friendship_offical='0'");
                                $result101->execute(array(
                                    "uid2"=>$_COOKIE['userid']
                                ));
                                echo $result101->fetchColumn();
                                ?></span>)</p>
                        <!--                           For count Friend Request Count-->
                        <div id="fradd">
                            <!--                 Preload Accept Friend Start-->
                            <?php
                            $result=$db->prepare("SELECT * FROM friends WHERE uid2=:uid2 AND friendship_offical='0'");
                            $result->execute(array(
                                "uid2"=>$_COOKIE['userid']
                            ));
                            $test="";
                            foreach ($result->fetchAll() as $item){
                                $result01=$db->prepare("select * from users where id=:id");
                                $result01->execute(array(
                                    "id"=>$item['uid1']
                                ));
                                $data=$result01->fetch();
                                $pp=json_decode($data['pp']);
                                $test.='<div class="p-2"><img src="user/pp/'.$pp.'" alt="user" style="width:50px;height:50px;border-radius:50%;"> <span style="display:inline">'.$data["username"].'</span><button class="bg-danger text-white del" data-id="'.$item["id"].'" style="display: inline;float:right;border:0;border-radius:5px;margin-left:4px;margin-top:10px;">Delete</button><button class="bg-primary text-white acc" data-id="'.$item["id"].'"   style="display:inline;float:right;border:0;border-radius:5px;margin-top:10px;">Accept</button></div>';
                            }
                            echo $test;
                            ?>
                            <!--Preload Accept Friend ENd-->
                        </div>
                        <p style="border-bottom:2px solid blue;font-family:'Arial Black';padding-top:20px;">Add Friends</p>
                        <div id="afadd">
                            <div class="p-2">
                                <img src="user/pp/1528195481_this.jpg" alt="user" style="width:50px;height:50px;border-radius:10%;">
                                <span style="display:inline">Aung Myat Thu</span>
                                <button class="bg-primary text-white" style="float:right;border:0;border-radius:5px;margin-left:4px;margin-top:10px;">Add Friend</button>
                                <button class="bg-warning text-white" style="float:right;border:0;border-radius:5px;margin-left:4px;margin-top:10px;display:none;">Cancel Request</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--             For Sub Navigation End-->
        </div>
    </div>
    <div id="profilediv" style="display:none;">
        <!--            FOr cover photo start-->
        <div class="container">
            <img src="user/cp/<?php echo $cpTest; ?>" id="cpimg" class="col-12 p-0 img-thumbnail" alt="" style="height:220px;">
            <div class="col-md-3 col-7 position-absolute " style="top:0;background-color:rgba(0,0,0,0.4)">
                <input type="file" class="custom-file-input" id="cp1" name="file1">
                <i class="fa fa-camera fa-2x " style="position:absolute;top:2px;color:#cdcdcd;" id="cp2"><p style="font-size:12px;position:relative;top:-20px;left:39px">Update Cover Photo</p></i>
            </div>
        </div>
        <!--            FOr cover photo End-->
        <!--            FOr pp Start-->
        <div class="container" style="position:relative;bottom:55px;left:34px;" id="pp">
            <img src="user/pp/<?php echo $ppTest; ?>" class="col-4 col-md-2 p-0 img-thumbnail" id="ppimg" style="width:130px;height:110px;">
            <h4 style="display:inline-block;position:relative;bottom:20px;color:white;padding:0;margin:0" id="h4"><?php echo $dataTest['username']; ?></h4>
            <div class="col-4 col-md-2 position-relative" style="top:-37px;background-color: rgba(0,0,0,0.4)">
                <input type="file" class="custom-file-input" id="pp1" name="file">
                <i class="fa fa-camera fa-1x" style="position: absolute;top:11px;left:1px;color:#cdcdcd" id="pp2"><small>UpdatePP</small></i>
            </div>
        </div>
        <!--            FOr pp End-->
        <a href="logout.php">Logout</a>
    </div>
</div></div><!--For Main body Tag End-->

<!--Search Features start-->
<!--For absoulte fix ul div start-->
<div class="container-fluid" style="background-color:rgba(0,0,0,0.9);position:fixed;width:100%;height:85%;top:60px;overflow:auto;display:none;" id="uldiv">
    <img src="img/loading.gif" id="ploading" style="position:absolute;left:50%;top:50%;cursor:pointer;">
    <a style="position:absolute;text-decoration:none;right:3%;color:red;" id="cancelSearch">X</a>
    <ul id="ul" class="m-0 p-0">
        <!--        No require!To use if require start-->
        <!--        <li>-->
        <!--            <img src="user/pp/1528195481_this.jpg" alt="profile" style="width:45px;height:45px;display:inline;">-->
        <!--            <a href="search/searchPerson.php" style="display:inline;color:white;text-decoration:none;">Aung Myat Thu</a>-->
        <!--            <a  href="#" class="btn btn-primary" style="float:right;">Add Friend</a>-->
        <!--        </li>-->
        <!--        No require!To use if require End-->
    </ul>
</div>
<!--For absoulte fix ul div End-->
<div class="container-fluid m-0 p-0" style="position:fixed;bottom:-16px;z-index:1">
    <form action="search/search.php" method="get">
        <div class="form-group">
            <i id="keywordsbtn" class="fa fa-search text-primary " style="cursor: pointer;position:absolute;bottom:27px;right:10px;"></i>
            <input type="text" class="form-control" id="keywords" name="keywords" style="border-radius:0" placeholder="Search by name or email" autocomplete="off">
        </div>
    </form>
</div>
<!--Search Features End-->
<script src="../bootstrap/js/jquery-3.3.1.min.js"></script>
<script src="../bootstrap/js/popper.min.js"></script>
<script src="../bootstrap/script/tether.js"></script>
<script src="../bootstrap/script/bootstrap.min.js"></script>
<script>
    var messages=document.getElementById("messages");
    var contacts=document.getElementById("contacts");
    var profile=document.getElementById("profile");
    var messagesdiv=document.getElementById("messagesdiv");
    var contactdiv=document.getElementById("contactsdiv");
    var profilediv=document.getElementById("profilediv");
    var pp=document.getElementById("pp");
    var h4=document.getElementById("h4");
    var keywords=document.getElementById("keywords");
    var keywordsbtn=document.getElementById("keywordsbtn");
    var ul=document.getElementById("ul");
    var uldiv=document.getElementById("uldiv");
    var sessionUserId=document.getElementById("sessionuserid").value;
    var friends=document.getElementById("friends");
    var ra=document.getElementById("ra");
    var friendsdiv=document.getElementById("friendsdiv");
    var radiv=document.getElementById("radiv");
    var fladd=document.getElementById("fladd");
    var fradd=document.getElementById("fradd");
    var afadd=document.getElementById("afadd");
    var friendCount=document.getElementById("friendCount");
    var acceptCount=document.getElementById("acceptCount");
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
        contacts.parentElement.classList.remove("bg-primary");
        profile.parentElement.classList.remove("bg-primary");
        messagesdiv.style.display="block";
        contactdiv.style.display="none";
        profilediv.style.display="none";

    };
    contacts.onclick=function(){
        contacts.parentElement.classList.add("bg-primary");
        messages.style.color="black";
        contacts.style.color="white";
        profile.style.color="black";
        messages.parentElement.classList.remove("bg-primary");
        profile.parentElement.classList.remove("bg-primary");
        messagesdiv.style.display="none";
        contactdiv.style.display="block";
        profilediv.style.display="none";
    };
    profile.onclick=function(){
        profile.parentElement.classList.add("bg-primary");
        messages.style.color="black";
        contacts.style.color="black";
        profile.style.color="white";
        contacts.parentElement.classList.remove("bg-primary");
        messages.parentElement.classList.remove("bg-primary");
        messagesdiv.style.display="none";
        contactdiv.style.display="none";
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
    window.addEventListener("resize",resize);
    function resize(){
        var width=window.innerWidth;
        if(width>=990){
            pp.style.bottom="100px";
            h4.style.fontSize="30px";
        }else{
            pp.style.bottom="55px";
            h4.style.fontSize="20px";
        }
    }
    resize();
    //For Window resize Action End
    //For search Fetures Start
    keywords.addEventListener("input",keywordsf);
    function keywordsf(){
        var value=keywords.value;
        if(value.length>=2){
            ul.style.display="block";
            uldiv.style.display="block";
            document.getElementById("ploading").style.display="block";
            var request=new XMLHttpRequest();
            request.open("GET","search/search.php?keywords="+value+"&own="+sessionUserId,true);
            request.setRequestHeader("X-Requested-With","XMLHttpRequest");
            request.onreadystatechange=function(){
                if(request.readyState==4 && request.status==200){
                    document.getElementById("ploading").style.display="none";
                    var result=request.responseText;
                    var json=JSON.parse(result);
                    var string="";
                    if(json.length!=0){
                        for(k in json){
                            //For Friend Request start
                            var btn;
                            if(json[k].status==-1){
                                btn='<button class="btn-primary af" style="float:right;border:0;border-radius:5px;margin-left:4px;margin-top:10px;" data-uid2="'+json[k].uid+'">Add Friend</button>';
                            }else if(json[k].status==0){
                                btn='<button class="btn-warning cr" style="float:right;border:0;border-radius:5px;margin-left:4px;margin-top:10px;" data-uid2="'+json[k].uid+'">Cancel Request</button>';
                            }else if(json[k].status==1){
                                btn='<button class="btn-danger unf" style="float:right;border:0;border-radius:5px;margin-left:4px;margin-top:10px;" data-uid2="'+json[k].uid+'">Unfriend</button>';
                            }//For friend accepter start
                            else if(json[k].status=="accepter"){
                                btn='<button class="bg-danger text-white sdel" data-uid2="'+json[k].uid+'" style="float:right;border:0;border-radius:5px;margin-left:4px;margin-top:10px;">Delete</button><button class="bg-primary text-white sacc" data-uid2="'+json[k].uid+'" style="float:right;border:0;border-radius:5px;margin-top:10px;">Accept</button>';
                            }//For friend accepter end
                            //For Friend Request End
                            string+='<li>' +
                                '<img src="user/pp/'+json[k].pp+'" alt="profile" style="width:40px;height:40px;border-radius:50%;display:inline;"><a href="search/searchPerson.php" style="display:inline;color:white;text-decoration:none;">'+json[k].username+'</a>'+ btn+'<button class="btn-primary af" style="float:right;display:none;border:0;border-radius:5px;margin-left:4px;margin-top:10px;" data-uid2="'+json[k].uid+'">Add Friend</button><button  class="btn-warning cr" style="float:right;display:none;border:0;border-radius:5px;margin-left:4px;margin-top:10px;" data-uid2="'+json[k].uid+'">Cancel Request</button><button class="btn-danger unf" style="float:right;display:none;border:0;border-radius:5px;margin-left:4px;margin-top:10px;" data-uid2="'+json[k].uid+'">Unfriend</button><button class="bg-danger text-white sdel" data-uid2="'+json[k].uid+'" style="float:right;border:0;border-radius:5px;margin-left:4px;margin-top:10px;display:none;">Delete</button><button class="bg-primary text-white sacc" data-uid2="'+json[k].uidid+'" style="float:right;border:0;border-radius:5px;margin-top:10px;display:none;">Accept</button></li>';
                            ul.innerHTML=string;
                            //For Friend System feature Start
                            var af=document.getElementsByClassName("af");
                            var cr=document.getElementsByClassName("cr");
                            var unf=document.getElementsByClassName("unf");
                            var sacc=document.getElementsByClassName("sacc");
                            var sdel=document.getElementsByClassName("sdel");
                            // For Friend Request Feature Start
                            for(var i=0;i<af.length;i++){
                                af[i].addEventListener("click",function(){
                                    this.style.display="none";
                                    this.parentElement.children[4].style.display="block";
                                    var thi=this;
                                    var request=new XMLHttpRequest();
                                    request.open("POST","request.php",true);
                                    request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                                    request.setRequestHeader("X-Requested-With","XMLHttpRequest");
                                    request.send("uid1a="+sessionUserId+"&uid2a="+this.getAttribute("data-uid2"));
                                })
                            }
                            // For Friend Request Feature End

                            //For Friend Request Cancel Feature Start
                            for(var i=0;i<cr.length;i++){
                                cr[i].addEventListener("click",function(){
                                    this.style.display="none";
                                    this.parentElement.children[3].style.display="block";
                                    var request=new XMLHttpRequest();
                                    request.open("POST","request.php",true);
                                    request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                                    request.setRequestHeader("X-Requested-With","XMLHttpRequest");
                                    request.send("uid1c="+sessionUserId+"&uid2c="+this.getAttribute("data-uid2"));
                                })
                            }
                            //For Friend Request Cancel Feature End

                            //For Unfriend Feature Start
                            for(var i=0;i<unf.length;i++){
                                unf[i].addEventListener("click",function(){
                                    this.style.display="none";
                                    this.parentElement.children[3].style.display="block";
                                    var request=new XMLHttpRequest();
                                    request.open("POST","request.php",true);
                                    request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                                    request.setRequestHeader("X-Requested-With","XMLHttpRequest");
                                    request.send("uid1c="+sessionUserId+"&uid2c="+this.getAttribute("data-uid2"));
                                    console.log(sessionUserId,this.getAttribute("data-uid2"));
                                });
                            }
                            //For Unfriend Feature End
                            //For Searchbar accept button Start
                            for(var i=0;i<sacc.length;i++){
                                sacc[i].addEventListener("click",function(){
                                    this.style.display="none";
                                    this.previousElementSibling.style.display="none";
                                    this.parentElement.children[6].style.display="block";
                                    var request=new XMLHttpRequest();
                                    request.open("POST","request.php",true);
                                    request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                                    request.setRequestHeader("X-Requested-With","XMLHttpRequest");
                                    request.send("uid1acc="+sessionUserId+"&uid2acc="+this.getAttribute("data-uid2"));
                                });
                            }
                            //For Searchbar accept button End
                            //For Searchbar Delete button Start
                            for(var i=0;i<sdel.length;i++){
                                sdel[i].addEventListener("click",function(){
                                    this.style.display="none";
                                    this.nextElementSibling.style.display="none";
                                    this.parentElement.children[4].style.display="block";
                                    var request=new XMLHttpRequest();
                                    request.open("POST","request.php",true);
                                    request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                                    request.setRequestHeader("X-Requested-With","XMLHttpRequest");
                                    request.send("uid1del="+sessionUserId+"&uid2del="+this.getAttribute("data-uid2"));
                                    console.log(sessionUserId,this.getAttribute("data-uid2"));
                                    console.log("lay");
                                });
                            }
                            document.getElementById("cancelSearch").addEventListener("click",function(e){
                                e.preventDefault();
                                this.parentElement.style.display="none";
                            });
                            //For Searchbar Delete button End
                            //For Friend System Feature End
                        }
                    }else{
                        ul.style.display="none";
                        uldiv.style.display="none";
                        document.getElementById("ploading").style.display="none";
                    }

                };
            };
            request.send();
        }else{
            ul.style.display="none";
            uldiv.style.display="none";
        }

    }
    //For search Features End

    /**AutoLoad Function start*/
    function autoLoad(){
        var request=new XMLHttpRequest();
        request.open("GET","autoload.php?uid2="+sessionUserId,true);
        request.setRequestHeader("X-Requested-With","XMLHttpRequest");
        request.onreadystatechange=function(){
            if(request.readyState==4 && request.status==200){
                var result=request.responseText;
                var json=JSON.parse(result);
                if(json.friends!=""){
                    friendCount.innerHTML=json.friends[0].countt;
                }else{
                    friendCount.innerHTML=0;
                }
                if(json.accept!=""){
                    acceptCount.innerHTML=json.accept[0].countt;
                }else{
                    acceptCount.innerHTML=0;
                }
                if(json.activeFriend!=""){
                    act.innerHTML="("+json.activeFriendCount+")";
                }else{
                    act.innerHTML="("+0+")";
                }
                var string="";
                var string1="";
                var string2="";
                for(k in json.friends){
                    string+='<div class="p-2">\n' +
                        '<img src="user/pp/'+json.friends[k].pp+'" alt="user" style="width:50px;height:50px;border-radius:50%;">\n' +
                        '<span style="display:inline">'+json.friends[k].username+'</span>\n' +
                        '<button class="bg-danger text-white unfri" data-id="'+json.friends[k].id1+'" style="display: inline;float:right;border:0;border-radius:5px;margin-left:4px;margin-top:10px;">Unfriend</button>\n' +
                        '<button class="bg-primary text-white send" data-id="'+json.friends[k].id+'" style="display:inline;float:right;border:0;border-radius:5px;margin-top:10px;"><i class="fa fa-paper-plane"></i></button>\n' +
                        '</div>\n' +
                        '</div>';
                }
                for(k in json.activeFriend){
                    string2+='<div style="padding-bottom:14px;"><i class="fa fa-circle" style="color:#00c500"></i> <img src="user/pp/'+json.activeFriend[k].pp+'" alt="user" style="width:50px;height:50px;border-radius:50%;"> <span style="display:inline">'+json.activeFriend[k].username+'</span><button class="bg-primary text-white send" data-id="'+json.activeFriend[k].id+'" style="display:inline;float:right;border:0;border-radius:5px;margin-top:10px;"><i class="fa fa-paper-plane"></i></button></div>';
                }
                for(k in json.accept){
                    string1+='<div class="p-2">\n' +
                        '<img src="user/pp/'+json.accept[k].pp+'" alt="user" style="width:50px;height:50px;border-radius:50%;">\n' +
                        '<span style="display:inline">'+json.accept[k].username+'</span>\n' +
                        '<button class="bg-danger text-white del" data-id="'+json.accept[k].id1+'" style="display: inline;float:right;border:0;border-radius:5px;margin-left:4px;margin-top:10px;">Delete</button>\n' +
                        '<button class="bg-primary text-white acc" data-id="'+json.accept[k].id1+'"  style="display:inline;float:right;border:0;border-radius:5px;margin-top:10px;">Accept</button>\n' +
                        '</div>';
                }
                fradd.innerHTML=string1;
                fladd.innerHTML=string;
                activeFriend.innerHTML=string2;
                //For friend accept Delete Button Start
                var del=document.getElementsByClassName("del");
                for(var i=0;i<del.length;i++){
                    del[i].addEventListener("click",function(){
                        var thi=this;
                        this.parentElement.remove();
                        var request=new XMLHttpRequest();
                        request.open("POST","request.php",true);
                        request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                        request.setRequestHeader("X-Requested-With","XMLHttpRequest");
                        request.send("del="+this.getAttribute("data-id"));
                        //For display Friend Count Start
                        var request1=new XMLHttpRequest();
                        request1.open("GET","autoload.php?uidx="+sessionUserId,true);
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
                        request.open("POST","request.php",true);
                        request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                        request.setRequestHeader("X-Requested-With","XMLHttpRequest");
                        request.send("acc="+this.getAttribute("data-id"));
                        //For display Friend Count Start
                        var request1=new XMLHttpRequest();
                        request1.open("GET","autoload.php?uidx="+sessionUserId,true);
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
                        request.open("POST","request.php",true);
                        request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                        request.setRequestHeader("X-Requested-With","XMLHttpRequest");
                        request.send("unfri="+this.getAttribute("data-id"));
                        // //For display Friend Count Start
                        var request1=new XMLHttpRequest();
                        request1.open("GET","autoload.php?uid="+sessionUserId,true);
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
                var send=document.getElementsByClassName("send");
                for(var i=0;i<send.length;i++){
                    send[i].addEventListener("click",function(){
                        var thi=this;
                        var request=new XMLHttpRequest();
                        request.open("POST","conservation&tablemarker.php",true);
                        request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                        request.setRequestHeader("X-Requested-With","XMLHttpRequest");
                        request.onreadystatechange=function(){
                            if(request.readyState==4 && request.status==200){
                                var result=request.responseText;
                                console.log(result);
                                if(result="table and conservation created"){
                                    window.location.href="chatRoom.php?uid="+thi.getAttribute("data-id");
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
    setInterval(autoLoad,2000);
    /**for contact function start*/
        //For friend accept Button Start
    var acc=document.getElementsByClassName("acc");
    for(var i=0;i<acc.length;i++){
        acc[i].addEventListener("click",function(){
            this.parentElement.remove();
            var request=new XMLHttpRequest();
            request.open("POST","request.php",true);
            request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            request.setRequestHeader("X-Requested-With","XMLHttpRequest");
            request.send("acc="+this.getAttribute("data-id"));
            //For display Friend Count Start
            var request1=new XMLHttpRequest();
            request1.open("GET","autoload.php?uidx="+sessionUserId,true);
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
            request.open("POST","request.php",true);
            request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            request.setRequestHeader("X-Requested-With","XMLHttpRequest");
            request.send("del="+this.getAttribute("data-id"));
            //For display Friend Count Start
            var request1=new XMLHttpRequest();
            request1.open("GET","autoload.php?uidx="+sessionUserId,true);
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
            request.open("POST","request.php",true);
            request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            request.setRequestHeader("X-Requested-With","XMLHttpRequest");
            request.send("unfri="+this.getAttribute("data-id"));
            //For display Friend Count Start
            var request1=new XMLHttpRequest();
            request1.open("GET","autoload.php?uidx="+sessionUserId,true);
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
    var send=document.getElementsByClassName("send");
    for(var i=0;i<send.length;i++){
        send[i].addEventListener("click",function(){
            var thi=this;
            var request=new XMLHttpRequest();
            request.open("POST","conservation&tablemarker.php",true);
            request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            request.setRequestHeader("X-Requested-With","XMLHttpRequest");
            request.onreadystatechange=function(){
                if(request.readyState==4 && request.status==200){
                    var result=request.responseText;
                    if(result="table and conservation created"){
                        window.location.href="chatRoom.php?uid="+thi.getAttribute("data-id");
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
        request.open("GET","conservationAutoload.php?fnum="+sessionUserId,true);
        request.setRequestHeader("X-Requested-With","XMLHttpRequest");
        request.onreadystatechange=function(){
            if(request.readyState==4 && request.status==200){
                var result=request.responseText;
                var json=JSON.parse(result);
                var string="";
                for(k in json){
                    var test;
                    if(json[k].tnUser==sessionUserId){test="You: "+json[k].tnText}else if(json[k].tnRowCount==0){test="You are now connected on chatBox"}else{test=json[k].tnText};
                    string+='<li  style="border-radius:5px;background:#faf5f5;margin-bottom:3px;border-bottom:1px solid blue;">\n'+
                        '<div class="row m-0">\n'+
                        '<i class="fa fa-circle" style=";color:#00c500;position:absolute;'+json[k].nb+'"></i>\n<div style="border:0;width:17%;text-align:center;"><img src="user/pp/'+json[k].pp+'" style="width:50px;height:50px;border-radius:50%;"></div>\n'+
                        '<div style="width:63%;padding-left:3px;" class="li" data-uid="'+json[k].cal+'">\n'+
                        '<span>'+json[k].username+'</span><br>\n'+
                        '<small>'+test+'....</small>\n'+
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
                var li=document.getElementsByClassName("li");
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
                    this.parentElement.parentElement.style.backgroundColor="#6f6fff";
                    this.style.color="white";
                    this.nextElementSibling.style.color="white";
                    window.location.href="chatRoom.php?uid="+this.getAttribute("data-uid");
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
                            console.log(json);
                            conservationCount.innerHTML=json[0].conservationCount;
                        }
                    };
                    request1.send();

                }
            }
        };
        request.send();
    }
    setInterval(autoLoad2,3000);
    /**For conservation section start*/
    var li=document.getElementsByClassName("li");
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
        this.parentElement.parentElement.style.backgroundColor="#6f6fff";
        this.style.color="white";
        this.nextElementSibling.style.color="white";
        window.location.href="chatRoom.php?uid="+this.getAttribute("data-uid");
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
    /**For conservation section end*/
    /**AutoLoad Function ENd*/
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
                url:"insertPhoto.php",
                method : "POST",
                data:form_data,
                contentType:false,
                cache:false,
                processData:false,
                beforeSend:function(){
                    document.getElementById("pp1").nextElementSibling.innerHTML="<small>Uploading..<small>";
                },
                success:function(data){
                    document.getElementById("pp1").nextElementSibling.innerHTML="<small>Update PP<small>";
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
                url:"aaa.php",
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
                    console.log(data);
                }
            });
        }
    });
    /**For cover pictiures end*/
</script>
</body>
</html>
