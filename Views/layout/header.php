<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= URL_BASE ?>Assets/Css/style.css">
    <title>Tienda Master</title>
</head>

<body>
    <div id="conteiner">
        <!-- Cabezera -->
        <header id="header">
            <div id="logo">
                <!-- <img src="Assets/img/camiseta.png" alt="logotipo"> -->
                <img src="<?= URL_BASE ?>Assets/img/camiseta.png" alt="logotipo">
                <a href="index.php">Full Store Shirt</a>
            </div>
        </header>

        <!-- Menu -->
        <nav id="menu">
            <ul>
                <!-- Inicio -->
                <li><a href="<?= URL_BASE ?>">Inicio</a></li>
                <!-- Categorias -->
                <?php $categoria = Utils::showCategorias();
                while ($cat = $categoria->fetch_object()) : ?>
                    <li><a href="<?=URL_BASE?>categoria/ver&id=<?=$cat->id?>"><?= $cat->nombre ?></a></li>
                <?php endwhile; ?>
            </ul>
        </nav>

        <div id="content">