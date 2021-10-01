<!-- Barra Lateal -->



<aside id="aside">
    <div id="carrito" class="bloc_aside">
        <h3>Status carrito</h3>
        <ul>
            <?php $status = Utils::statusCarrito(); ?>
            <li><a href="<?= URL_BASE ?>carrito/index">Productos (<?= $status['count'] ?>) </a></li>
            <li><a href="<?= URL_BASE ?>carrito/index">Total a pagar(<?= $status['total'] ?>) </a></li>
            <li><a href="<?= URL_BASE ?>carrito/index">Ver carrito</a></li>

        </ul>
    </div>




    <div id="login" class="block_aside">

        <?php if (!isset($_SESSION['user'])) : ?>

            <h3 class="texto">Empiza a comprar</h3>
            <form action="<?= URL_BASE ?>usuario/login" method="POST">
                <input type="text" name="email" placeholder="Ingresa tu email">
                <input type="text" name="password" placeholder="Ingresa tu password">
                <input type="submit" value="Iniciar Sesion">
            </form>
            <a class="boton" href="<?= URL_BASE ?>usuario/registro">Registrate</a>

        <?php else : ?>
            <h3>Bienvenido <?= $_SESSION['user']->nombre ?></h3>
        <?php endif; ?>
        <ul>
            <?php if (isset($_SESSION['admi'])) : ?>
                <li><a href="<?= URL_BASE ?>categoria/index">Gestionar categorias</a></li>
                <li><a href="<?= URL_BASE ?>productos/gestion">Gestionar Productos</a></li>
                <li><a href="<?= URL_BASE ?>pedido/gestion">Gestionar pedidos</a></li>


            <?php endif; ?>
            <?php if (isset($_SESSION['user'])) : ?>
                <li><a href="<?= URL_BASE?>pedido/mis_pedidos">Mis pedidos</a></li>
                <li><a href="<?= URL_BASE ?>usuario/cerrar">Cerrar sesion</a></li>
            <?php endif; ?>
        </ul>
    </div>
</aside>
<!-- Contedido central -->
<div id="central">