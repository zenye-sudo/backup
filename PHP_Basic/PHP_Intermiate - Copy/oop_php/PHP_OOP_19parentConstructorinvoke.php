<?php
class One{
    var $name="zenye";
   public function __construct()
   {
       echo "I am parent Constructor";
   }
}
class Two extends One{
    public  function __construct()
    {
        parent::__construct();
        echo "I am child Constructor.";
    }
}
$obj=new Two();