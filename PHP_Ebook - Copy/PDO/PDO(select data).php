<?php
class Index{
    public function __construct()
    {
        $db=new PDO("mysql:host=localhost;dbname=store","root","");
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        if($db){
            try{
                $qry="SELECT * FROM items";
                $result=$db->prepare($qry);
                $result->execute();
                $result->setFetchMode(PDO::FETCH_ASSOC);
                foreach($result->fetchAll() as $item){
                    foreach($item as $key=>$value){
                        echo "Key is ".$key." and value is ".$value."<br>";
                    }
                    echo "<hr>";
                }
            }catch(Exception $e){

            }
        }
    }
}
$obj=new Index();
?>

