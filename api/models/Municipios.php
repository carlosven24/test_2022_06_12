<?php

class Municipios{

    public $data = [ 
        "Caracas" => ["Libertador","Sucre"],
        "Miranda" => ["Baruta","Zamora"]
    ];


    public function queryByEstados($estados){
        
        return array_key_exists($estados,$this->data) ? $this->data[$estados] : ["No hay registros"];
    }


}



?>