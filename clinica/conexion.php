<?php
$servidor = "localhost"; // base de datos local en la computadora.
$usuario = "root";  // por defecto en XAMPP
$password = "";     // vacío si no pusiste contraseña
$bd = "clinica"; // nombre de la base de datos

$conexion = new mysqli($servidor, $usuario, $password, $bd);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
