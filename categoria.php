<?php require_once "includes/helpers.php"; ?>
<?php require_once "includes/cabecera.php"; ?>
<?php require_once "includes/aside.php"; ?>
<?php
$categoria = conseguir_categoria($conexion, $_GET['id']);
if (!isset($categoria['id'])) {
    header("Location: index.php");
}
?>


<div id="principal">
    <h1>Entradas de <?= $categoria['nombre']; ?></h1>

    <?php
    $entradas = conseguir_entradas($conexion, null, $_GET['id']);
    if (!empty($entradas) && mysqli_num_rows($entradas) >= 1) :
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
    else :
        ?>
        <div class="alerta">No hay entradas en esta categoría</div>
    <?php endif; ?>
</div>


<?php require_once "includes/footer.php" ?>