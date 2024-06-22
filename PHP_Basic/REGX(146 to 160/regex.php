<?PHP
//$var="aaaaaaaaa";
//$bol=preg_match("/bri/i",$var);//i is case_sencitive off!
//$bol=preg_match("/[^a]/",$var);
//echo $bol ? "TRUE" : "FLASE";


//
//$replace='Brighter 232Myanmar';
//$result=preg_replace("/[[:alpha:]]/","$",$replace);
//$result=preg_replace("/[[:digit:]]/","$",$replace);
//$result=preg_replace("/[[:alnum:]]/","$",$replace);
//$result=preg_replace("/[[:space:]]/","$",$replace);
//echo $result;


//$var="ssdhf343";
////$result=preg_match("/p.p/",$var);
////$result=preg_match("/^.{2}$/",$var);
////$result=preg_match("/<b>(.*)<\/b>/",$var);
////$result=preg_match("/p(hp)*/",$var);
////$result=preg_match("/\d/",$var);
////$result=preg_match("/\s/",$var);
//$result=preg_match("/\w/",$var);
//echo $result ? "TRUE" :"FALSE";


//$var="futurenetzenye@gmail.com.mm";
//$result=preg_match("/^[a-zA-Z0-9]+\@[a-z]+\.[a-z]{3}\.[a-z]{2}$/",$var);
//echo $result ? "True" :"False";


//$var="Brighter Myanmar Copyright @ 2009";
//$result=preg_replace("/[[:digit:]]+/","2011",$var);
//echo $result;



//$var ="Brighter Myanmar Copyright @ 2009";
//$result=preg_replace(
//    array("/copyright/i","/[0-9]+/"),
//    array("Computer Class","2011"),
//    $var
//);
//echo $result;


//$var="zanye <span style='color:red'>ZEN YE</span>";
//$result=preg_replace("/<span style='color:red'>.*<\/span>/","",$var);
//echo $result;

//$subject="There is a way , there is a need!";
//$result1=preg_split("/[\s,]/",$subject,null);
//$result2=preg_split("/[\s,]/",$subject,null,PREG_SPLIT_NO_EMPTY);
//$result3=preg_split("/[\s]/",$subject,null,PREG_SPLIT_OFFSET_CAPTURE);
//
//
//echo "<pre>".print_r($result1,true)."</pre><BR>";
//echo "<pre>".print_r($result2,true)."</pre><BR>";
//echo "<pre>".print_r($result3,true)."</pre><BR>";


//******************GROUP**************
//$str="HDSDFSD.";
//$result=preg_match("/([^a-z]+)\.([^A-Z]*)/",$str);
//echo $result ? "True" : "False";


//*****************preg_match_all*************************
//$var="We start learning php at 7:30 am and finish learning at 5:30 pm";
//preg_match_all("/(\d+:\d+)\s(am|pm)/",$var,$match,PREG_PATTERN_ORDER);
//echo "<pre>".print_r($match,true)."</pre><HR>";
//preg_match_all("/(\d+:\d+)\s(am|pm)/",$var,$matchS,PREG_SET_ORDER);
//echo "<pre>".print_r($matchS,true)."</pre>";

//********************preg_quote function*************************
//$var="MY name is\ zen ye!";
//echo $var."<hr>";
//$result=preg_quote($var);
//echo $result;


//***********************REGEX LOOKAROUND***********************
//positive lookahead
//$pla="AVCdf";
//$regex1=preg_match("/A(?=[a-z])/",$pla);
//$regex1=preg_match("/A(?=.*[a-z])/",$pla);
//echo $regex1 ? "True" :"False";
//echo "<br>";
//
////positive lookbehind
//$pla1="dsAdC";
//$regex2=preg_match("/(?<=[a-z])C/",$pla1);
//echo $regex2 ? "True" :"False";
//echo "<br>";
//
////negative lookahead
//$pla2="dsAdCDdssds";
//$regex3=preg_match("/C(?![a-z])/",$pla2);
//$regex3=preg_match("/C(?!.*[a-z])/",$pla2);
//echo $regex3 ? "True" :"False";
//echo "<br>";
//
////negative lookbehind
//$pla1="dsAC";
//$regex2=preg_match("/(?<![a-z])C/",$pla1);
//echo $regex2 ? "True" :"False";
//echo "<br>";
//
////Check the password
//$password="SDFSdfd23_";
//$result=preg_match("/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*(_|[^\w]))/",$password);
//echo $result ? "True" :"False";

?>