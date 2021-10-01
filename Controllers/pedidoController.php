<?php

require_once 'Models/pedidoModel.php';



class pedidoController
{

    public function hacer()
    {

        require_once 'Views/Pedidos/pedidos.php';
    }

    // Guardar nuevo pedido
    public function add()
    {
        if (isset($_SESSION['user'])) {

            $provincia = isset($_POST['provincia']) ? trim($_POST['provincia']) : false;
            $ciudad    = isset($_POST['ciudad']) ? trim($_POST['ciudad']) : false;
            $direccion = isset($_POST['direccion']) ? trim($_POST['direccion']) : false;
            $usuario_id  = $_SESSION['user'];
            $usuario = $usuario_id->id;

            $status = Utils::statusCarrito();
            $coste = $status['total'];

            if ($provincia && $ciudad && $direccion) {
                $obj = new pedido();
                $obj->setUsuario_id($usuario);
                $obj->setProvincia($provincia);
                $obj->setLocalidad($ciudad);
                $obj->setDireccion($direccion);
                $obj->setCoste($coste);
                $newPedido = $obj->savePedido();

                // Guuadar el pedido en la tabla peibote
                $newpedidoliena = $obj->save_line();

                if ($newPedido  && $newpedidoliena) {

                    $_SESSION['pedido'] = 'ok';
                } else {


                    $_SESSION['pedido'] = 'not';
                }

                header("location:" . URL_BASE . "pedido/confrimar");
            }
        } else {
            header("location:" . URL_BASE);
        }
    }

    // Mostar informacion sobre el pedido del un usuario en especifico
    public function confrimar()
    {

        if (isset($_SESSION['user'])) {

            $usuario_id = $_SESSION['user']->id;
            $obj = new pedido();
            $obj->setUsuario_id($usuario_id);
            $info_pedido = $obj->getOneByUser();

            $obj2 = new pedido();
            $verProductos  = $obj2->getProductoByUser($info_pedido->id);


            require_once 'Views/Pedidos/confirmado.php';
        } else {
            header("location:" . URL_BASE);
        }
    }

    // ver listado de los pedidos de un usurio 
    public function mis_pedidos()
    {

        Utils::isUser();
        $userId = $_SESSION['user']->id;
        $obj = new pedido();
        $obj->setUsuario_id($userId);
        $verpedidos = $obj->getAllPedidosbyUser();

        require_once 'Views/Pedidos/mis_pedidos.php';
    }

    // Ver a detalle un pedido que haya hecho un usuario
    public function detalle()
    {
        Utils::isUser();
        if (isset($_GET['id'])) {
            $id_pedido = $_GET['id'];
            
            // Sacamos la informacion del pedido
                $usuario_id = $_SESSION['user']->id;
                $obj = new pedido();
                $obj->setId($id_pedido);
                $desc_pedido = $obj->getOnePedidoUser();

            // Sacamos los productos que compro en ese pedido
                $obj2 = new pedido();
                $verProductos  = $obj2->getProductoByUser($id_pedido);
                require_once 'Views/Pedidos/detalle.php';
            
        }
    }

    //Mostar al abmistrador todos los pedidos que se han hecho
    public function gestion(){

        Utils::isAdmi();

        $is_admi = true;
        $obj = new pedido();
        $verpedidos = $obj->getAllpedidos();

        require_once 'Views/Pedidos/todos-los-pedidos.php';


        // header('location:' . URL_BASE . 'pedido/gestion');
    } 


    public function estado(){
        Utils::isAdmi();
        if(isset($_POST)){
            // Recogo datos del form
            $id = $_POST['pedido_id'];
            $estado = $_POST['estado'];

            // llamo al metodo de actulizacion de estado
            $obj = new pedido();
            $obj->setId($id);
            $obj->setEstado($estado);
            $actualizar = $obj->updateEstado();

           header('location:'.URL_BASE.'pedido/gestion&id=' .$id);

        }


    }

}
