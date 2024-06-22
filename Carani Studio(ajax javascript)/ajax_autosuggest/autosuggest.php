<?php
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest";
}
if(!is_ajax_request()){
    exit;
}
//Notes
//*strpos is faster than strstr or preg_match
//*strpos is require strict comparison operator(===)
//return 0 for match at start of string
//return false for no match;
function str_starts_with($choice,$query){
    return strpos($choice,$query)===0;
}
function str_contains($choice,$query){
    return strpos($choice,$query)!==false;
}





function search($query,$choices){
    $matches=[];
    $d_query=strtolower($query);

    foreach($choices as $choice){
        $d_choice=strtolower($choice);
        if(str_starts_with($d_choice,$d_query)){
            $matches[]=$choice;
        }
    }
    return $matches;
}

$query=isset($_GET['q']) ? $_GET['q'] :"";

$choices=file("includes/us_train_names.txt",FILE_IGNORE_NEW_LINES);
$suggestions=search($query,$choices);
$max_suggestions=5;
sort($suggestions);
$top_suggestions=array_splice($suggestions,0,$max_suggestions);

echo json_encode($top_suggestions);