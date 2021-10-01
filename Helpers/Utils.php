<?php

class Utils
{

    // Funciones para borrar sesiones que muestran muestras string
    public static function deleteSession($nombre)
    {

        if (isset($_SESSION[$nombre])) {
            $_SESSION[$nombre] = null;
            unset($_SESSION[$nombre]);
        }
        return $nombre;
    }

    // Verifica si un usuario tiene rol de administrador
    public static function isAdmi()
    {
        if (!isset($_SESSION['admi'])) {
            header("location:" . URL_BASE);
        } else {
            return true;
        }
    }

    // Validar si existe la session['user']
    public static function isUser()
    {
        if (!isset($_SESSION['user'])) {
            header("location:" . URL_BASE);
        } else {
            return true;
        }
    }


    // Mostar todas las categorias en el menu
    public static function showCategorias()
    {

        require_once 'Models/categoriaModel.php';
        $obj = new categoria();
        $categorias = $obj->getAll();

        return $categorias;
    }


    // Validar strings de fromularios
    public static function validarString(string $string)
    {

        $ex = "/[0-9]/";
        if (!empty($string) && !is_numeric($string) && !preg_match($ex, $string)) {
            return true;
        } else {
            return false;
        }
    }


    // Validar int de fromularios
    public static function validarInt(int $int)
    {

        $ex = "/[a-z]/i";
        if (!empty($int) && !is_string($int) && !preg_match($ex, $int)) {
            return true;
        } else {
            return false;
        }
    }



    // Saber estutus del carrito
    public static function statusCarrito()
    {

        $statusCarrito = array('count' => 0, 'total' => 0);

        if (isset($_SESSION['carrito'])) {

            $statusCarrito['count'] = count($_SESSION['carrito']);

            foreach ($_SESSION['carrito'] as $key) {

                $statusCarrito['total'] += $key['cantidad'] * $key['precio'];
            }
        }

        return $statusCarrito;
    }

    // cambiar el estado en el que se encuentre el pedido
    public static function showStatus($status)
    {

        $value = 'Pendiente';

        if ($status == 'confirm') {

            $value = 'Pendiente';

        } elseif ($status == 'preparation') {

            $value = 'En preparacion';

        } elseif ($status == 'ready') {

            $value = 'Preparado para enviar';

        } elseif ($status == 'sended') {

            $value = 'Enviado';
        }

        return $value;
    }
}
