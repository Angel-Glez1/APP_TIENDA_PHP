<?php

class Usuario{

    private $id;
    private $nombre;
    private $apellido;
    private $email;
    private $password;
    private $rol; 
    private $imagen;
    private $conexion;

    public function __construct()
    {
        $this->conexion = conexion::database();
    } 

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $this->conexion->real_escape_string($nombre);
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $this->conexion->real_escape_string($apellido);
    }

    public function getEmail()
    {
        return $this->email;
        
    }

    public function setEmail($email)
    {
        $this->email = $email ;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = password_hash($this->conexion->real_escape_string($password), PASSWORD_BCRYPT, ['const' => 4] );
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    // Registro de nuevos usuarios
    public function save(){
        // Cremos senticia sql para insertar un nuevo usurio 
        $resultado = false;
        $sql = "INSERT INTO usuarios VALUES (null,'{$this->getNombre()}', '{$this->getApellido()},', '{$this->getEmail()}', '{$this->getPassword()}','usuario', null)";
        
        // Guardamos la query 
        $registro = $this->conexion->query($sql);
        
        if($registro == true ){
            // Validamos que el 'insert into' fuera exitoso y recuperamos el id de ese usuario para si poder transformas sus datos en objeto 
            $id = $this->conexion->insert_id;
            $n_usurio = $this->conexion->query("SELECT * FROM usuarios WHERE id = '$id'");
            $resultado = $n_usurio->fetch_object();
        }
        return $resultado;
    }

    //login de usuarios 
    public function login($email,$paswword){

        $resultado = false;
        // Verificar si exite el email
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $login = $this->conexion->query($sql);

        // Verifico que si se encontrar conhicidencias con el email y verifico que la password se la misma que esta en la base de datos
        if($login && $login->num_rows == 1){
            // Convierto mi resultado en un objeto 
            $usuario = $login->fetch_object();
            $verificicado = password_verify($paswword, $usuario->password);
                
            if($verificicado){

                $resultado = $usuario;
            }
        }
        return $resultado;
    }   
}




?>