<?php
include_once("dbConnect.php");
function membershipcheck($username,$email,$password,$retype_password){
    if(usernameCheck($username) && emailCheck($email) && passwordChecker($password) && $password==$retype_password ){
        return insertDatas($username,$email,$password);
    }else{
        return "Javascript checker Fail!";
    }
}
function usernameCheck($username){
   if(strlen($username)>=6){
       $bol=preg_match("/^\w+$/",$username);
       return $bol;
   } else{
       return false;
   }
};
function emailCheck($email){
   if(strlen($email)>=15){
       $bol=preg_match("/^\w+@[a-z]{3,10}+\.[com|org|net]/",$email);
       return $bol;
   }else{
       return false;
   }
};
function passwordChecker($password){
  if(strlen($password)>=8){
      $bol=preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/",$password);
      return $bol;
  } else{
      return false;
  }
};
function loginCheck($email,$password){
 if(emailCheck($email) && passwordChecker($password)){
     return loginDbCheck($email,$password);
//     return "javascript checker success!";
 }else{
     return "javascript checker fail!";
 }
}

function blankCheck(){
 echo "Hello";
}
?>