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

// Verificar que se envió un ID
if(!isset($_GET['id'])) {
    die("ID de paciente no proporcionado.");
}

$id = $conn->real_escape_string($_GET['id']);

// Obtener los datos del paciente
$sql = "SELECT * FROM pacientes WHERE id = $id";
$result = $conn->query($sql);

if($result->num_rows == 0) {
    die("Paciente no encontrado.");
}

$paciente = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ficha del Paciente</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 20px; }
        .ficha { max-width: 700px; margin: 0 auto; background-color: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .header { text-align: center; margin-bottom: 30px; }
        .header img { max-width: 120px; margin-bottom: 10px; }
        .header h1 { margin: 0; font-size: 26px; color: #2c3e50; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #b83737ff; color: white; }
        .print-button { text-align: center; margin-top: 20px; }
        button { padding: 10px 25px; font-size: 16px; background-color: #3498db; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background-color: #9f2b29ff; }
        @media print {
            body { background-color: #fff; }
            .print-button { display: none; }
        }
    </style>
</head>
<body>
    <div class="ficha">
        <div class="header">
            <img src="../Imagenes/logo.png" alt="Hospital Beltrán Logo">
            <h1>Ficha del Paciente</h1>
        </div>

        <table>
            <tr><th>Nombre</th><td><?php echo $paciente['nombre']; ?></td></tr>
            <tr><th>Apellido</th><td><?php echo $paciente['apellido']; ?></td></tr>
            <tr><th>DNI</th><td><?php echo $paciente['dni']; ?></td></tr>
            <tr><th>Teléfono</th><td><?php echo $paciente['telefono']; ?></td></tr>
            <tr><th>Email</th><td><?php echo $paciente['email']; ?></td></tr>
            <tr><th>Dirección</th><td><?php echo $paciente['direccion']; ?></td></tr>
        </table>

        <div class="print-button">
            <button onclick="window.print()">🖨️ Imprimir Ficha</button>
        </div>
    </div>
</body>
</html>
<?php $conn->close(); ?>
