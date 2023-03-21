<?php require_once "includes/redireccion.php"; ?>
<?php require_once "includes/helpers.php"; ?>
<?php require_once "includes/cabecera.php"; ?>
<?php require_once "includes/aside.php"; ?>
<?php
$entrada_actual = conseguir_entrada($conexion, $_GET['id']);
if (!isset($entrada_actual['id'])) {
    header("Location: index.php");
}
?>

<div id="principal">
    <h1>Editar entrada</h1>
    <p>
        Edita tu entrada <?= $entrada_actual['titulo'] ?>
    </p>
    <form action="guardar-entrada.php?editar=<?= $entrada_actual['id']; ?>" method="POST">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" value="<?= $entrada_actual['titulo'] ?>">
        <?php echo isset($_SESSION["errores_entrada"]) ? mostrar_error($_SESSION["errores_entrada"], "titulo") : ""; ?>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" cols="30" rows="10"><?= $entrada_actual['descripcion'] ?></textarea>
        <?php echo isset($_SESSION["errores_entrada"]) ? mostrar_error($_SESSION["errores_entrada"], "descripcion") : ""; ?>

        <label for="categoria">Categoría:</label>
        <select name="categoria" id="">
            <?php echo isset($_SESSION["errores_entrada"]) ? mostrar_error($_SESSION["errores_entrada"], "categoria") : ""; ?>
            <?php
            $categorias = conseguir_categorias($conexion);
            if (!empty($categorias)) :
                while ($categoria = mysqli_fetch_assoc($categorias)) :
            ?>
                    <option value="<?= $categoria['id'] ?>" <?= ($categoria['id'] == $entrada_actual['categoria_id']) ? 'selected="selected"' : ''; ?>>
                        <?= $categoria['nombre']; ?>
                    </option>
            <?php
                endwhile;
            endif;
            ?>
        </select>

        <input type="submit" value="Guardar">
    </form>
    <?php borrar_errores(); ?>
</div>



<?php require_once "includes/footer.php" ?>