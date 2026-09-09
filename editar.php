<!-- editar.php -->
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

$sql = "SELECT * FROM datosusuarios WHERE id=$id";

$resultado = $conexion->query($sql);

$fila = $resultado->fetch_assoc();

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Usuario</title>

</head>

<body>

    <h1>Editar Usuario</h1>

    <form action="actualizar.php" method="POST">

        <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">

        <label for="nombre">Nombre:</label>

        <input
            type="text"
            id="nombre"
            name="nombre"
            value="<?php echo $fila['nombre']; ?>"
            required
        >

        <br><br>

        <label for="apellido">Apellido:</label>

        <input
            type="text"
            id="apellido"
            name="apellido"
            value="<?php echo $fila['apellido']; ?>"
            required
        >

        <br><br>

        <label for="direccion">Dirección:</label>

        <input
            type="text"
            id="direccion"
            name="direccion"
            value="<?php echo $fila['direccion']; ?>"
            required
        >

        <br><br>

        <input type="submit" value="Actualizar">

    </form>

    <br>

    <a href="crud.php">Volver a la lista de usuarios</a>

</body>

</html>

<?php

$conexion->close();

?>
