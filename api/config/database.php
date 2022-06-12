<?php

class DataBase{

    public $namedb = "prueba";
    public $host = "127.0.0.1";
    //private static $user = "root";
    //private static $pwd = "root";


    public function mongoDB(){

        $mongo = new MongoDB\Client("mongodb://$this->host:27017/$this->namedb");
        $db = $this->namedb;
        return $mongo->$db;
    
    }


}


?>