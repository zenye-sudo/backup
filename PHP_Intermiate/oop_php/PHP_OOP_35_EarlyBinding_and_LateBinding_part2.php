<?php
class One{
    public static $name="zenye";
    public static function authorName(){
        return self::$name;
    }
    public static function author(){
        echo static::authorName();
    }
}
class Two extends One{
    public static function authorName(){
        return self::$name." and Cracky Shine.";
    }
}
One::author();
echo "<hr>";
Two::author();
