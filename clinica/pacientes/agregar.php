<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinica";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Si se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];

    $sql = "INSERT INTO pacientes (nombre, apellido, dni, telefono, email, direccion)
            VALUES ('$nombre', '$apellido', '$dni', '$telefono', '$email', '$direccion')";

    if ($conn->query($sql) === TRUE) {
        header("Location: listar.php"); // redirige al listado
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Paciente</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Menú lateral -->
               <aside class="sidebar">
    <h2>Hospital Beltrán</h2>

    <ul class="menu">
        <li><a href="listar.php">Listar</a></li>
        <li><a href="agregar.php">Agregar</a></li>
    </ul>

    <!-- Bloque inferior -->
    <div class="bottom-buttons">
        <div class="volver">
            <a href="../principal.php">Volver</a>
        </div>
        <div class="logout">
            <a href="../logout.php">Salir</a>
        </div>
    </div>
</aside>

        <!-- Contenido principal -->
        <main class="main-content">
            <h1>Agregar Paciente</h1>
            <form method="POST" class="formulario">
    <div class="form-group">
        <input type="text" name="nombre" required placeholder=" ">
        <label>Nombre</label>
    </div>

    <div class="form-group">
        <input type="text" name="apellido" required placeholder=" ">
        <label>Apellido</label>
    </div>

    <div class="form-group">
        <input type="text" name="dni" required placeholder=" ">
        <label>DNI</label>
    </div>

    <div class="form-group">
        <input type="text" name="telefono" required placeholder=" ">
        <label>Teléfono</label>
    </div>

    <div class="form-group">
        <input type="email" name="email" placeholder=" ">
        <label>Email</label>
    </div>

    <div class="form-group">
        <input type="text" name="direccion" placeholder=" ">
        <label>Dirección</label>
    </div>

    <div class="form-buttons">
        <button type="submit" class="btn-primary">Guardar</button>
        <a href="listar.php" class="btn-secondary">Cancelar</a>
    </div>
</form>

        </main>
    </div>
</body>
</html>
<?php $conn->close(); ?>
