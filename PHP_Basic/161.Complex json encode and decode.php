<?php
$ary=[
    ["one"=>"zenye","two"=>"yezen","three"=>"kweeye"],
    ["four"=>"zenye","five"=>"yezen","six"=>"kweeye"],
    ["seven"=>"zenye","eight"=>"yezen","nine"=>"kweeye"],
    ["ten"=>"zenye","eleven"=>"yezen","thirteen"=>
        ["one"=>"zenye","two"=>"yezen","three"=>"kweeye"],
        ["four"=>"zenye","five"=>"yezen","six"=>"kweeye"],
        ["seven"=>"zenye","eight"=>"yezen","nine"=>"kweeye"],
        ["ten"=>"zenye","eleven"=>"yezen","thirteen"=>"kweeye"]
    ]
];
$encode=json_encode($ary);
$decode=json_decode($encode,true);
foreach($decode as $first){
     foreach($first as $key=>$value){
         if(!is_array($value)) {
             echo "Key is ".$key." and value is ".$value . "<br>";

         }else{
             foreach($value as $key=>$value){
               echo "key is ".$key ." and value is ".$value."<br>";
             }
         }
         echo "<hr>";

     }
};
?>