<?php
// Conexión a la base de datos
$servername = "localhost";
$usernameDB = "root";
$passwordDB = "";
$dbname = "clinica";

$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$message = "";

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $conn->real_escape_string($_POST['usuario']);
    $password = $_POST['password'];

    if (!empty($usuario) && !empty($password)) {
        // Encriptar la contraseña
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Insertar usuario en la tabla
        $sql = "INSERT INTO usuarios (usuario, password ) VALUES ('$usuario', '$password_hash')";

        if ($conn->query($sql) === TRUE) {
            $message = "Usuario agregado correctamente.";
        } else {
            $message = "Error: " . $conn->error;
        }
    } else {
        $message = "Por favor, completa todos los campos.";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Agregar Usuario</title>
<style>
    body { font-family: Arial; background-color: #f4f6f9; padding: 50px; }
    form { max-width: 400px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    input { width: 100%; padding: 10px; margin: 10px 0; border-radius: 5px; border: 1px solid #ccc; }
    button { padding: 10px 20px; background-color: #3498db; color: white; border: none; border-radius: 5px; cursor: pointer; }
    button:hover { background-color: #2980b9; }
    .message { text-align: center; margin: 15px 0; color: green; }
</style>
</head>
<body>

<form method="POST" action="">
    <h2>Agregar Usuario</h2>
    <input type="text" name="usuario" placeholder="Nombre de usuario" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button type="submit">Agregar</button>
    <?php if(!empty($message)) echo "<div class='message'>$message</div>"; ?>
</form>

</body>
</html>

