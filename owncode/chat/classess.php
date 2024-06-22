<?php
require_once "connection.php";
class chat{
    private $user,$text,$table;
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
    function insertMessage(){
        global $db;
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $result=$db->prepare("INSERT INTO `{$this->getTable()}`(uid,text) VALUES (:uid,:text)");
        $result->execute(array(
            "uid"=>$this->getUser(),
            "text"=>$this->getText()
        ));
    }
}
class AddFriend{
    private $uid1,$uid2,$fo;
    public function getUid1(){
        return $this->uid1;
    }
    public function setUid1($uid1){
        $this->uid1=$uid1;
    }
    public function getUid2(){
        return $this->uid2;
    }
    public function setUid2($uid2){
        $this->uid2=$uid2;
    }
    public function getFo(){
        return $this->fo;
    }
    public function setFo($fo){
        $this->fo=$fo;
    }
    public function addRequest(){
        global $db;
        $result=$db->prepare("INSERT INTO friends(uid1,uid2,friendship_offical) VALUES (:uid1,:uid2,:fo)");
        $result->execute(array(
            "uid1"=>$this->getUid1(),
            "uid2"=>$this->getUid2(),
            "fo"=>$this->getFo()
        ));
    }
    public function cancelRequest(){
        global $db;
        $result=$db->prepare('DELETE FROM friends WHERE uid1=:uid1 AND uid2=:uid2');
        $result->execute(array(
            "uid1"=>$this->getUid1(),
            "uid2"=>$this->getUid2()
        ));
    }
    public function cancelRequest1(){
        global $db;
        $result=$db->prepare('DELETE FROM friends WHERE uid2=:uid1 AND uid1=:uid2');
        $result->execute(array(
            "uid1"=>$this->getUid1(),
            "uid2"=>$this->getUid2()
        ));
    }
    public function acceptFriend(){
        global $db;
        $result=$db->prepare("UPDATE friends SET friendship_offical='1' WHERE id=:id");
        $result->execute(array(
           "id"=>$this->getUid1()
        ));
    }
    public function requestDel(){
        global $db;
        $result=$db->prepare("DELETE FROM friends WHERE id=:id");
        $result->execute(array(
            "id"=>$this->getUid1()
        ));

    }
    public function acceptFriend1(){
        global $db;
        $result=$db->prepare("UPDATE friends SET friendship_offical='1' WHERE uid2=:uid1 AND uid1=:uid2");
        $result->execute(array(
            "uid1"=>$this->getUid1(),
            "uid2"=>$this->getUid2()
        ));
    }
    public function deleteRequest1(){
        global $db;
        $result=$db->prepare("DELETE FROM friends WHERE uid2=:uid1 AND uid1=:uid2");
        $result->execute(array(
            "uid1"=>$this->getUid1(),
            "uid2"=>$this->getUid2()
        ));
    }
    public function conservationDeleter(){
        global $db;
        $result=$db->prepare("DELETE FROM conservation WHERE uid=:uid AND tn=:tn");
        $result->execute(array(
            "uid"=>$this->getUid1(),
            "tn"=>$this->getUid2()
        ));
    }

}

