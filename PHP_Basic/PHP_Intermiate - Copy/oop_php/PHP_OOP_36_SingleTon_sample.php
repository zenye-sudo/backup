<?php
class Onee{
    private static $name="zenye";
    private static $instance;
    private function __construct()
    {
        echo self::$name="cracky shine";
    }
    static function invoke(){
        if(self::$instance==NULL){
          self::$instance=new Onee();
        }
        return self::$instance;
    }
    public function name(){
        echo self::$name;
    }
}
$static=Onee::invoke();
echo $static::name();
