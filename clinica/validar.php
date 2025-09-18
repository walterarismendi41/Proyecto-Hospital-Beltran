<?php 
session_start();
include("conexion.php");

$usuario = $_POST['usuario'];
$password = $_POST['password'];

// Buscar el usuario en la base de datos
$sql = "SELECT * FROM usuarios WHERE usuario='$usuario'";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    
    if (password_verify($password, $fila['password'])) {
        $_SESSION['usuario'] = $usuario;
        header("Location: principal.php");
        exit;
    } else {
        // Contraseña incorrecta
        $_SESSION['error_login'] = "Contraseña incorrecta.";
        header("Location: index.php");
        exit;
    }
} else {
    // Usuario no encontrado
    $_SESSION['error_login'] = "Usuario no encontrado.";
    header("Location: index.php");
    exit;
}
?>
