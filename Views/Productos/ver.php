<?php if (isset($producto)) : ?>
    <h1><?= $producto->nombre ?></h1>
    <div class="producto">
        <a href="<?= URL_BASE ?>productos/ver&id=<?= $producto->id ?>">
            <?php if ($producto->imagen != null) : ?>
                <img src="<?= URL_BASE ?>uploads/imagen<?= $producto->imagen ?>" alt="">
            <?php else : ?>
                <img src="<?= URL_BASE ?>Assets/img/camiseta.png" alt="">
            <?php endif; ?>
            <h2><?= $producto->nombre ?></h2>
        </a>
        <p><?= $producto->precio ?></p>
        <a href="<?= URL_BASE ?>carrito/add&id=<?=$producto->id?>" class="boton">Añadir a carrito</a>
    </div>



<?php else : ?>
    <h1>La categoria NO exite</h1>
<?php endif; ?>