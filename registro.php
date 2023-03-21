<?php

// Conexión a la base de datos
require_once "includes/conexion.php";

// Iniciar sesión si no está iniciada

if (!isset($_SESSION)) {
    session_start();
}

// Recoger los valores de registro

if (isset($_POST)) {
    $nombre = isset($_POST["nombre"]) ? mysqli_real_escape_string($conexion, $_POST["nombre"])  : false;
    $apellidos = isset($_POST["apellidos"]) ? mysqli_real_escape_string($conexion, $_POST["apellidos"]) : false;
    $email = isset($_POST["email"]) ? mysqli_real_escape_string($conexion, trim($_POST["email"])) : false;
    $password = isset($_POST["password"]) ? mysqli_real_escape_string($conexion, $_POST["password"]) : false;

    // Array de errores
    $errores = array();

    // Validar los datos antes de guardarlos en la BBDD

    // Validación del nombre
    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $nombre_validado = true;
    } else {
        $nombre_validado = false;
        $errores["nombre"] = "El nombre no es válido";
    }

    // Validación de los apellidos

    if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
        $apellidos_validados = true;
    } else {
        $apellidos_validados = false;
        $errores["apellidos"] = "Los apellidos no son válidos";
    }

    // Validación del email

    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_validado = true;
    } else {
        $email_validado = false;
        $errores["email"] = "El email no es válido";
    }

    // Validación de la contraseña

    if (!empty($password)) {
        $password_validada = true;
    } else {
        $password_validada = false;
        $errores["password"] = "La contraseña no es válida";
    }

    $guardar_usuario = false;
    if (count($errores) == 0) {
        $guardar_usuario = true;

        // Cifrar la contraseña

        $password_segura = password_hash($password, PASSWORD_BCRYPT, ["cost" => 4]);

        // Insertar usuario en la BBDD 

        $sql = "INSERT INTO usuarios VALUES(null, '$nombre', '$apellidos', '$email', '$password_segura', CURDATE())";
        $guardar = mysqli_query($conexion, $sql);

        if ($guardar) {
            $_SESSION["completado"] = "El registro se ha completado con éxito";
        } else {
            $_SESSION["errores"]["general"] = "Fallo al guardar el usuario";
        }
    } else {
        $_SESSION["errores"] = $errores;
    }
}

header("Location: index.php");
