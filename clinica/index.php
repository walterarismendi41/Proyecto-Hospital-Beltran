<?php
session_start();
$error = "";
if(isset($_SESSION['error_login'])) {
    $error = $_SESSION['error_login'];
    unset($_SESSION['error_login']); // borrar mensaje para que no se repita
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Hospital Beltran</title>
    <link rel="stylesheet" href="css/style.index.css">
</head>
<body>
    <div class="fondo"></div>
        <div class="login-container">
        <img src="/clinica/Imagenes/Logo.png" alt="Logo Hospital Beltrán" class="logo">

        <h2>HOSPITAL BELTRÁN</h2> 
        <form action="validar.php" method="POST"> <!-- Envía los datos a "validar.php" mediante POST. -->
            <label for="usuario">Usuario</label>
            <input type="text" id="usuario" name="usuario" required> <!-- No se puede dejar el campo vacíos -->

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required> <!-- No se puede dejar el campo vacíos -->

            <button type="submit">Ingresar</button>
            <?php if(!empty($error)) echo "<div class='message'>$error</div>"; ?>
        </form>
    </div>
</body>
</html>




