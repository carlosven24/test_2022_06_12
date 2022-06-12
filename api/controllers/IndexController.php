<?php



class IndexController{
    

    public static function getEstado(){
        $estados = new Estados();
        return json_encode($estados->getAll());
    }

    public static function getMunicipio(){
        $municipios = new Municipios();
        return json_encode($municipios->queryByEstados($_GET['estado']));
    }

    public static function createUser(){
        
        try{

       
            
            if($_REQUEST['correo'] == "") throw new Exception('Debe de completar el campo correo.');
            if(!strpos($_REQUEST['correo'], "@")) throw new Exception('El campo correo, debe llevar @.');
            if($_REQUEST['password'] == "") throw new Exception('Debe de completar el campo password.');
            if($_REQUEST['tipo_telefono'] == "") throw new Exception('Debe de completar el campo tipo telefono.');
            if($_REQUEST['telefono'] == "") throw new Exception('Debe de completar el campo telefono.');
            if($_REQUEST['estado'] == "") throw new Exception('Debe de completar el campo estado.');
            if($_REQUEST['municipio'] == "") throw new Exception('Debe de completar el campo municipio.');
            if($_REQUEST['codigo_postal'] == "") throw new Exception('Debe de completar el campo codigo postal.');
            if($_REQUEST['fecha_nacimiento'] == "") throw new Exception('Debe de completar el campo fecha_nacimiento.');

            
            
            $user = new Usuarios();
            $user->correo = $_REQUEST['correo'];
            $user->password = $_REQUEST['password'];
            $user->tipo_telefono = $_REQUEST['tipo_telefono'];
            $user->telefono = $_REQUEST['telefono'];
            $user->estado = $_REQUEST['estado'];
            $user->municipio = $_REQUEST['municipio'];
            $user->codigo_postal = $_REQUEST['codigo_postal'];
            $user->fecha_nacimiento = $_REQUEST['fecha_nacimiento'];
            $user->create();


            return json_encode(["success" => true]);
            
        }catch(Exception $e){
            return json_encode(["error" => $e->getMessage()]);
        }



    }

    public static function listUsers(){
        $users = new Usuarios();
        return json_encode($users->list());
    }

    public static function createFactura(){
        
        try{

            if($_REQUEST['uuid'] == "") throw new Exception('Debe de completar el campo uuid.');
            if($_REQUEST['rfc_emisor'] == "") throw new Exception('Debe de completar el campo rfc emisor.');
            if($_REQUEST['rfc_receptor'] == "") throw new Exception('Debe de completar el campo tipo rfc receptor.');
            if($_REQUEST['monto'] == "") throw new Exception('Debe de completar el campo monto.');


            $factura = new Facturas();
            $factura->uuid = $_POST['uuid'];
            $factura->rfc_emisor = $_POST['rfc_emisor'];
            $factura->rfc_receptor = $_POST['rfc_receptor'];
            $factura->monto = $_POST['monto'];
            $factura->create();

            return json_encode(["success" => true]);
            
        }catch(Exception $e){
            return json_encode(["error" => $e->getMessage()]);
        }

    }

}


?>