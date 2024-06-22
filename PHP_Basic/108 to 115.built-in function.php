<?php 
//printf and fprintf
//%%=Return a percent sign;
//%b=Binary number;
//%c=the character according to the ascii value;
//%d=Signed decimal number;
//%e=Scientific notation using a lowercase(eg.1.2e+2);
//%E=                            UpperCase(eg.1.2E+2);
//%f=floating number
// $number=0.3;
// $string="Yangon";
// printf("There are %f of people in %s.",$number,$string);
// fprintf(fopen('Test/test.txt','w'),"There are %u of people in %s",$number,$string);
// echo "<br><br>";



// //lcfirst,ucword,strtoupper and strtolower
// $string="A-Copyright (C) 1989, 1991 Free Software Foundation, Inc.,
//  51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA
//  Everyone is permitted to copy and distribute verbatim copies
//  of this license document, but changing it is not allowed.";
//  echo lcfirst($string)."<br>";
//  echo ucwords($string)."<br>";
//  echo strtolower($string)."<br>";
//  echo strtoupper($string)."<br>";
//  echo "<br><br>";


//  //ltrim,rtrim and trim
//  $str=" zan ye ";
//  echo strlen($str)."<br>";
//  $trim=rtrim($str);
//  echo $trim."<br>";
//  echo strlen($trim);

//  //md5 and sha1
//  $pass=1234;
//  $pass=md5($pass);
//  $pass=sha1($pass);
//  $pass=crypt($pass,$pass);
//  echo $pass."<br>";

//  //Number Format
//  $number=23243434343;
//  echo number_format($number,"10",'-',".")."<br>";


//  //strcmp
//  $str1="What are y sdfsdfou doing?";
//  $str2="What are you doing now?";
//  echo strcmp($str1, $str2)."<br>";

// //strlen,strpos,strrpos,stripos,strripos;
//  $string1="Google Chrome
// Copyright 2018 Google Inc. All rights reserved.
// Google Chrome is made possible by the Chromium open source project and other open source software.
// Google Chrome Terms of Service";
// echo strpos($string1,'o')."<br>";//(search the first occurance);
// echo strrpos($string1,'e')."<br>";//(search the last occurance);
// echo stripos($string1,"O")."<br>";//Case Censitive;
// echo strripos($string1,"E")."<br>";//Case Censitive;


//str_word_count,chunk split and substr
$str5="Google Chrome
Copyright 2018 Google Inc. All rights reserved.
Google Chrome is made possible by the Chromium open source project and other open source software.
Google Chrome Terms of Service";
$count=str_word_count($str5)."<br>";
$sub=substr($str5,0,strlen($str5));
$split=chunk_split($str5,1,',');
// echo $count;
// echo $sub;
echo $split;
//
 ?>