<!-- Incial -->




<h1>Porductos destacados</h1>
<?php while ($pro = $productos->fetch_object()) : ?>
    <div class="producto">
        <a href="<?= URL_BASE?>productos/ver&id=<?=$pro->id?>">
            <?php if ($pro->imagen != null) : ?>
                <img src="<?= URL_BASE ?>uploads/imagen<?= $pro->imagen ?>" alt="">
            <?php else : ?>
                <img src="<?= URL_BASE ?>Assets/img/camiseta.png" alt="">
            <?php endif; ?>
            <h2><?= $pro->nombre ?></h2>
        </a>
        <p><?= $pro->precio ?></p>
        <a href="<?=URL_BASE?>carrito/add&id=<?= $pro->id?>" class="boton">Añadir a carrito</a>
    </div>
<?php endwhile; ?>
</div>