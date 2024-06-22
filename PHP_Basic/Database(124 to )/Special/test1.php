<?php

define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASS","");
define("DB_NAME","best");
function errDebugger($data){
  echo "<pre>".print_r($data,true)."</pre>";
};
function dbConnect(){
    $dbConnect=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    if(mysqli_connect_errno($dbConnect)==0){
//        echo "CONNECTION SUCESSFUL!";
//        errDebugger($dbConnect);
        return $dbConnect;

    }ELSE{
        ECHO "FAIL!";
    }
}
dbConnect();
$db=dbConnect();
$qry="
  SELECT 
users.id,
users.name,
COUNT(tuto.id),
(CASE WHEN
    COUNT(tuto.id)<=30
    THEN
    'Amature'
     ELSE
    'GENIUS'
    END)AS teacher_type,
    tv.static_view AS total_turtorials,
    tv.unique_view AS total_turorials
FROM
users
JOIN
turtorials as tuto
ON
users.id=tuto.created_by
JOIN 
  turtorials_view as tv
ON 
  tv.id=tuto.id
WHERE
users.creator=1
GROUP BY tuto.created_by
";
$result=mysqli_query($db,$qry);
foreach($result as $item){
    errDebugger($item);
}
?>