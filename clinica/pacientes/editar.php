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

// Obtener el paciente por ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM pacientes WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $paciente = $result->fetch_assoc();
    } else {
        echo "Paciente no encontrado.";
        exit;
    }
} else {
    echo "ID no proporcionado.";
    exit;
}

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];

    $sql = "UPDATE pacientes 
            SET nombre='$nombre', apellido='$apellido', dni='$dni', 
                telefono='$telefono', email='$email', direccion='$direccion' 
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: listar.php");
        exit;
    } else {
        echo "Error al actualizar: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Paciente</title>
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
            <h1>Actualizar Paciente</h1>
            <form method="POST" class="formulario">
                <div class="form-group">
                    <input type="text" name="nombre" value="<?php echo $paciente['nombre']; ?>" required placeholder=" ">
                    <label>Nombre</label>
                </div>

                <div class="form-group">
                    <input type="text" name="apellido" value="<?php echo $paciente['apellido']; ?>" required placeholder=" ">
                    <label>Apellido</label>
                </div>

                <div class="form-group">
                    <input type="text" name="dni" value="<?php echo $paciente['dni']; ?>" required placeholder=" ">
                    <label>DNI</label>
                </div>

                <div class="form-group">
                    <input type="text" name="telefono" value="<?php echo $paciente['telefono']; ?>" required placeholder=" ">
                    <label>Teléfono</label>
                </div>

                <div class="form-group">
                    <input type="email" name="email" value="<?php echo $paciente['email']; ?>" placeholder=" ">
                    <label>Email</label>
                </div>

                <div class="form-group">
                    <input type="text" name="direccion" value="<?php echo $paciente['direccion']; ?>" placeholder=" ">
                    <label>Dirección</label>
                </div>

                <div class="form-buttons">
                    <button type="submit" class="btn-primary">Actualizar</button>
                    <a href="listar.php" class="btn-secondary">Cancelar</a>
                </div>
            </form>
        </main>
    </div>
</body>
</html>
<?php $conn->close(); ?>
