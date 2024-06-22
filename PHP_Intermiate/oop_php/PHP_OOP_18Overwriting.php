<?php
class One{
    public $name="zenye";
    public function member(){
        echo "I am member class.";
    }
    public function doIt()
    {
        echo "I am doing it.";
    }
}
class Two extends One{
    public function doIt(){
        echo "Doit overwrite Change";
    }
}
$obj=new Two();
echo $obj->member();
echo "<br>";
echo $obj->doIt();
