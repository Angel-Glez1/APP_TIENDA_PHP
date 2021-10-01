<?php
// Cargamos autoload & la maquetacion de la web & tambien nuestras Constantes del archivo Conf & y mi base de datos 
require_once 'autoload.php';
require_once 'Config/db.php';
require_once 'Helpers/Utils.php';
require_once 'Config/parametros.php';
require_once 'Views/layout/header.php';
require_once 'Views/layout/sidebar.php';

$conexion = conexion::database();

function errores()
{
    $error = new errorController();
    $error->error();
}


// Compruebo que me llegue el controlador por la url Y lo guardo en una variable para instanciarlo despues
if (isset($_GET['controlador'])) {

    $controlador = $_GET['controlador'] . 'Controller';

    // Si no existe en la url un controlador le asignamos uno por defecto para que nos muestre siempre el inicio usuando nuestras constantes de nuestro archivo config
} elseif (!isset($_GET['controlador']) && !isset($_GET['metodo'])) {

    $controlador = CONTROLADOR_BASE;

} else {
    errores();
    exit();
}


// Compruebo si existe la clase y si existe instancio un objeto RECUERDA que la varible $controlador es la que resivimos en la primera validacion
if (class_exists($controlador)) {
    $obj = new $controlador();

    // Compruebo si exite el metodo que el usuario esta buscando 
    if (isset($_GET['metodo']) && method_exists($obj, $_GET['metodo'])) {

        $metodo = $_GET['metodo'];
        $obj->$metodo();

        //Si no existe algun metodo le asignamos uno por defecto 
    } elseif (!isset($_GET['metodo'])) {

        $metodo_default = METODO_BASE;
        $obj->$metodo_default();

    } else {

        errores();
    }
} else {
    errores();
}

// fotter
require_once 'Views/layout/fotter.php';
