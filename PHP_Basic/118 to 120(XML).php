<?php 
//File Reading
$data=simplexml_load_file("Test/xml.xml");
foreach($data as $key=>$value){
	echo $key."=>".$value;
}
//File writing
$ary=array(
  'name'=>'zanye',
  'age'=>'17',
  'work'=>'web develoment'
);
$data='';
$data.="<zanye>";
foreach($ary as $key=>$value){
 $data.='<'.$key.">";
 $data.=$value;
 $data.='<'.$key."/>";
}
$data.="</zanye>";
fprintf(fopen('Test/zanye.xml','w'),'%s',$data);
 ?>