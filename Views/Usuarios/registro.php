<?php

// Si tuvo exito el Registro
if (isset($_SESSION['registro']) && $_SESSION['registro'] == "Exito") : ?>
    <p class="exito">Exito al logiarrse</p>

<?php
// Si hubo un error en el registo
elseif (isset($_SESSION['registro']) && $_SESSION['registro'] == "fallo") :  ?>
    <p class="error">Error en el registro</p>

<?php
// Borrar cualquier session que tenga un mensaje de error
endif; 
Utils::deleteSession('registro'); ?>

<!-- Lateral -->
<div id="login" class="block_aside">
    <?php if (!isset($_SESSION['user'])) : ?>

        <h3 class="texto">Crea una cuenta para que empieces a comprar la mejores playeras del mundo</h3>
        <form action="<?= URL_BASE ?>usuario/save" method="post" enctype="multipart/form-data">
            <input type="text" name="nombre" placeholder="Ingresa tu nombre ">
            <input type="text" name="apellido" placeholder="Ingresa tu apellido">
            <input type="text" name="email" placeholder="Ingresa un correo electronico">
            <input type="text" name="password" placeholder="Ingresa ingresa un contraseña">
            <!-- <label for="imagen">Selecciona una foto de perfil</label>
            <br>
             <input type="file" name="imagen"> -->
            <input type="submit" value="Registarse">
        </form>

    <?php
    // bloquemos el acesso a form de registro si el usurio ya esta registrado y lo redireccionamos al inicio
        else : header("location:" . URL_BASE); ?>
    <?php endif; ?>
</div>