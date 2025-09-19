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
if (isset($_GET['id_paciente'])) {
    $id = (int) $_GET['id_paciente']; // lo forzamos a número para seguridad
    $sql = "SELECT * FROM pacientes WHERE id_paciente = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $paciente = $result->fetch_assoc();
    } else {
        echo "Paciente no encontrado.";
        exit;
    }
} else {
    echo "ID de paciente no proporcionado.";
    exit;
}

// Procesar eliminación
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['confirmar'])) {
        $sql = "DELETE FROM pacientes WHERE id_paciente = $id";
        if ($conn->query($sql) === TRUE) {
            header("Location: listar.php");
            exit;
        } else {
            echo "Error al borrar: " . $conn->error;
        }
    } else {
        header("Location: listar.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Borrar Paciente</title>
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
            <h1>Borrar Paciente</h1>
            <p>¿Estás seguro de que deseas eliminar al paciente?</p>

            <div class="confirm-card">
                <p><strong>Nombre:</strong> <?php echo $paciente['nombre'] . " " . $paciente['apellido']; ?></p>
                <p><strong>DNI:</strong> <?php echo $paciente['dni']; ?></p>
                <p><strong>Teléfono:</strong> <?php echo $paciente['telefono']; ?></p>
            </div>

            <form method="POST" class="form-buttons">
                <button type="submit" name="confirmar" class="btn-danger">Sí, borrar</button>
                <button type="submit" name="cancelar" class="btn-secondary">Cancelar</button>
            </form>
        </main>
    </div>
</body>
</html>
<?php $conn->close(); ?>
