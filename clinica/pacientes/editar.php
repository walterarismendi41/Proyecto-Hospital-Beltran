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
    $id = $conn->real_escape_string($_GET['id_paciente']);

    $sql = "SELECT p.*, d.id_direcciones, d.calle, d.altura, l.id_localidad, l.localidad, l.codigo_postal
            FROM pacientes p
            LEFT JOIN direcciones d ON p.id_direcciones = d.id_direcciones
            LEFT JOIN localidades l ON d.id_localidad = l.id_localidad
            WHERE p.id_paciente = $id";

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
    $calle = $_POST['calle'];
    $altura = $_POST['altura'];
    $codigo_postal = intval($_POST['codigo_postal']);
    $nueva_localidad = trim($_POST['nueva_localidad']);

    // 1. Buscar si ya existe ese código postal
    $sqlBuscar = "SELECT id_localidad FROM localidades WHERE codigo_postal = $codigo_postal";
    $result = $conn->query($sqlBuscar);

    if ($result->num_rows > 0) {
        // Ya existe
        $fila = $result->fetch_assoc();
        $id_localidad = $fila['id_localidad'];
    } else {
        // No existe → se crea solo si el usuario escribió una localidad
        if (!empty($nueva_localidad)) {
            $sqlInsert = "INSERT INTO localidades (localidad, codigo_postal)
                          VALUES ('$nueva_localidad', $codigo_postal)";
            $conn->query($sqlInsert);
            $id_localidad = $conn->insert_id;
        } else {
            echo "Error: El código postal no existe y no ingresaste una nueva localidad.";
            exit;
        }
    }


    // Actualizar tabla pacientes
    $sql1 = "UPDATE pacientes 
             SET nombre='$nombre', apellido='$apellido', dni='$dni', telefono='$telefono', email='$email' 
             WHERE id_paciente=$id";
    $conn->query($sql1);

    // Actualizar tabla direcciones CON nueva localidad si cambia el CP
    if (!empty($paciente['id_direcciones'])) {
        $sql2 = "UPDATE direcciones 
                SET calle='$calle', 
                    altura='$altura', 
                    id_localidad=$id_localidad
                WHERE id_direcciones={$paciente['id_direcciones']}";
        $conn->query($sql2);
    }

    header("Location: listar.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Paciente</title>
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
            <div class="volver"><a href="../principal.php">Volver</a></div>
            <div class="logout"><a href="../logout.php">Salir</a></div>
        </div>
    </aside>

    <!-- Contenido principal -->
    <main class="main-content">
        <h1>Editar Paciente</h1>
        <form method="POST" class="formulario">
            <div class="form-group">
                <input type="text" name="nombre" value="<?php echo htmlspecialchars($paciente['nombre']); ?>" required>
                <label>Nombre</label>
            </div>
            <div class="form-group">
                <input type="text" name="apellido" value="<?php echo htmlspecialchars($paciente['apellido']); ?>" required>
                <label>Apellido</label>
            </div>
            <div class="form-group">
                <input type="text" name="dni" value="<?php echo htmlspecialchars($paciente['dni']); ?>" required>
                <label>DNI</label>
            </div>
            <div class="form-group">
                <input type="text" name="telefono" value="<?php echo htmlspecialchars($paciente['telefono']); ?>">
                <label>Teléfono</label>
            </div>
            <div class="form-group">
                <input type="email" name="email" value="<?php echo htmlspecialchars($paciente['email']); ?>">
                <label>Email</label>
            </div>
            <div class="form-group">
                <input type="text" name="calle" value="<?php echo htmlspecialchars($paciente['calle']); ?>">
                <label>Calle</label>
            </div>
            <div class="form-group">
                <input type="text" name="altura" value="<?php echo htmlspecialchars($paciente['altura']); ?>">
                <label>Altura</label>
            </div>
            <div class="form-group">
                <input type="text" name="codigo_postal" value="<?php echo htmlspecialchars($paciente['codigo_postal']); ?>" required>
                <label>Código Postal</label>
            </div>

            <div class="form-group">
                <input type="text" name="nueva_localidad" placeholder="solo si cambia de CP">
                <label>Localidad</label>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-primary">Actualizar</button>
                <button href="listar.php" class="btn-secondary">Cancelar</button>
            </div>
        </form>
    </main>
</div>
</body>
</html>
<?php $conn->close(); ?>
