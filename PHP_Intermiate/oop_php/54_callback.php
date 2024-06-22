<?php
//class One{
//    public function origanl($finis){
//        $num=0;
//        $i=0;
//        while($i<10000){
//            $num+=$i;
//            $i++;
//        }
//
//     $this->$finis($num); //This pattenn is special form
////        OR
//        $this->finish($num);
//    }
//    public function finish($total){
//        echo "The total is ".$total."<br>";
//    }
//}
//$obj=new One();
//$obj->origanl("finish");

class Two{
    function original($para1){
//       $this->callback1(3434);
       echo "<br>";
       /////OR/////
        $this->$para1(2332);
    }
    function callback1($total){
        echo "The total is ".$total;
    }
    function callback2($total){
        echo "My name is ".$total;
    }
}
//$obj=new Two();
//$obj->original("callback1");

$obj2=new Two();
$obj2->original("callback2");