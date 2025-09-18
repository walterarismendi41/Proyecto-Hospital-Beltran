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
    <link rel="stylesheet" href="style.proximoTurnos.css">
</head>
<body>
    <div class="fondo"></div>
    <div class="main-container">
        <h1>UPPS, ACA TAMBIÉN ESTAMOS TRABAJANDO EN LA SESIÓN</h1>

        <!-- Logo centrado -->
        <div class="logo-container">
            <img src="/clinica/Imagenes/Logo.png" alt="Logo de la clínica" class="logo">
        </div>

        <nav class="menu">
            <a href="../pacientes/listar.php" class="A">Pacientes</a>
            <a href="../medicos/proximo.php"class="A">Médicos</a>
            <a href="../turnos/proximoTurnos.php"class="A">Turnos</a>
        </nav>

        <a href="../logout.php" class="logout-btn">Cerrar Sesión</a>
    </div>
</body>
</html>