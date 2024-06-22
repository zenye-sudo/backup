<?php
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
}
if(!is_ajax_request()){exit;}
$keywords=isset($_GET['keywords'])  ? $_GET['keywords'] : "";
$db=new PDO("mysql:host=localhost;dbname=techcoder","root","");
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
if(isset($_GET['keywords'])) {
    $array=[];
   $result=$db->prepare("SELECT id,title FROM posts WHERE title LIKE('%{$keywords}%') OR content LIKE('%{$keywords}%') OR wirter LIKE('%{$keywords}%')");
   $result->execute();
   $result->setFetchMode(PDO::FETCH_ASSOC);
   foreach($result as $item){
       $array[]=[$item['id']=>$item['title']];
   }
   $array=array_splice($array,0,6);
   echo json_encode($array);
}