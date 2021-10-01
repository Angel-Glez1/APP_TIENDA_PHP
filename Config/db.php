<?php 
// namespace Conexion;

class conexion {


    public static function database(){

        $conexion = new mysqli('localhost','root','','tienda_master');
        $conexion->set_charset("SET NAMES 'UTF8'");
        return $conexion;
    }
}

session_start();



?>