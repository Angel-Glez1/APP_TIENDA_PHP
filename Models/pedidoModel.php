<?php 

require_once 'Config/db.php';

class pedido{
    
    
    private $id; 	
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado; 	
    private $fecha;
    private $hora;
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

    public function getUsuario_id()
    {
        return $this->usuario_id;
    }

    public function setUsuario_id($usuario_id)
    {
        $this->usuario_id = $usuario_id;
    }

    public function getProvincia()
    {
        return $this->provincia;
    }

    public function setProvincia($provincia)
    {
        $this->provincia = $this->conexion->real_escape_string($provincia);
    }

    public function getLocalidad()
    {
        return $this->localidad;
    }

    public function setLocalidad($localidad)
    {
        $this->localidad = $this->conexion->real_escape_string($localidad);
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $this->conexion->real_escape_string($direccion);
    }

    public function getCoste()
    {
        return $this->coste;
    }

    public function setCoste($coste)
    {
        $this->coste = $coste;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getHora()
    {
        return $this->hora;
    }

    public function setHora($hora)
    {
        $this->hora = $hora;
    }

    // Guardar el pedido en la base de datos
    public function savePedido(){

        $save = false;

        $sql = "INSERT INTO pedidos VALUES (NULL,'{$this->getUsuario_id()}','{$this->getProvincia()}', '{$this->getLocalidad()}', '{$this->getDireccion()}', {$this->getCoste()}, 'confirm', CURDATE(), CURTIME())";
        $query = $this->conexion->query($sql);

        if($query == true){
            
            $id = $this->conexion->insert_id;
            $this->setId($id);
             $save = true;
        }
        
        return $save;
    
    }

    // Guardar en la base de datos lineapedidos
    public function save_line(){

        foreach($_SESSION['carrito'] as $key ){
            
            $insert = "INSERT INTO lineapedidos VALUES (NULL, '{$this->getId()}','{$key['producto_id']}','{$key['cantidad']}')";
            $save = $this->conexion->query($insert);
        
        }    
        $result = false;
        if($save == true){
            $result = true;
        }

        return $result;
    }

    // Conseguir la informacion del pedido de un cierto usurio
    public function getOneByUser(){

        $sql = "SELECT * FROM pedidos WHERE usuario_id = {$this->getUsuario_id()} ORDER BY id DESC LIMIT 1";
        $select = $this->conexion->query($sql);

        $resultado = $select->fetch_object();
        
        return $resultado;
    }

    // Consegir los producto del pedido del usurio
    public function getProductoByUser($pedido_id){

        $sql = "SELECT productos.*, lineapedidos.unidades FROM productos
        INNER JOIN lineapedidos ON lineapedidos.producto_id = productos.id WHERE lineapedidos.pedido_id = {$pedido_id}";
        $select = $this->conexion->query($sql);
        // $resultado = $select;

        // echo $sql;
        // echo $this->conexion->error;
        // die();
        return $select;
    }

    // Conseguir todos los pedidos que tenga un usuario
    public function getAllPedidosbyUser(){

        $sql = "SELECT * FROM pedidos WHERE usuario_id = {$this->getUsuario_id()} ORDER BY id DESC";
        $select = $this->conexion->query($sql);

        return $select;

    }

    // Conseguir la informacion de un pedido que hizo un usuario
    public function getOnePedidoUser(){

        $select = $this->conexion->query("SELECT * FROM pedidos WHERE id = {$this->getId()}");
        return $select->fetch_object();
    }

    // Conseguir todos los pedidos que se Hayan hecho mostrar se los al administrador
    public function getAllpedidos(){

        $select = $this->conexion->query("SELECT * FROM pedidos");
        return $select;

    }

    // Actualizar el estado de un pededido
    public function updateEstado(){

        $sql = "UPDATE pedidos SET estado = '{$this->getEstado()}' WHERE id = {$this->getId()}";
        $update = $this->conexion->query($sql);

        return $update;
    }
}
