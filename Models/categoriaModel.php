<?php 

class categoria{

    private $id;
    private $nombre;
    private $conexion;


    public function __construct()
    {
        $this->conexion = conexion::database();
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }



    public function setNombre($nombre){

        $this->nombre = $this->conexion->real_escape_string($nombre);

    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getAll(){

        $categorias = $this->conexion->query("SELECT * FROM categorias ORDER BY id DESC");
        return $categorias;
    }

    public function getOne(){

    $resultado = $this->conexion->query("SELECT * FROM categorias WHERE id = '{$this->getId()}'"); 
    return $resultado->fetch_object();
    }


    public function saveCategoria(){

        $_resultado = false;
        $sql = "INSERT INTO categorias(nombre)VALUES('{$this->getNombre()}')";
        $insert = $this->conexion->query($sql);
        if($insert == true){

            $_resultado = $insert;

        }

        return $_resultado;
    }
    
}




?>