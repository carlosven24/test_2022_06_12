<?php


header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}



require 'vendor/autoload.php';

foreach (glob("config/*.php") as $filename)
{
    include $filename;
}

foreach (glob("controllers/*.php") as $filename)
{
    include $filename;
}

foreach (glob("models/*.php") as $filename)
{
    include $filename;
}

require 'routes.php';







?>