<?php

$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$baseDatos = "crud-db";

$conexion = new mysqli(
    $servidor,
    $usuario,
    $contrasena,
    $baseDatos
);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$direccion = $_POST['direccion'];

$sql = "INSERT INTO datosusuarios (nombre, apellido, direccion)
        VALUES ('$nombre', '$apellido', '$direccion')";

if ($conexion->query($sql) === TRUE) {
    echo "Usuario insertado correctamente.";
} else {
    echo "Error al insertar usuario: " . $conexion->error;
}

$conexion->close();

?>