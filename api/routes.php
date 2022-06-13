<?php

$router = new Router();

$url = explode("?",$_SERVER["REQUEST_URI"]);

//Estado
if(strpos($url[0],"estado"))  $router->get("/estado",IndexController::getEstado());
//Municipio
if(strpos($url[0],"municipio"))  $router->get("/municipio",IndexController::getMunicipio());
//Validacion sat y registro
if(strpos($url[0],"validacion_sat")) $router->get("/validacion_sat",IndexController::createUser());
//lista de usuarios
if(strpos($url[0],"lista_usuarios")) $router->get("/lista_usuarios",IndexController::listUsers());


//Registrar factura
if(strpos($url[0],"registrar_factura")) $router->get("/registrar_factura",IndexController::createFactura());



//get error 404
$router->getError();


?>