<?php

class Facturas{

    public $uuid;
    public $rfc_emisor;
    public $rfc_receptor;
    public $monto;


    private $db_connection;
    private $tablename;

    function __construct(){

        $this->tablename = "facturas";
        $database = new DataBase();
        $connection =  $database->mongoDB();
        $this->db_connection = $connection->selectCollection($this->tablename);
    }
    
    public function create(){
    
        $document = [
            "uuid" => $this->uuid,
            "rfc_emisor" => $this->rfc_emisor,
            "rfc_receptor" => $this->rfc_receptor,
            "monto" => $this->monto
        ];

        $this->db_connection->insertOne($document);

    }

}


?>