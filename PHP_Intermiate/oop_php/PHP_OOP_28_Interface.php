<?php
interface  gamerule{      //rule=>Body must not have in the interface.
    function createScene();
    function createTree();
    function createAll();
}
class developer implements gamerule{
    function createScene()
    {
      echo "Hello";
    }
    function createAll()
    {
     echo "World";
    }
    function createTree()
    {
        echo "Zenye";
    }
}