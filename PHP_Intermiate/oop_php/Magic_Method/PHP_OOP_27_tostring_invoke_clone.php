<?php
class PHP_OOP_27_tostring_invoke_clone{
    var $name="zeney";
    public function __toString()    //This function is work when bar tan phoe ma ma shi thaw class ko echo htoe thaw a khar
    {
        return "There are no methods or properties.<br>";
    }
    public function __invoke()     //This function is invoke when called object as method.
    {
        echo "You are trying to call object as method.<br>";
    }
    public function __clone()
    {
      echo "You are cloning me!";
     }
}
$obj=new PHP_OOP_27_tostring_invoke_clone();
echo $obj;
echo $obj();
$clone=clone $obj;    //This is clone(copy) lote tal;
echo $clone->name;