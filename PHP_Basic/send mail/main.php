<?php
//Single Mail Sending
//$to="zenye@localhost";
//$subject="Just Testing";
//$messages="I am just testing to work my php mailing system is work!";
//$header="From: zanye@gmail.com";
//mail($to,$subject,$messages,$header);

////Two mail sending
//$to="yezen@localhost,kweeye@localhost";
//$subject="Just Testing";
//$message="I am just testing to work my phph mailing systme is work!";
//$header="From: zanye@gmail.com";
//mail($to,$subject,$message,$header);

//Multiple Mail Sending
//$ary=["zenye@localhost","yezen@localhost","kweeye@localhost"];
//$to=implode(',',$ary);
//$subject="Just Testing";
//$message="I am just testing to work my phph mailing systme is work!";
//$header="From: zanye@gmail.com";
//mail($to,$subject,$message,$header);

//HTML Mail Sending
$ary=["futurenetzenye@gmail.com"];
$to=implode(",",$ary);
$subject="Just Testing!";
$header="From:futurenetzenye@gmail.com\n";//\n is linebreak char and \r is enter khot
$header.="Content-Type:text/html";
$message="<html><body>";
$message.="<div style=\"width:80%;margin:0 auto;border:1px solid black;overflow:auto\">
      <h1 style=\"text-align:center;color:red;font-family:Cambria\">Brighter Myanmar</h1>
      <p style=\"text-indent:45px;font-family:Cambria;\">You have successfully installed
          XAMPP on this system! Now you can start using Apache, MariaDB, PHP and other compon
          ents. You can find more info in the FAQs section or check
          the HOW-TO Guides for g
          tting started with PHP applications.
          XAMPP is meant only for development purposes. It has certain configuration
          settings that make it easy to develop locally but that are insecure if you wa
          nt to have your installation accessible to others. If you want have your XAM
          PP accessible from the internet, make sure you understand the implications a
          nd you checked the FAQs to learn how to protect your site. Alternatively y
          ou can use WAMP, MAMP or LAMP which are similar packages which are more suit
          able for production.</p>
      <p style=\"text-indent:45px;font-family:Cambria;\">You have successfully installed
          XAMPP on this system! Now you can start using Apache, MariaDB, PHP and other compon
          ents. You can find more info in the FAQs section or check
          the HOW-TO Guides for g
          tting started with PHP applications.
          XAMPP is meant only for development purposes. It has certain configuration
          settings that make it easy to develop locally but that are insecure if you wa
          nt to have your installation accessible to others. If you want have your XAM
          PP accessible from the internet, make sure you understand the implications a
          nd you checked the FAQs to learn how to protect your site. Alternatively y
          ou can use WAMP, MAMP or LAMP which are similar packages which are more suit
          able for production.</p>
      <p style=\"text-indent:45px;font-family:Cambria;\">You have successfully installed
          XAMPP on this system! Now you can start using Apache, MariaDB, PHP and other compon
          ents. You can find more info in the FAQs section or check
          the HOW-TO Guides for g
          tting started with PHP applications.
          XAMPP is meant only for development purposes. It has certain configuration
          settings that make it easy to develop locally but that are insecure if you wa
          nt to have your installation accessible to others. If you want have your XAM
          PP accessible from the internet, make sure you understand the implications a
          nd you checked the FAQs to learn how to protect your site. Alternatively y
          ou can use WAMP, MAMP or LAMP which are similar packages which are more suit
          able for production.</p>
      <p style=\"float:right;clear:both\">Your Sincerely!</p>
      <p style=\"float:right;clear:both\">Zenye</p>

  </div>";
$message.="</body><html>";
$result=mail($to,$subject,$message,$header);
echo $result ? "Success!" :"Fail!";
?>