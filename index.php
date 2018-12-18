<?php
//require_once 'model/database.php';
require_once 'core/superlog.class.php';

$controller = 'main';

// Toda esta lógica hara el papel de un FrontController
if(!isset($_REQUEST['c']))
{
    require_once "controller/{$controller}.controller.php";
    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;
    $controller->Index();
}
else
{

    try{
        // Obtenemos el controlador que queremos cargar
        $controller = strtolower($_REQUEST['c']);
        $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'index';

        // Instanciamos el controlador
        if(!file_exists("controller/{$controller}.controller.php")) {
            throw new Exception("No existe controller/{$controller}.controller.php.");
        }else{
            require_once "controller/{$controller}.controller.php";
        }

        $controller = ucwords($controller) . 'Controller';
        if(!class_exists($controller)){
            throw new Exception("No existe la clase {$controller} en controller/{$_REQUEST['c']}.controller.php.");
        }else{
            $controller = new $controller;
        }

        if(!method_exists($controller, $accion)){
            throw new Exception("No existe el método {$accion} en la clase {$_REQUEST['c']}");
        }else{
            $controller->{$accion}();
    //        call_user_func(array($controller, $accion));
        }

    }catch (Exception $e){
        Superlog::log($e->getMessage());
        header('location: 404.html');
    }

    // Obtenemos el controlador que queremos cargar
    $controller = strtolower($_REQUEST['c']);
    $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'index';

    // Instanciamos el controlador
    require_once "controller/{$controller}.controller.php";

    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;


    if(!method_exists($controller, $accion)){
        Superlog::log("No existe el método {$accion} en la clase {$_REQUEST['c']}");
        header('location: 404.html');
    }else{
        $controller->{$accion}();
//        call_user_func(array($controller, $accion));
    }
    exit;
}