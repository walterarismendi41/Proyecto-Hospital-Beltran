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

// Manejar búsqueda
$search = "";
if(isset($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $sql = "SELECT id_paciente, nombre, apellido, dni, telefono, email, id_direcciones 
            FROM pacientes 
            WHERE nombre LIKE '%$search%' 
               OR apellido LIKE '%$search%' 
               OR dni LIKE '%$search%' 
               OR telefono LIKE '%$search%' 
               OR email LIKE '%$search%' 
               OR id_direcciones LIKE '%$search%'";
} else {
    $sql = "SELECT id_paciente, nombre, apellido, dni, telefono, email, id_direcciones FROM pacientes";
}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Pacientes</title>
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
            <h1>Listado de Pacientes</h1>

            <!-- Barra de búsqueda -->
            <form method="GET" action="listar.php" style="margin-bottom: 20px;">
                <input type="text" name="search" placeholder="Buscar paciente..." value="<?php echo htmlspecialchars($search); ?>" />
                <button type="submit">Buscar</button>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>DNI</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>".$row['id_paciente']."</td>
                                <td>".$row['nombre']."</td>
                <td>".$row['apellido']."</td>
                <td>".$row['dni']."</td>
                <td>".$row['telefono']."</td>
                <td>".$row['email']."</td>
                <td class='acciones'>
                    <a href='editar.php?id_paciente=".$row['id_paciente']."' class='btn editar' title='Editar'>✏️</a>
                    <a href='eliminar.php?id_paciente=".$row['id_paciente']."' class='btn eliminar' onclick=\"return confirm('¿Seguro que quieres borrar este paciente?');\" title='Borrar'>🗑️</a>
                    <a href='imprimir.php?id_paciente=".$row['id_paciente']."' class='btn imprimir' target='_blank' title='Imprimir'>🖨️</a>

                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='8'>No hay pacientes registrados.</td></tr>";
}
?>

                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
<?php $conn->close(); ?>
