<?php
$conexion = new mysqli("localhost", "root", "", "wastech", 3307);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$datos = json_decode(file_get_contents("php://input"), true);

$nombre = $conexion->real_escape_string($datos['nombre']);
$puntaje = (int)$datos['puntaje'];

$sql = "INSERT INTO puntajes (nombre_jugador, puntaje) VALUES ('$nombre', $puntaje)";

if ($conexion->query($sql)) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $conexion->error]);
}

$conexion->close();
