<?php
//require_once 'model/database.php';
//require_once 'core/class.superlog.php';

$controller = 'main';

// Todo esta lógica hara el papel de un FrontController
if(!isset($_REQUEST['c']))
{
    require_once "controller/{$controller}.controller.php";
    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;
    $controller->Index();
}
else
{
    // Obtenemos el controlador que queremos cargar
    $controller = strtolower($_REQUEST['c']);
    $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'index';

    // Instanciamos el controlador
    require_once "controller/{$controller}.controller.php";

    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;
    
    // Llama la accion
    $arr = array( $controller, $accion );

    call_user_func( $arr );
}