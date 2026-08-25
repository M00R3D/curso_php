<?php

$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$baseDatos = "crud-db";

$conexion = new mysqli($servidor, $usuario, $contrasena, $baseDatos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Solo ejecutar el INSERT cuando se envió el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {

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
}

$conexion->close();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Usuario</title>
</head>

<body>

    <h1>Insertar Usuario</h1>

    <form action="insertar.php" method="POST">

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br><br>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>
        <br><br>

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" required>
        <br><br>

        <input type="submit" value="Insertar">

    </form>

    <br>

    <a href="crud.php">Volver a la lista de usuarios</a>

</body>

</html>
