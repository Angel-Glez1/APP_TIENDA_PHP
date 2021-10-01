<h1>Gestionar Categorias</h1>


<a href="<?=URL_BASE?>categoria/crear" class="boton boton-small">Crear Categoria</a>

<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
    </tr>
    <?php while ($categorias = $result->fetch_object()) : ?>
        <tr>
            <td><?= $categorias->id ?></td>
            <td><?= $categorias->nombre ?></td>
        </tr>
    <?php endwhile; ?>
</table>