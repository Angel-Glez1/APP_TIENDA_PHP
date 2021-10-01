<h1>Mis carrito</h1>

<?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1) : ?>
    <?php $status =  Utils::statusCarrito(); ?>

    <h3 class="angel">Total a pagar: <?= $status['total'] ?> mxn </h3>
    <a href="<?= URL_BASE ?>pedido/hacer" class="boton">Finalizar la compra</a>
    <a class="boton rojo" href="<?= URL_BASE ?>carrito/deleteCarrito">Eliminar todo del carrito</a>

    <table>
        <tr>
            <th>Imagen</th>
            <th>nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
            <th>total por cada producto</th>
            <th>Eliminar producto</th>
        </tr>
        <?php if (isset($carrito)) : ?>
            <?php foreach ($carrito as $key) : ?>
                <tr>
                    <td><?php if ($key['imagen'] != null) : ?>
                            <!-- Imagen del prodcuto -->
                            <img src="<?= URL_BASE ?>uploads/imagen<?= $key['imagen'] ?>" alt="">
                        <?php else : ?>
                            <img src="<?= URL_BASE ?>Assets/img/camiseta.png" alt="">
                        <?php endif; ?>
                    </td>
                    <td>
                        <!-- Nombre del producto -->
                        <a href="<?= URL_BASE ?>productos/ver&id=<?= $key['producto_id'] ?>">
                            <?= $key['nombre'] ?></a>
                    </td>

                    <!-- Precio por porducto -->
                    <td>
                        <?= $key['precio'] ?>
                    </td>

                    <!-- Cantidad de cada prodcuto Y botonos para aumentar -->
                    <td>
                        <a href="<?= URL_BASE ?>carrito/decremento&menos=<?= $key['producto_id'] ?>">-</a>
                        <?= $key['cantidad'] ?>
                        <a href="<?= URL_BASE ?>carrito/incremento&mas=<?= $key['producto_id'] ?>">+</a>
                    </td>

                    <!-- Cantidad total a pagar  -->
                    <td><?= $key['cantidad'] * $key['precio'] ?> mxn</td>

                    <!-- Boton para eliminar -->
                    <td>
                        <a class="elimimar" href="<?= URL_BASE ?>carrito/remove&id=<?= $key['producto_id'] ?>">x</a>
                    </td>
                </tr>


        <?php endforeach;
        endif; ?>
    </table>
<?php else : ?>
    <h1>No tienes nada el en carrito Agrega algun prodcuto</h1>
    <a class=" boton" href="<?= URL_BASE ?>">Buscar productos para añadir a mi carrito</a>
<?php endif; ?>