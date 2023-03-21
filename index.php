<?php require_once "includes/cabecera.php"; ?>
<?php require_once "includes/aside.php"; ?>

<div id="principal">
    <h1>Últimas entradas</h1>

    <?php
    $entradas = conseguir_ultimas_entradas($conexion, true);
    if (!empty($entradas)) :
        while ($entrada = mysqli_fetch_assoc($entradas)) :
    ?>
            <article class="entrada">
                <a href="entrada.php?id=<?= $entrada['id']; ?>">
                    <h2><?= $entrada['titulo']; ?></h2>
                    <span class="fecha"><?= $entrada['categoria'] . ' | ' . $entrada['fecha']; ?></span>
                    <p>
                        <?= substr($entrada['descripcion'], 0, 180) . "..."; ?>
                    </p>
                </a>

            </article>
    <?php
        endwhile;
    endif;
    ?>

    <div id="ver_todas">
        <a href="entradas.php">Ver todas las entradas</a>
    </div>
</div>


<?php require_once "includes/footer.php" ?>