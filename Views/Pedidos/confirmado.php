<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'ok') : ?>
    <h1>Tu pedido se a confirmado</h1>
    <p style="font-size: 2em;">En hora buena tu pedido esta a un paso de completarse, para que finalizar por favor continua con la tranferencia bancaria ala cueenta <strong>1234-5678-2468</strong>
        <div></div>

        <h3>Datos del pedido</h3>
        <div>Matricula: <?= $info_pedido->usuario_id ?></div>
        <div>Numero de pedido: <?= $info_pedido->id ?></div>
        <div>Total A pagar: <?= $info_pedido->coste ?></div>
        <table>

            <tr>
                <th>Imagen</th>
                <th>nombre</th>
                <th>Precio</th>
                <th>Unidades</th>

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

                </tr>
            <?php endwhile; ?>
        </table>




























    <?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'ok') : ?>
        <h1>Hubo un error en la tranferencia por favor verifica que pedo con su dirrecion</h1>
    <?php endif; ?>