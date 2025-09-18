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

// Mensaje para mostrar al usuario
$message = "";

// Procesar formulario agregar usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar'])) {
    $usuario = $conn->real_escape_string($_POST['usuario']);
    $password = $_POST['password'];

    if (!empty($usuario) && !empty($password)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (usuario, password) VALUES ('$usuario', '$password_hash')";
        if ($conn->query($sql) === TRUE) {
            $message = "Usuario agregado correctamente.";
        } else {
            $message = "Error al agregar usuario: " . $conn->error;
        }
    } else {
        $message = "Por favor, completa todos los campos.";
    }
}

// Procesar formulario borrar usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['borrar'])) {
    $usuario_borrar = $conn->real_escape_string($_POST['usuario_borrar']);

    if (!empty($usuario_borrar)) {
        $sql_borrar = "DELETE FROM usuarios WHERE usuario='$usuario_borrar'";
        if ($conn->query($sql_borrar) === TRUE) {
            $message = "Usuario '$usuario_borrar' eliminado correctamente.";
        } else {
            $message = "Error al eliminar usuario: " . $conn->error;
        }
    } else {
        $message = "Por favor, escribe un usuario para borrar.";
    }
}

// Traer lista de usuarios
$result = $conn->query("SELECT id, usuario FROM usuarios ORDER BY id ASC");

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Gestión de Usuarios</title>
<style>
    body { font-family: Arial; background-color: #f4f6f9; padding: 50px; }
    .container { max-width: 600px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    img { display: block; margin: 0 auto 20px; max-width: 150px; }
    h2, h3 { text-align: center; color: #2c3e50; }
    input { width: 100%; padding: 10px; margin: 10px 0; border-radius: 5px; border: 1px solid #ccc; }
    button { padding: 10px 20px; background-color: #3498db; color: white; border: none; border-radius: 5px; cursor: pointer; }
    button:hover { background-color: #2980b9; }
    .message { text-align: center; margin: 15px 0; color: green; }
    .error { color: red; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    table th, table td { border: 1px solid #ddd; padding: 10px; text-align: center; }
    table th { background-color: #2c3e50; color: white; }
    table tr:nth-child(even) { background-color: #f9f9f9; }
    table tr:hover { background-color: #f1f1f1; }
    .btn-borrar { background-color: #e74c3c; color: white; padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer; }
    .btn-borrar:hover { background-color: #c0392b; }
</style>
</head>
<body>

<div class="container">

    <!-- Logo -->
    <img src="Imagenes/Logo.png" alt="Hospital Beltrán">

    <!-- Formulario agregar usuario -->
    <form method="POST" action="">
        <h2>Agregar Usuario</h2>
        <input type="text" name="usuario" placeholder="Nombre de usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit" name="agregar">Agregar</button>
    </form>

    <!-- Mensaje -->
    <?php 
        if (!empty($message)) {
            $class = (strpos($message, 'Error') !== false) ? 'error' : 'message';
            echo "<div class='$class'>$message</div>";
        }
    ?>

    <!-- Lista de usuarios -->
    <h3>Usuarios Registrados</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Acción</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>".$row['id']."</td>
                    <td>".$row['usuario']."</td>
                    <td>
                        <form method='POST' action='' style='margin:0;'>
                            <input type='hidden' name='usuario_borrar' value='".$row['usuario']."'>
                            <button type='submit' name='borrar' class='btn-borrar'>Borrar</button>
                        </form>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No hay usuarios registrados.</td></tr>";
        }
        ?>
    </table>

</div>

</body>
</html>
