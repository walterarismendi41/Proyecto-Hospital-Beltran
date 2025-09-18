<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Principal - Sistema Clínica</title>
    <link rel="stylesheet" href="css/style.principal.css">
</head>
<body>
    <div class="fondo"></div>
    <div class="main-container">
        <h1>SISTEMA DE GESTIÓN</h1>

        <!-- Logo centrado -->
        <div class="logo-container">
            <img src="Imagenes/logo.png" alt="Logo de la clínica" class="logo">
        </div>

        <p>Bienvenido, <?php echo $_SESSION['usuario']; ?>!</p>

        <nav class="menu">
            <a href="pacientes/listar.php" class="A">Pacientes</a>
            <a href="medicos/proximo.php"class="A">Médicos</a>
            <a href="turnos/proximoTurnos.php"class="A">Turnos</a>
        </nav>

        <a href="logout.php" class="logout-btn">Cerrar Sesión</a>
    </div>
</body>
</html>
