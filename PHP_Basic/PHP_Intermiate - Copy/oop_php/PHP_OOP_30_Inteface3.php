<?php
interface heEnter{
    function heGoToSchool($data);
}
interface sheEnter{
    function sheGoToSchool($data);
}
class Index implements heEnter,sheEnter{
    public  $data;
    function heGoToSchool($data)
    {
     $this->data=$data;
    }
    function busy(){
        echo "<pre>".print_r($this->data,true)."</pre>";
        echo "This person is busy with ".$this->data[count($this->data)-1]."<hr>";
    }
    function sheGoToSchool($data)
    {
       $this->data=$data;
    }
}
$obj1=new Index;
$ary1=['pen','bag','rubber'];
$obj1->heGoToSchool($ary1);
echo $obj1->busy();

$obj2=new Index;
$ary2=['pen','bag','comsmatic'];
$obj2->sheGoToSchool($ary2);
echo $obj2->busy();
