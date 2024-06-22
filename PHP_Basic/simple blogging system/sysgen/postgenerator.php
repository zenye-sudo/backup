<?php
define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASS","");
define("DB_NAME","php_basic_blog");
date_default_timezone_set("Asia/Rangoon");
function dbConnect(){
    $dbConnect=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    if(mysqli_connect_errno($dbConnect)==0){
        return $dbConnect;
    }else{
        echo "Database Connection Fail!";
    }
};
function getMyDate(){
    return date("Y-m-d/H:m:s",time());
}
function insertDatas($title,$type,$subject,$writer,$content,$imglink){
    $db=dbConnect();
   $created_at=getMyDate();
   $qry="INSERT INTO post (title,type,subject_id,writer,content,imglink,created_at) VALUES ('$title',$type,$subject,'$writer','$content','$imglink','$created_at')";
   if(strlen($content)>100 && strlen($title)>10 && strlen($writer)>0){
       mysqli_query($db,$qry);
       return "True";
   }else{
       return "False";
   }

}
function showDatas($type,$start){
    $db=dbConnect();
    $qry="";
    if($type==2){
        $qry="SELECT * FROM post LIMIT $start,5";
    }else{
        $qry="SELECT * FROM post WHERE type=$type LIMIT $start,5";
    }
    return mysqli_query($db,$qry);
}
function showDatastwo($type,$start){
    $db=dbConnect();
    $qry="";
    if($type==2){
        $qry="SELECT * FROM post LIMIT $start,6";
    }else{
        $qry="SELECT * FROM post WHERE type=$type LIMIT $start,6";
    }
    return mysqli_query($db,$qry);
}

function postDetails($id){
    $db=dbConnect();
    $qry="SELECT * FROM post WHERE id=$id";
    if($id>0){
        $result=mysqli_query($db,$qry);
        return $result;
    }else{
        return "Post Id not found!";
    }
}
function updatePost($title,$type,$subject,$writer,$content,$imglink,$pid){
  $db=dbConnect();
  $qry="UPDATE post SET title='$title',type=$type,subject_id=$subject,writer='$writer',content='$content',imglink='$imglink' WHERE id=$pid";
  return mysqli_query($db,$qry);
}

function filteredposts($type,$subject_id,$start){
    $db=dbConnect();
    if($type==1){
        $qry="SELECT * FROM post WHERE subject_id=$subject_id AND type=1 LIMIT $start,6";

    }else{
        $qry="SELECT * FROM post WHERE subject_id=$subject_id LIMIT $start,6";


    }
    return mysqli_query($db,$qry);
}
function filteredpoststwo($type,$subject_id){
    $db=dbConnect();
    if($type==1){
        $qry="SELECT * FROM post WHERE subject_id=$subject_id AND type=1";

    }else{
        $qry="SELECT * FROM post WHERE subject_id=$subject_id";


    }
    $result= mysqli_query($db,$qry);
    return mysqli_num_rows($result);
}

function subjects(){
    $db=dbConnect();
    $qry="SELECT * FROM subjects";
    return mysqli_query($db,$qry);
}

function allPostCount($type){
    $db=dbConnect();
    $qry="";
    if($type==2){
        $qry="SELECT * FROM post";
    }else{
        $qry="SELECT * FROM post WHERE type=$type";
    }
    $result=mysqli_query($db,$qry);
    return mysqli_num_rows($result);
}

function deletePost($id){
    $db=dbConnect();
    $qry="DELETE FROM post WHERE id=$id";
    mysqli_query($db,$qry);
}


//Social Media Start
function curTime(){
    return date("Y-m-d/H:m:s",time());
}
function insertComments($name,$pid,$comments){

    if($name!=NULL && $pid!=NULL && $comments!=NULL){
        $db=dbConnect();
        $ment_at=curTime();
        $qry="INSERT INTO socialmedia(name,pid,comment,ment_at) VALUES ('$name',$pid,'$comments','$ment_at')";
        mysqli_query($db,$qry);
    }

}
function showComments($pid){
    $db=dbConnect();
    $qry="SELECT * FROM socialmedia WHERE  pid=$pid";
    return mysqli_query($db,$qry);
}
