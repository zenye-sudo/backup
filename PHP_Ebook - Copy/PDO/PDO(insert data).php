<?php
class InsertDatas{
    public function __construct()
    {
        $db=new PDO("mysql:host=localhost;dbname=store","root","");
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        try{
            $qry="INSERT INTO items(id,name,cost,seller_id,bids) VALUES (13232,'sdlf',343,34,34)";
            $db->exec($qry);
            echo "Insert Successful!";
        }catch(Exception $e){
            echo "Insert Datas Fail!<br>".$e;
        }
    }
}
$obj=new InsertDatas();
