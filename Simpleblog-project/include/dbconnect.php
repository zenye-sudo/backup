<?php
class FormInsert{
    public function __construct($username,$email,$password,$repassword,$country)
    {
    if($this->checkUsername($username) AND $this->checkEmail($email) AND $this->checkPassword($password) AND $this->doublecheck($password,$repassword) AND $this->extra($email)=="This email is not exist"){
            return "Registration Successful!";
    }
    else{
//            For Each Message Start
     if($this->checkUsername($username)=="Username is something wrong!")
     {
         return "Username is something wrong!";
     }else if($this->checkEmail($email)=="Email is something wrong!"){
         return "Email is something wrong!";
     }else if($this->checkPassword($password)=="Password is something wrong!"){
         return "Password is something wrong!";
     }else if($this->doublecheck($password,$repassword)==false){
         return "The two password is not match!";
     }else if($this->extra($email)=="This email is already exist"){
         return "Email is already exists";
     }
    }

    }
    public function InsertForm($name,$email,$password,$country){
        $password=md5($password);
        $password=sha1($password);
        $password=crypt($password,$password);
        date_default_timezone_set("Asia/Rangoon");
        $curTime=$this->getMyDate();
        switch($country){
            case 1:
                $country="Myanmar";
                break;
            case 2:
                $country="Thailand";
                break;
            case 3:
                $country="Japan";
                break;
            case 4:
                $country="Koera";
                break;
        }
        $db=new PDO('mysql:host=localhost;dbname=techcoder',"root","");
        $check=$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $result=$db->exec("INSERT INTO users(name,email,password,country,created_at) VALUES ('$name','$email','$password','$country','$curTime')");
    }
    public function getMyDate(){
        return date("Y/m/d H:m:s",time());
    }
    //    For Each Message End

    public function checkUsername($username){
        if(strlen($username)>=6){
            $regex=preg_match("/^[^!@#$%^&*()_+]+$/",$username);
            return $regex;
        }else{
            return "Username is something wrong!";
        }

    }
    public function checkEmail($email){

        if(strlen($email)>=13){
            $regex=preg_match("/^[a-zA-Z0-9]+\@[a-zA-Z]+\.[com|net|org]+$/",$email);
            return $regex;
        }else{
            return "Email is something wrong!";
        }

    }
    function extra($email){
        $db=new PDO("mysql:host=localhost;dbname=techcoder","root","");
        $check=$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $result=$db->prepare("SELECT * FROM users WHERE email='$email'");
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);
        if($result->fetchColumn()!= NULL){
            return "This email is already exist";
        }else{
            return "This email is not exist";
        }
    }
    public function checkPassword($password){
        if(strlen($password)>=6){
            $regex=preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^\w]).+$/",$password);
            return $regex;
        }else{
            return "Password is something wrong!";
        }

    }
    public function doublecheck($password,$repassword){
        if($password!=NULL AND $repassword!=NULL){
            if($password==$repassword){
                return true;
            }else{
                return false;
            }
        }

    }
    public function login($email,$password){
        $password=md5($password);
        $password=sha1($password);
        $password=crypt($password,$password);
        $db=new PDO("mysql:host=localhost;dbname=techcoder","root","");
        $result=$db->prepare("SELECT * FROM users WHERE email='$email' AND password='$password'");
        if($result->fetchColumn()!=NULL){
            return "Login Successful!";
        }else{
            return "Login Fail!";
        }
    }
}