<?php require_once "conexion.php"; ?>
<?php require_once "helpers.php"; ?>

<! -- Fin del contenedor principal -->

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Blog de videojuegos</title>
        <link rel="stylesheet" type="text/css" href="./assets/css/styles.css">
    </head>

    <body>
        <header id="cabecera">
            <div id="logo">
                <a href="index.php">Blog de videojuegos</a>
            </div>
            <?php $categorias = conseguir_categorias($conexion); ?>
            <nav id="menu">
                <ul>
                    <li>
                        <a href="index.php">Inicio</a>
                    </li>
                    <?php $categorias = conseguir_categorias($conexion);
                    if (!empty($categorias)) :
                        while ($categoria = mysqli_fetch_assoc($categorias)) : ?>
                            <li>
                                <a href="categoria.php?id=<?= $categoria['id']; ?>"><?= $categoria["nombre"]; ?></a>
                            </li>
                    <?php
                        endwhile;
                    endif;
                    ?>
                    <li>
                        <a href="index.php">Sobre mí</a>
                    </li>
                    <li>
                        <a href="index.php">Contacto</a>
                    </li>
                </ul>
            </nav>
            <div class="clearfix"></div>
        </header>

        <div id="contenedor">