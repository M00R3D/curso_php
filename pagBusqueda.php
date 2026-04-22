<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "cursophp";

    $x = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (!$x) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    mysqli_set_charset($x, "utf8");

    $q = isset($_GET['q']) ? trim($_GET['q']) : '';

    if ($q !== '') {
        $sql = "SELECT id, nombre, correo FROM usuarios WHERE nombre LIKE ? OR correo LIKE ?";//en esta linea se usa LIKE ? porque se va a usar una consulta preparada, y los signos de interrogación son marcadores de posición para los parámetros que se van a enlazar posteriormente. Esto ayuda a prevenir inyecciones SQL y mejora la seguridad de la aplicación.
        $stmt = mysqli_prepare($x, $sql);//en esta línea se prepara la consulta SQL utilizando la función mysqli_prepare(). El primer argumento es la conexión a la base de datos ($x) y el segundo argumento es la consulta SQL con los marcadores de posición (?). La función devuelve un objeto de declaración preparado ($stmt) que se puede usar para ejecutar la consulta con los parámetros enlazados posteriormente.
         if ($stmt) {
            //en este bloque se verifica si la preparación de la consulta fue exitosa. Si $stmt es verdadero, significa que la consulta se preparó correctamente y se puede proceder a enlazar los parámetros y ejecutar la consulta. Si $stmt es falso, significa que hubo un error al preparar la consulta, y en ese caso se asigna false a $result para indicar que no se obtuvieron resultados.
            $like = "%" . $q . "%";
            mysqli_stmt_bind_param($stmt, 'ss', $like, $like);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        } else {
            $result = false;
        }
    } else {
        $result = mysqli_query($x, "SELECT id, nombre, correo FROM usuarios");
    }
    ?>

    <h1>Búsqueda de usuarios</h1>
    <form method="get" action="">
        <input type="text" name="q" placeholder="Buscar por nombre o correo" value="<?php echo htmlspecialchars($q); ?>">
        <button type="submit">Buscar</button>
        <?php if($q !== ''): ?>
            <a href="pagBusqueda.php">Limpiar</a>
        <?php endif; ?>
    </form>

    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <table border="1" cellpadding="6" cellspacing="0">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = mysqli_fetch_assoc($result)): ?>//aqui usamos while para recorrer cada fila del resultado de la consulta. La función mysqli_fetch_assoc() devuelve un array asociativo que representa la fila actual del resultado, donde las claves son los nombres de las columnas. El bucle continúa hasta que no haya más filas para procesar.
                    <tr>
                        <td><?php echo htmlspecialchars($fila['id']); ?></td>
                        <td><?php echo htmlspecialchars($fila['nombre']); ?></td>
                        
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No se encontraron usuarios.</p>
    <?php endif; ?>

    <?php
    if (isset($stmt) && $stmt) {
        mysqli_stmt_close($stmt);
    }
    if (isset($result) && is_object($result)) {
        mysqli_free_result($result);
    }
    mysqli_close($x);
    ?>
</body>
</html>