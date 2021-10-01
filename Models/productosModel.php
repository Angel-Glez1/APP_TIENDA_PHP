<?php



class productos
{

    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
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


    public function getCategoria_id()
    {
        return $this->categoria_id;
    }

    public function setCategoria_id($categoria_id)
    {
        $this->categoria_id = $this->conexion->real_escape_string($categoria_id);
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $this->conexion->real_escape_string($nombre);
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $this->conexion->real_escape_string($descripcion);
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($precio)
    {
        $this->precio = $this->conexion->real_escape_string($precio);
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function setStock($stock)
    {
        $this->stock = $this->conexion->real_escape_string($stock);
    }

    public function getOferta()
    {
        return $this->oferta;
    }

    public function setOferta($oferta)
    {
        $this->oferta = $this->conexion->real_escape_string($oferta);
    }


    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $this->conexion->real_escape_string($imagen);
    }


    /*=============================
                CRUD
    ===============================*/
    // Listamos los productos mediante un SELECT 
    public function getALL()
    {
        // Sentencia SQL
        $sql = "SELECT categorias.nombre AS 'NombreDeLaCategoria', productos.* FROM productos INNER JOIN categorias ON categorias.id = productos.categoria_id ORDER BY stock ASC";
        $productos = $this->conexion->query($sql);

        // Retorno el resultado a "productosControlles.php" al metodo "gestion()"
        return $productos;
    }

    public function dameLaCategoriaDe()
    {
        // Sentencia SQL
        $sql = "SELECT categorias.nombre AS 'NombreDeLaCategoria', productos.* FROM productos INNER JOIN categorias ON categorias.id = productos.categoria_id where productos.categoria_id = '{$this->getId()}'";
        $productos = $this->conexion->query($sql);

        return $productos;
        
    }

    // Mostar Productos
    public function getSand()
    {


        $resultado = $this->conexion->query("SELECT * FROM productos ORDER BY RAND()");
        return $resultado;
    }


    // Guardar nuevo fila de producto mediante un INSERT INTO
    public function saveProductos()
    {

        $resultado = false;
        // Insert into ala tabla productos
        $sql = "INSERT INTO productos VALUES(NULL, '{$this->getCategoria_id()}', '{$this->getNombre()}', '{$this->getDescripcion()}', {$this->getPrecio()}, {$this->getStock()}, null, CURDATE() , '{$this->getImagen()}')";
        $resultado = $this->conexion->query($sql);

        // Validar que el INSERT INTO fue exitoso y hacemos un return de un true
        if ($resultado == true) {
            $resultado = true;
            return $resultado;
        }

        return $resultado;
    }


    //Eliminar un producto mediante un DELETE FROM
    public function deleteProducto()
    {

        $resultado = false;

        // Sentencia sql
        $sql = "DELETE FROM productos Where id = {$this->getId()}";
        $query = $this->conexion->query($sql);

        // Validamos que la sentencia sql se ejecute correctamente
        if ($query == true) {

            $resultado = true;
            return $resultado;
        }

        // Retornamos resultado
        return $resultado;
    }

    // Actualizar Productos medienate un SELECT o UPDATE
    public function getOneProducto()
    {
        $sql = "SELECT * FROM productos WHERE id = {$this->getId()}";
        $query = $this->conexion->query($sql);

        if ($query == true) {

            $resultado = $query->fetch_object();
            return $resultado;
        }
    }


    public function update()
    {

        $resultado = false;
        $sql = "UPDATE productos SET categoria_id = '{$this->getCategoria_id()}', nombre = '{$this->getNombre()}', descripcion = '{$this->getDescripcion()}', precio = {$this->getPrecio()}, stock = {$this->getStock()}, imagen = '{$this->getImagen()}' WHERE id = {$this->getId()} ";

        $query = $this->conexion->query($sql);

        if ($query == true) {

            $resultado = true;
            return $resultado;
        }

        return $resultado;
    }
}
