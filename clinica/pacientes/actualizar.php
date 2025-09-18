<?php
include("../conexion.php");

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$dni = $_POST['dni'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$direccion = $_POST['direccion'];

$sql = "UPDATE pacientes SET nombre='$nombre', apellido='$apellido', dni='$dni', telefono='$telefono', email='$email', direccion='$direccion' WHERE id=$id";

if ($conexion->query($sql)) {
    header("Location: listar.php");
} else {
    echo "Error: " . $conexion->error;
}
?>
