<?php

require_once 'Models/productosModel.php';

class carritoController
{
    // Nos manda ala vista del carrito que tenemos 
    public function index()
    {

        if (isset($_SESSION['carrito'])) {
            $carrito = $_SESSION['carrito'];
        }
        require_once 'Views/carrito/vercarrito.php';
    }

    // Toda la logica del carrito
    public function add()
    {
        //Si el usuario ya agregro porductos al carrito
        if (isset($_SESSION['carrito'])) {
            if (isset($_GET['id'])) {

                $array = $_SESSION['carrito'];
                $encontro = false;
                $numero = 0;
                // Si ya exite un producto le aumentamos ++ a cntidad
                for ($i = 0; $i < count($array); $i++) {
                    if ($array[$i]['producto_id'] == $_GET['id']) {
                        $encontro = true;
                        $numero = $i;
                    }
                }
                if ($encontro == true) {
                    $array[$numero]['cantidad']++;
                    $_SESSION['carrito'] = $array;
                } else {

                    $obj = new productos();
                    $obj->setId($_GET['id']);
                    $newCarrito = $obj->getOneProducto();

                    $arrayCarrito = array(
                        'nombre' => $newCarrito->nombre,
                        'producto_id' => $newCarrito->id,
                        'precio' => $newCarrito->precio,
                        'cantidad' => 1,
                        'imagen' => $newCarrito->imagen

                    );

                    array_push($array, $arrayCarrito);
                    $_SESSION['carrito'] = $array;
                }
            }
        } else {
            // Si no se a agregado algo al carrito
            if (isset($_GET['id'])) {
                // Traigo de la base de datos el producto que agrego al carrito
                $obj = new productos();
                $obj->setId($_GET['id']);
                $newCarrito = $obj->getOneProducto();

                // Creo una matriz con los datos del producto y lo guardo en la session['carrito]
                $arrayCarrito[] = array(
                    'nombre' => $newCarrito->nombre,
                    'producto_id' => $newCarrito->id,
                    'precio' => $newCarrito->precio,
                    'cantidad' => 1,
                    'imagen' => $newCarrito->imagen

                );


                $_SESSION['carrito'] = $arrayCarrito;
            }
        }

        header('location:' . URL_BASE . 'carrito/index');
    }


    // Elimina todo el carrito
    public function deleteCarrito()
    {

        unset($_SESSION['carrito']);
        header('location:' . URL_BASE . 'carrito/index');
    }


    //Eliminar un producto en especifico del carrito
    public function remove()
    {
        if (isset($_GET['id'])) {

            $id = $_GET['id'];
            $borrdo = false;
            $indice = 0;

            // Estraigo en array para poder usarlo con mas facilidad

            $array = $_SESSION['carrito'];
            for ($i = 0; $i < count($array); $i++) {
                // con el ciclo for recoro mi array y busco si exite ese producto en mi carrito
                if ($array[$i]['producto_id'] == $id) {
                    $indice = $i;
                    $borrdo = true;
                }
            }
            // Si llego a esta parte si encontro el valor el articulo en nuestro carrtio
            if ($borrdo == true) {

                unset($array[$indice]);
                $arrays = array_values($array);
                $_SESSION['carrito'] = $arrays;
                header('location:' . URL_BASE . 'carrito/index');
            }


            // echo '<pre>';
            // print_r($_SESSION['carrito']);
            // echo '</pre>';


        }
    }

    // Aumentar o disminuir unidades desde la vista del carrito
    public function decremento()
    {
        if (isset($_GET['menos'])) {
            $mas = $_GET['menos'];
            $indice = 0;
            $incremento = false;
            $cantidad = $_SESSION['carrito'];
            for ($i = 0; $i < count($cantidad); $i++) {
                if ($cantidad[$i]['producto_id'] == $mas) {
                    $cantidad[$i]['cantidad']--;
                    $_SESSION['carrito'] = $cantidad;
                    header('location:' . URL_BASE . 'carrito/index');

                }

                if($cantidad[$i]['cantidad'] == 0 ){

                    header("Location:".URL_BASE."carrito/remove&id=".$cantidad[$i]['producto_id']);

                }
            }


        }

        // echo '<pre>';
        // print_r($_SESSION['carrito']);
        // echo '</pre>';
    }


    // Aunmenta des de la vista de carrito
    public function incremento()
    {
        if (isset($_GET['mas'])) {
            $mas = $_GET['mas'];
            $indice = 0;
            $incremento = false;
            $cantidad = $_SESSION['carrito'];
            for ($i = 0; $i < count($cantidad); $i++) {
                if ($cantidad[$i]['producto_id'] == $mas) {
                    $cantidad[$i]['cantidad']++;
                    $_SESSION['carrito'] = $cantidad;
                    header('location:' . URL_BASE . 'carrito/index');

                }
            }
        }

        echo '<pre>';
        print_r($_SESSION['carrito']);
        echo '</pre>';
    }


}
