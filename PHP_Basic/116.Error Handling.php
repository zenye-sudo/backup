<?php 
//Die and exit and try catch
// if(file_exists('ain.txt')){
// 	echo "There is file with that key.";
// }else{
// 	echo "File not found.";
// 	die();
// 	// same to exit() function;
// }
// echo "Hello Wolrd";

try{
   if(file_exists('test.txt')){
   	echo "Test.txt";
   }else if(file_exists('main.txt')){
    throw new Exception("Main.txt");
   }else{
   	throw new Exception("FUCK");
   }
}catch(Exception $e){
	echo $e->getMessage();
}


 ?>