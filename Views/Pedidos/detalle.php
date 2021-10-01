<h1>Detalle del pedido: <?= $id_pedido ?></h1>

<?php if (isset($_SESSION['admi'])) : ?>
    <h3>Cambiar estado del prodcuto</h3>

    <form action="<?= URL_BASE ?>pedido/estado" method="post">
        <input type="hidden" value="<?= $desc_pedido->id ?>" name="pedido_id">
        <select name="estado">
            <option value="confirm"    <?=$desc_pedido->estado == 'confirm' ? 'selected' : '' ?> >Pendiente</option>
            <option value="preparation"<?=$desc_pedido->estado == 'preparation' ? 'selected' : '' ?>>En preparacion</option>
            <option value="ready"      <?=$desc_pedido->estado == 'ready' ? 'selected' : '' ?>>Preparado para enviar</option>
            <option value="sended"     <?=$desc_pedido->estado == 'sended' ? 'selected' : '' ?>>Enviado</option>
        </select>

        <input type="submit" value="Cambiar estado del producto">
    </form>

<?php endif; ?>



<div>Matricula: <?= $desc_pedido->usuario_id ?></div>
<div>Numero de pedido: <?= $desc_pedido->id ?></div>
<div>Total A pagar: <?= $desc_pedido->coste ?></div>
<table>

    <tr>
        <th>Imagen</th>
        <th>nombre</th>
        <th>Precio</th>
        <th>Unidades</th>
        <th>Estado</th>

    </tr>
    <?php while ($ver = $verProductos->fetch_object()) : ?>
        <tr>
            <td><?php if ($ver->imagen != null) : ?>
                    <img src="<?= URL_BASE ?>uploads/imagen<?= $ver->imagen ?>" alt="">
                <?php else : ?>
                    <img src="<?= URL_BASE ?>Assets/img/camiseta.png" alt="">
                <?php endif; ?>
            </td>
            <td><a href="<?= URL_BASE ?>productos/ver&id=<?= $ver->id ?>"><?= $ver->nombre ?></a></td>
            <td><?= $ver->precio ?></td>
            <td><?= $ver->unidades ?></td>
            <td><?= Utils::showStatus($desc_pedido->estado) ?></td>

        </tr>
    <?php endwhile; ?>
</table>