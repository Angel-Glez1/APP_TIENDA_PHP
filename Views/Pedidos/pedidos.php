<?php if (isset($_SESSION['user'])) : ?>
    <h1>Hacer pedido</h1>
    <a href="<?= URL_BASE ?>carrito/index">Ver mi pedido</a>
    <h3>Direccion para el envio</h3>

    <form action="<?= URL_BASE ?>pedido/add" method="post">
        <label for="provincia">Provincia</label>
        <input type="text" name="provincia" required>

        <label for="ciudad">Ciudad</label>
        <input type="text" name="ciudad" required>

        <label for="dirrecion">Dirreccion</label>
        <input type="text" name="direccion" required>

        <input type="submit" value="Confirmar pedido">


    </form>
<?php else : ?>
    <h1>Accion Denegada</h1>
    <p style="color: red; font-size: 28px; text-align:center; ">Nesecitas esta logueado para finalizar tu pedido</p>
<?php endif; ?>