<?php 
function createMyFile(){
$handler=fopen('Test/test.txt','w');
fclose($handler);
};
function writeMyFile(){
	$handler=fopen('Test/test.txt','w');
	fwrite($handler,"Zen Ye");
	fclose($handler);
}
function appendFile(){
	$handler=fopen('Test/test.txt','a');
	fwrite($handler,"This is appendFile");
	fclose($handler);
}
function readMyFile(){
	if(file_exists("Test/test.txt")){
		$handler=fopen("Test/test.txt","r");
		$data=fread($handler,filesize("Test/test.txt"));
		fclose($handler);
		return $data;
	}else{
		echo "File not Found that you search.";
	}
}
createMyFile();
writeMyFile();
appendFile();
echo readMyFile();

 ?>