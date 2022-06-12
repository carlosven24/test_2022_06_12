<?php

class Usuarios{

    public $correo;
    public $password;
    public $tipo_telefono;
    public $telefono;
    public $estado;
    public $municipio;
    public $codigo_postal;
    public $fecha_nacimiento;
    
    private $db_connection;
    private $tablename;

    function __construct(){

        $this->tablename = "usuarios";
        $database = new DataBase();
        $connection =  $database->mongoDB();
        $this->db_connection = $connection->selectCollection($this->tablename);
    }

    
    public function create(){
      
        $document = [
            "correo" => $this->correo,
            "password" => password_hash($this->password,PASSWORD_DEFAULT),
            "tipo_telefono" => $this->tipo_telefono,
            "telefono" => $this->telefono,
            "estado" => $this->estado,
            "municipio" => $this->municipio,
            "codigo_postal" => $this->codigo_postal,
            "fecha_nacimiento" => new MongoDB\BSON\UTCDateTime(strtotime($this->fecha_nacimiento) * 1000)
        ];

        $this->db_connection->insertOne($document);
    }

    public function list($filtros = []){
        

        $correo = new MongoDB\BSON\Regex('^'. $_GET['correo']);
        $telefono = new MongoDB\BSON\Regex('^'. $_GET['telefono']);



        //FILTROS
        $filtros['correo'] = $correo;
        $filtros['telefono'] = $telefono;

        if($_GET['fecha_desde'] != "" && $_GET['fecha_hasta'] != "")
            $filtros['fecha_nacimiento'] = array('$gt' => new MongoDB\BSON\UTCDateTime(strtotime($_GET['fecha_desde']) * 1000), '$lte' => new MongoDB\BSON\UTCDateTime(strtotime($_GET['fecha_hasta']) * 1000));
        //END FILTROS
 



        $response = $this->db_connection->find($filtros);

        $array = [];
        foreach ( $response as $n)
        {
            $fecha = $n->fecha_nacimiento;
            $datetime = $fecha->toDateTime();
            $n->fecha_nacimiento = $datetime->format('Y-m-d');

            array_push($array,$n);
        }

        return $array;
    }


}


?>