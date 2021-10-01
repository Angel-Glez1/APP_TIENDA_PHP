<h1>Mis pedidos</h1>
<table>
    <tr>
        <th>N° Pedido</th>
        <th>Total Pagado</th>
        <th>Fecha</th>
        <!-- <th>Unidades</th> -->

    </tr>
    <?php while ($ver = $verpedidos->fetch_object()) : ?>
        <tr>
            <td><a href="<?= URL_BASE ?>pedido/detalle&id=<?= $ver->id ?>"><?= $ver->id ?></a></td>
            <td><?= $ver->coste ?></td>
            <td><?= $ver->fecha ?></td>

        </tr>
    <?php endwhile; ?>
</table>