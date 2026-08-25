<!-- crud.php -->
<?php

$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$baseDatos = "crud-db";

// Conexión
$conexion = new mysqli($servidor, $usuario, $contrasena, $baseDatos);

// Comprobar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener datos
$sql = "SELECT * FROM datosusuarios";
$resultado = $conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Datos de usuarios</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }

        .btn {
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            color: white;
        }

        .editar {
            background-color: #007bff;
        }

        .insertar {
            background-color: #94b113;
        }

        .eliminar {
            background-color: #dc3545;
        }
    </style>
</head>

<body>

    <h1>Datos de usuarios</h1>
                <a href="insertar.php"
                    class="btn insertar"
                >
                        Insertar
                </a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

        <?php
        if ($resultado->num_rows > 0) {

            while ($fila = $resultado->fetch_assoc()) {
        ?>

            <tr>
                <td><?php echo $fila["id"]; ?></td>
                <td><?php echo $fila["nombre"]; ?></td>
                <td><?php echo $fila["apellido"]; ?></td>
                <td><?php echo $fila["direccion"]; ?></td>

                <td>
                    
                    <a 
                        class="btn editar"
                        href="editar.php?id=<?php echo $fila["id"]; ?>"
                    >
                        Editar
                    </a>

                    <a 
                        class="btn eliminar"
                        href="eliminar.php?id=<?php echo $fila["id"]; ?>"
                        onclick="return confirm('¿Seguro que quieres eliminar este usuario?');"
                    >
                        Eliminar
                    </a>
                </td>
            </tr>

        <?php
            }

        } else {
        ?>

            <tr>
                <td colspan="5">No hay usuarios registrados.</td>
            </tr>

        <?php
        }
        ?>

        </tbody>
    </table>

</body>
</html>

<?php
$conexion->close();
?>