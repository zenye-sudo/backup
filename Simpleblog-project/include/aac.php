<?php
$db=new PDO("mysql:host=localhost;dbname=techcoder","root","ituser9");
$postids=$db->prepare("SELECT id FROM posts");
$postids->execute();
$postids->setFetchMode(PDO::FETCH_ASSOC);
$num=0;
$aac="";

foreach($postids as $item){
    $num++;
    $ids=$item['id'];
    $likecounter=$db->prepare("SELECT count(id) from articles_like where article=$ids");
    $likecounter->execute();
    $likecounter->setFetchMode(PDO::FETCH_ASSOC);
    $liker=$likecounter->fetchColumn();
    if($num<=$ids){
    $db->exec("DELETE from aac WHERE article=$ids");
        $aac=$db->exec("INSERT INTO aac (article,likecounter) VALUES($ids,$liker)");
    }

}
$main="";
$main=$db->prepare("SELECT article FROM aac ORDER BY likecounter DESC LIMIT 7");
$main->execute();
$ary=[];
foreach($main->fetchAll() as $value){
    $ary[]=$value['article'];
}