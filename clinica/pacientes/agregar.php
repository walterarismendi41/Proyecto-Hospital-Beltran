<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinica";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Error de conexión: " . $conn->connect_error);

$message = "";

// Traer localidades para el select
$localidades_result = $conn->query("SELECT * FROM localidades ORDER BY localidad ASC");

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $apellido = $conn->real_escape_string($_POST['apellido']);
    $dni = $conn->real_escape_string($_POST['dni']);
    $telefono = $conn->real_escape_string($_POST['telefono']);
    $email = $conn->real_escape_string($_POST['email']);
    $calle = $conn->real_escape_string($_POST['calle']);
    $altura = $conn->real_escape_string($_POST['altura']);
    $id_localidad = intval($_POST['id_localidad']);

    // Insertar la dirección
    $sql_direccion = "INSERT INTO direcciones (calle, altura, id_localidad) VALUES ('$calle', '$altura', $id_localidad)";
    if ($conn->query($sql_direccion) === TRUE) {
        $id_direccion = $conn->insert_id;

        // Verificar si el DNI ya existe
        $check_dni = $conn->query("SELECT id_paciente FROM pacientes WHERE dni='$dni'");
        if ($check_dni->num_rows > 0) {
            $message = "Error: Ya existe un paciente con ese DNI.";
        } else {
            $sql_insert = "INSERT INTO pacientes (nombre, apellido, dni, telefono, email, id_direcciones)
                           VALUES ('$nombre', '$apellido', '$dni', '$telefono', '$email', $id_direccion)";
            if ($conn->query($sql_insert) === TRUE) {
                $message = "Paciente agregado correctamente.";
            } else {
                $message = "Error al agregar paciente: " . $conn->error;
            }
        }
    } else {
        $message = "Error al agregar dirección: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Agregar Paciente</title>
<link rel="stylesheet" href="style.css">
<script>
function mostrarCodigoPostal() {
    var select = document.getElementById("id_localidad");
    var codigoPostal = select.options[select.selectedIndex].getAttribute("data-cp");
    document.getElementById("codigo_postal").value = codigoPostal;
}
</script>
</head>
<body>
<div class="container">
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

    <main class="main-content">
        <h1>Agregar Paciente</h1>
        <?php if($message != "") echo "<div class='message'>$message</div>"; ?>

        <form method="POST" class="formulario">
            <div class="form-group"><input type="text" name="nombre" required placeholder=" "><label>Nombre</label></div>
            <div class="form-group"><input type="text" name="apellido" required placeholder=" "><label>Apellido</label></div>
            <div class="form-group"><input type="text" name="dni" required placeholder=" "><label>DNI</label></div>
            <div class="form-group"><input type="text" name="telefono" required placeholder=" "><label>Teléfono</label></div>
            <div class="form-group"><input type="email" name="email" placeholder=" "><label>Email</label></div>

            <h3>Dirección</h3>
            <div class="form-group"><input type="text" name="calle" required placeholder=" "><label>Calle</label></div>
            <div class="form-group"><input type="text" name="altura" required placeholder=" "><label>Altura</label></div>

            <div class="form-group">
                <label>Localidad</label>
                <select name="id_localidad" id="id_localidad" onchange="mostrarCodigoPostal()" required>
                    <option value="">Selecciona una localidad</option>
                    <?php
                    while($loc = $localidades_result->fetch_assoc()) {
                        echo "<option value='".$loc['id_localidad']."' data-cp='".$loc['codigo_postal']."'>".$loc['localidad']."</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <input type="text" id="codigo_postal" placeholder="Código Postal" readonly>
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
