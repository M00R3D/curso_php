<?php

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$direccion = $_POST['direccion'];

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

$sql = "UPDATE datosusuarios 
        SET nombre='$nombre', 
            apellido='$apellido', 
            direccion='$direccion' 
        WHERE id=$id";

if ($conexion->query($sql) === TRUE) {
    echo "Usuario actualizado correctamente.";
} else {
    echo "Error al actualizar usuario: " . $conexion->error;
}

$conexion->close();

?>