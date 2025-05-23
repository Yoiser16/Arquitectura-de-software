<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "wastech", 3307);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener puntajes ordenados
$sql = "SELECT nombre_jugador, puntaje, fecha FROM puntajes ORDER BY puntaje DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Puntaje Global</title>
    <link rel="stylesheet" href="public\css\style.css"> <!-- Asegúrate que el estilo esté actualizado -->
</head>
<body>
    <h1>Puntaje Global</h1>
    <table>
        <thead>
            <tr>
                <th>Jugador</th>
                <th>Puntaje</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($fila = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($fila['nombre_jugador']) . "</td>
                            <td>" . htmlspecialchars($fila['puntaje']) . "</td>
                            <td>" . htmlspecialchars($fila['fecha']) . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No hay puntajes registrados</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php $conn->close(); ?>
