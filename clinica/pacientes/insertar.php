<?php
include("../conexion.php");

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$dni = $_POST['dni'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$direccion = $_POST['direccion'];

$sql = "INSERT INTO pacientes (nombre, apellido, dni, telefono, email, direccion)
VALUES ('$nombre', '$apellido', '$dni', '$telefono', '$email', '$direccion')";

if ($conexion->query($sql)) {
    header("Location: listar.php");
} else {
    echo "Error: " . $conexion->error;
}
?>
