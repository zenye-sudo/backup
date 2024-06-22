<?php
interface RuleGame{
    function setWeapon($weapon);
}
class Index implements RuleGame{
    private $weapon;
    function setWeapon($weapon)
    {
        $this->weapon=$weapon;
    }
    function killEnenmy(){
        echo "Killing Eneney with ".$this->weapon;
    }
}
$obj=new Index;
$obj->setWeapon("shotgun");
echo $obj->killEnenmy();
