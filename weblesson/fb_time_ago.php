<?php
date_default_timezone_set("Asia/Bangkok");
 function time_ago($timestamp){
     $time_ago=strtotime($timestamp);
     $now=time();
     $seconds=$now-$time_ago;
     $minutes=round($seconds/60);
     $hours=round($seconds/(60*60));
     $days=round($seconds/(60*60*24));
     $weeks=round($seconds/(7*60*60*24));
     $months=round($seconds/(((365+365+365+365+366)/5/12)*60*60*24));//(365+365+365+365+366)/5/12
     $years=round($seconds/(((365+365+365+365+366)/5)*60*60*24));
     if($seconds<=60)
     {
         return "just now";
     }else if($minutes<=60)
     {
         if($minutes==1){
             return "one minutes ago";
         }else{
             return $minutes." minutes ago";
         }
     }else if($hours<=24){
         if($hours==1){
             return "one hour ago";
         }else{
             return $hours ." hours ago";
         }
     }else if($days<=7){
         if($days==1){
             return "Yesterday";
         }else{
              return $days." days ago";
         }
     }else if($weeks<=4.3)//4.3=52/12
     {
       if($weeks==1){
           return "a week ago";
       }else{
           return $weeks." weeks ago";
       }
     }else if($months<=12){
         if($months==1){
             return "a month ago";
         }else {
             return $months." months ago";
         }
     }else{
         if($years==1){
             return "a year ago";
         }else{
             return $years." years ago";
         }
     }
 }
 echo time_ago("2018-6-12 13:03:34");