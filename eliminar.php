<!-- eliminar.php -->
<?php
    $id = $_GET['id'];

    $servidor = "localhost";
    $usuario = "root";
    $contrasena = "";
    $baseDatos = "crud-db";

    $conexion = new mysqli($servidor, $usuario, $contrasena, $baseDatos);

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $sql = "DELETE FROM datosusuarios WHERE id=$id";

    if ($conexion->query($sql) === TRUE) {
        echo "Usuario eliminado correctamente.";
    } else {
        echo "Error al eliminar usuario: " . $conexion->error;
    }

    $conexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    volver a <a href="crud.php">la lista de usuarios</a>
</body>
</html>