<?php
require_once "connection.php";
date_default_timezone_set("Asia/Rangoon");
class chat{
    private $user,$text,$table,$imgSend,$imgSend_tmp;
    public function getUser(){
        return $this->user;
    }
    public function setUser($user){
        $this->user=$user;
    }
    public function getText(){
        return $this->text;
    }
    public function setText($text){
        $this->text=$text;
    }
    public function getTable(){
        return $this->table;
    }
    public function setTable($table){
        $this->table=$table;
    }
    public function getImgSend(){
        return $this->imgSend;
    }
    public function setImgSend($imgSend){
        $this->imgSend=$imgSend;
    }
    public function getTmp(){
        return $this->imgSend_tmp;
    }
    public function setTmp($imgSend_tmp){
        $this->imgSend_tmp=$imgSend_tmp;
    }
    function insertMessage(){
        global $db;
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $result=$db->prepare("INSERT INTO `{$this->getTable()}`(uid,text,created_at) VALUES (:uid,:text,:created_at)");
        $result->execute(array(
            "uid"=>$this->getUser(),
            "text"=>$this->getText(),
            "created_at"=>date("Y-m-d H:i:s",time())
        ));
    }
    public function ImgSend(){
        global $db;
        $NewName=uniqid()."_".$this->getImgSend();
        $tmp_name=$this->getTmp();
        move_uploaded_file($tmp_name,"SendImg/".$NewName);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $result=$db->prepare("INSERT INTO `{$this->getTable()}`(uid,text,created_at) VALUES (:uid,:text,:created_at)");
        $result->execute(array(
            "uid"=>$this->getUser(),
            "text"=>$NewName,
            "created_at"=>date('Y-m-d H:i:s',time())
        ));
    }
}