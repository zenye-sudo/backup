<?php 
 srand(microtime()*10000000);
 echo rand()."<br>";
 echo mt_rand();//This method is faster than rand().


$onewin=0;
$twowin=0;
$draw=0;
for($i=0;$i<100;$i++){
$player1=rand(0,6);
$player2=rand(0,6);
   if($player1>$player2){
   	$onewin++;
   }else if($player1==$player2){
      $draw++;
   }else{
   	$twowin++;
   }
}
echo $onewin."<br>".$twowin."<br>".$draw."<br>";

$userBroser=$_SERVER['HTTP_USER_AGENT'];
ECHO $userBroser;


 ?>