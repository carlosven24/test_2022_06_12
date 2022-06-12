<?php

class Router{


    public $is_404 = false;

    public function get($url_manage,$controller){
        $url = explode("?",$_SERVER["REQUEST_URI"]);

        if($url[0] == $url_manage){ 
            print_r($controller); 
            $this->is_404 = true; 
        }
    }


    public function getError(){
        if(!$this->is_404) echo "Error 404: El archivo solicitado no existe.";
    }


}


?>