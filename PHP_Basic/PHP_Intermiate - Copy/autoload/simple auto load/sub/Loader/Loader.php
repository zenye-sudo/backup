<?php
class Load{
     static function Loader($name)
    {
     require_once $name . ".php";
    }

}