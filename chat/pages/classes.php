<?php
class user{
    private $userId,$userName,$userEmail,$userPassword;

    public function getUserId(){
        return $this->userId;
    }
    public function setUserId($userId){
        $this->userId=$userId;
    }
    public function getUserName(){
        return $this->userName;
    }
    public function setUserName($userName){
        $this->userName=$userName;
    }

    public function getUserEmail(){
        return $this->userEmail;
    }
    public function setUserEmail($userEmail){
        $this->userEmail=$userEmail;
    }

    public function getUserPassword(){
        return $this->userPassword;
    }
    public function setUserPassword($userPassword){
        $this->userPassword=$userPassword;
    }
    public function Register(){
        $db=new PDO("mysql:host=localhost;dbname=chat","root","");
        $req=$db->prepare("INSERT INTO  users(name,email,password) VALUES(:name,:email,:password)");
        $req->execute(array(
            'name'=>$this->getUserName(),
            'email'=>$this->getUserEmail(),
            'password'=>$this->getUserPassword()
        ));
    }
    public function Login(){
        $db=new PDO("mysql:host=localhost;dbname=chat","root","");
        $result=$db->prepare("SELECT * FROM users WHERE email=:email AND password=:password");
        $result->execute(array(
            "email"=>$this->getUserEmail(),
            "password"=>$this->getUserPassword()
        ));
        if($result->rowCount()==0){
            return false;
        }else{
            foreach($result->fetchAll() as $item){
                echo $item['id']."<br>";
                $this->setUserId($item['id']);
                $this->setUserName($item['name']);
                $this->setUserEmail($item['email']);
                $this->setUserPassword($item['password']);
            }
            header("location:home.php");
            return true;
        }
    }
}
//For Chat
class chat{
    private $chatId,$chatUserId,$chatUserText;
    public function getChatId(){
        return $this->chatId;
    }
    public function setChatId($chatId){
        $this->chatId=$chatId;
    }
    public function getChatUserId(){
        return $this->chatUserId;
    }
    public function setChatUserId($chatUserId){
        $this->chatUserId=$chatUserId;
    }
    public function getChatUserText(){
        return $this->chatUserText;
    }
    public function setChatUserText($chatUserText){
        $this->chatUserText=$chatUserText;
    }
    public function InsertChat(){
        $db=new PDO("mysql:host=localhost;dbname=chat","root","");
        $req=$db->prepare('INSERT INTO chats(uid,text) VALUES(:uid,:text)');
        $req->execute(array(
            "uid"=>$this->getChatUserId(),
            "text"=>$this->getChatUserText()
        ));
    }
    public function DisplayMessages(){
        $db=new PDO("mysql:host=localhost;dbname=chat","root","");
        $result=$db->prepare("SELECT * FROM chats ORDER BY id DESC ");
        $result->execute();
        foreach($result->fetchAll() as $item){
            $result1=$db->prepare("SELECT * FROM users WHERE id=:id");
            $result1->execute(array(
                "id"=>$item['uid']
            ));
            $datuser=$result1->fetch();
            ?>
            <span id="user"><?php echo $datuser['name'] ?></span>  Say: <br>
            <span> <?php echo $item['text'] ?></span><br><br>
<?php
        }
    }
}