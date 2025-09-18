<?php
session_start(); // Inicia la sesión activa del usuario.
session_destroy(); // Forma de "cerrar sesión" de manera segura.
header("Location: index.php"); // Redirige al usuario a la página de login para iniciar sesión nuevamente.
?>
