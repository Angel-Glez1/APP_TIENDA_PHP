<h1>Crea una nueva categoria</h1>

<form action="<?= URL_BASE ?>categoria/save" method="post">
    <input required type="text" name="nombre" placeholder="Ingrese la nueva categoria">
    <input type="submit" value="Agregar Categoria">
</form>