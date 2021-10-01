<h1>Gestion de productos</h1>
<a href="<?= URL_BASE ?>productos/crear" class="boton boton-small">Crear Crear Producto</a>

<!-- Verificar errores -->
<?php if (isset($_SESSION['producto']) && $_SESSION['producto'] == "Exito") : ?>

    <div class="exito">Producto añadido exitosamente</div>

<?php elseif (isset($_SESSION['producto']) && $_SESSION['producto'] == "Error") : ?>

    <div class="error">No se pudo añadir el producto</div>

<?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == "exito") : ?>

    <div class="exito">Se elimino producto exitosamente</div>

<?php elseif (isset($_SESSION['actualizar']) && $_SESSION['actualizar'] == "Exito") : ?>

    <div class="exito">Producto Actualizado</div>
<?php endif;

Utils::deleteSession('producto');
Utils::deleteSession('delete');
Utils::deleteSession('actualizar');
?>


<table>
    <tr>
        <th>Id</th>
        <th>Categoria Perteneciente</th>
        <th>Nombre</th>
        <!-- <th>Descripcion</th> -->
        <th>Precio</th>
        <th>Stock</th>
        <th>Oferta</th>
        <th>Actualizar</th>
        <th>Borrar</th>
    </tr>
    <?php
    // Este bluque muestra el resutado del metodo "getALL()" del controlador "productosModel.php"
    while ($pro = $producto->fetch_object()) : ?>
        <tr>

            <td><?= $pro->id ?></td>
            <td><?= $pro->NombreDeLaCategoria ?></td>
            <td><?= $pro->nombre ?></td>
            <td><?= $pro->precio ?></td>
            <td><?= $pro->stock ?></td>
            <td><?= $pro->oferta ?></td>
            <td> <a class="btn-btn azul" href="<?= URL_BASE . "productos/actualizar&id={$pro->id}" ?>"> Actualizar </a></td>
            <td><a class="btn-btn" href="<?= URL_BASE ?>productos/delete&id=<?=$pro->id?>">Eliminar</a></td>
        </tr>

    <?php endwhile; ?>
</table>