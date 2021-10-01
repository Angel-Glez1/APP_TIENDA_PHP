<?php

require_once 'Models/categoriaModel.php';
require_once 'Models/productosModel.php';


class categoriaController
{

    public function index()
    {
        Utils::isAdmi();
        $categoria = new categoria();
        $result = $categoria->getAll();

        // Vista para crear nuevas categorias
        require_once 'Views/categoria/index.php';
    }

    public function ver(){

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $categoria = new categoria();
            $categoria->setId($id);
            $resultado = $categoria->getOne(); 


            $productos = new productos();
            $productos->setId($id);
            $pro = $productos->dameLaCategoriaDe();
          
        }

        require_once 'Views/categoria/ver.php';

    }

    public function crear()
    {
        Utils::isAdmi();
        require 'Views/categoria/crear.php';
    }

    public function save()
    {
        Utils::isAdmi();
        if(isset($_POST)){
            $nombre = !empty($_POST['nombre']) ?  $_POST['nombre'] : false;
            $newCategoria = new categoria();
            $newCategoria->setNombre($nombre);
            $resultado = $newCategoria->saveCategoria();
            if($resultado == true){

                header("location:".URL_BASE."categoria/index");

            }

        }else{
           header("location:" . URL_BASE . "categoria/crear");
        }
    }
}
