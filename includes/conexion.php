<?php
$servidor = "localhost";
$usuario = "root";
$password = "";
$base_datos = "blog_udemy_1";
$conexion = mysqli_connect($servidor, $usuario, $password, $base_datos);

mysqli_query($conexion, "SET NAMES 'utf8'");

// if (!$conexion) {
//     die("Connection failed: " . mysqli_connect_error());
// } else {
//     echo "Connected successfully";
//     mysqli_close($conexion);
// }

// Iniciar la sesión

if (!isset($_SESSION)) {
    session_start();
}
