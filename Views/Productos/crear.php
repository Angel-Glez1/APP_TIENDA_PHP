<?php
// Si exite esta varieble mostramos la vista del Actualizar y mostramos los datos en los inputs correspondientes al id 
if (isset($actualizar) && isset($producto) && is_object($producto)) : ?>

    <h1>Editar Producto de : <b><?= $producto->nombre ?></b> </h1>

    <?php $url_opcional = URL_BASE . "productos/save&id={$id}"; ?>

<?php else : ?>

    <h1>Insegra un producto nuevo</h1>

<?php
    $url_opcional = URL_BASE . 'productos/save';
endif; ?>

<form class="ajuste" action="<?= $url_opcional ?>" method="post" enctype="multipart/form-data">

    <label for="nombre">Nombre del producto:</label>
    <input type="text" name="nombre" value="<?= isset($actualizar) && is_object($producto) ? $producto->nombre : "" ?>" />

    <label for="descripcion">Descripcion del producto: </label>
    <textarea name="descripcion"><?= isset($actualizar) && is_object($producto) ? $producto->descripcion : "" ?></textarea>

    <label for="Precio">Precio del producto:</label>
    <input type="text" name="precio" value="<?= isset($actualizar) && is_object($producto) ? $producto->precio : "" ?>">

    <label for="stock">Stock del producto:</label>
    <input type="text" name="stock" value="<?= isset($actualizar) && is_object($producto) ? $producto->stock : "" ?>">

    <label for="">Selecciona la categoria:</label>
    <?php $nameCategorias = Utils::showCategorias(); ?>

    <select name="categoria_id">

        <?php while ($cat = $nameCategorias->fetch_object()) : ?>
            <option value="<?= $cat->id ?>" <?= isset($actualizar) && is_object($producto) && $cat->id == $producto->categoria_id ? 'selected' : "" ?>>
                <?= $cat->nombre ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label for="imagen">Agrega un imagen:</label>
    <input type="file" name="imagen">
    <?php if (isset($actualizar) && is_object($producto)) : ?>
        <img src="<?= URL_BASE ?>uploads/imagen<?= $producto->imagen ?>" alt="Img  de producto">
    <?php endif; ?>

    <input type="submit" value="Agregar Producto">
</form>