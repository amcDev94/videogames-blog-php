<?php require_once "includes/redireccion.php"; ?>
<?php require_once "includes/cabecera.php"; ?>
<?php require_once "includes/aside.php"; ?>

<div id="principal">
    <h1>Crear Entradas</h1>
    <p>
        Añade nuevas entradas al blog para que los usuarios puedan
        leerlas y disfrutar de nuestro contenido
    </p>
    <form action="guardar-entrada.php" method="POST">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo">
        <?php echo isset($_SESSION["errores_entrada"]) ? mostrar_error($_SESSION["errores_entrada"], "titulo") : ""; ?>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" cols="30" rows="10"></textarea>
        <?php echo isset($_SESSION["errores_entrada"]) ? mostrar_error($_SESSION["errores_entrada"], "descripcion") : ""; ?>

        <label for="categoria">Categoría:</label>
        <select name="categoria" id="">
            <?php echo isset($_SESSION["errores_entrada"]) ? mostrar_error($_SESSION["errores_entrada"], "categoria") : ""; ?>
            <?php
            $categorias = conseguir_categorias($conexion);
            if (!empty($categorias)) :
                while ($categoria = mysqli_fetch_assoc($categorias)) :
            ?>
                    <option value="<?= $categoria['id'] ?>">
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