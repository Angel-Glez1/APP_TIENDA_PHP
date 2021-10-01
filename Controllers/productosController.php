<?php

require_once 'Models/productosModel.php';

class productosController
{
    // Pagina principal
    public function index()
    {
        $showProdcutos = new productos();
        $productos = $showProdcutos->getSand();


        require_once 'Views/Productos/central.php';
    }


    // Ver la informacion de un producto en expecifico
    public function ver()
    {
        // Utils::isAdmi();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $verProducto = new productos();
            $verProducto->setId($id);
            $producto = $verProducto->getOneProducto();

            require_once 'Views/Productos/ver.php';
        }
    }
    // Gestina los produsduc
    public function gestion()
    {
        Utils::isAdmi();
        $productos = new productos();
        $producto = $productos->getALL();

        // Muestro CRUD 
        require_once 'Views/Productos/gestion.php';
    }

    // Vista para dar de alta un nuevo producto
    public function crear()
    {
        Utils::isAdmi();
        require 'Views/Productos/crear.php';
    }


    public function save()
    {
        Utils::isAdmi();
        if (isset($_POST)) {

            // Validar si los datos son de un cierto tipo de n¿dato que no esten vacion y limpiamos espacion que no se ocupan
            $nombre = Utils::validarString($_POST['nombre']) ? trim($_POST['nombre']) : false;
            $desc = Utils::validarString($_POST['descripcion']) ? trim($_POST['descripcion']) : false;
            $precio = Utils::validarInt($_POST['precio']) ? trim($_POST['precio']) : false;
            $stock = Utils::validarInt($_POST['stock']) ? trim($_POST['stock']) : false;
            $categoria = trim($_POST['categoria_id']);



            // Si los datos cumplieron las validaciones correspondientes llamamos al modelo y hace el saveProductos()
            if ($nombre == true && $desc == true && $precio == true && $stock == true && $categoria == true) {
                $newProducto = new productos();
                $newProducto->setCategoria_id($categoria);
                $newProducto->setNombre($nombre);
                $newProducto->setDescripcion($desc);
                $newProducto->setPrecio($precio);
                $newProducto->setStock($stock);

                // Guardar imagen
                $file = $_FILES['imagen'];
                $name_img = $file['name'];
                $type_img = $file['type'];
                // $size_img = $file['size'];

                if ($type_img == 'image/jpg' || $type_img == 'image/jpeg' || $type_img == 'image/png' || $type_img == 'image/gif') {

                    if (!is_dir('uploads/imagen')) {
                        mkdir('uploads/imagen', 0777, true);
                    }

                    move_uploaded_file($file['tmp_name'], 'uploads/imagen' . $name_img);
                    $newProducto->setImagen($name_img);
                }
                // Si exite el metedo get es por que va a actualizar los datos del producto

                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $newProducto->setId($id);
                    $resultado = $newProducto->update();

                    if ($resultado == true) {
                        $_SESSION['actualizar'] = "Exito";
                        // header("location:" . URL_BASE . "productos/gestion");
                    }
                } else {

                    $resultado = $newProducto->saveProductos();

                    // Comprobamos que el insert fuera exitosa 
                    if ($resultado == true) {

                        $_SESSION['producto'] = "Exito";
                        // header("location:" . URL_BASE . "productos/gestion");
                    } else {

                        $_SESION['productos'] = "Error";
                        // header("location:" . URL_BASE . "productos/gestion");
                    }
                }
            } else {

                $_SESSION['producto'] = "Error datos";
                header("location:" . URL_BASE . "productos/crear");
            }
        }
        header("location:" . URL_BASE . "productos/gestion");
    }


    // Eliminar un producto
    public function delete()
    {
        Utils::isAdmi();

        if (isset($_GET['id'])) {

            var_dump($_GET);

            $id = $_GET['id'];
            $deleteProducto = new productos();
            $deleteProducto->setId($id);
            $resultado = $deleteProducto->deleteProducto();

            if ($resultado == true) {
                $_SESSION['delete'] = 'exito';
                header('location:' . URL_BASE . 'productos/gestion');
            } else {
                $_SESSION['delete'] = 'error';
            }
        }
    }

    // Vista para actualizar
    public function actualizar()
    {
        Utils::isAdmi();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $updateProducto = new productos();

            $actualizar = true;
            $updateProducto->setId($id);
            $producto = $updateProducto->getOneProducto();
            require_once 'Views/Productos/crear.php';
        }
    }
}
