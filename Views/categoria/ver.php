<?php if (isset($resultado)) : ?>
    <h1>Categoria<?= $resultado->nombre ?></h1>

    <?php if ($pro->num_rows == 0) : ?>
        <p>No hay productos en esta categoria</p>

    <?php else : ?>
        <?php while ($proo = $pro->fetch_object()) : ?>
            <div class="producto">
                <a href="<?= URL_BASE ?>productos/ver&id=<?= $proo->id ?>">
                    <?php if ($proo->imagen != null) : ?>
                        <img src="<?= URL_BASE ?>uploads/imagen<?= $proo->imagen ?>" alt="">
                    <?php else : ?>
                        <img src="<?= URL_BASE ?>Assets/img/camiseta.png" alt="">
                    <?php endif; ?>
                    <h2><?= $proo->nombre  ?></h2>
                </a>
                <p><?= $proo->precio ?></p>
                <a href="<?= URL_BASE ?>carrito/add&id=<?=$proo->id?>" class="boton">Añadir a carrito</a>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>


<?php else : ?>
    <h1>La categoria NO exite</h1>
<?php endif; ?>