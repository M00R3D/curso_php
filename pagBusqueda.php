<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $db_host="localhost";
    $db_user="root";
    $db_pass="";
    $db_name="cursophp";

    $x = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (!$x) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    mysqli_set_charset($x, "utf8");
    mysqli_select_db($x, $db_name) or die("Error no se encuentra la base de datos: " . mysqli_error($x));

    $q = isset($_GET['q']) ? trim($_GET['q']) : '';

    // Mensajes para feedback al usuario
    $message = '';
    $msg_type = '';

    // Mostrar mensaje tras redirección PRG
    if (isset($_GET['added']) && $_GET['added'] == '1') {
        $message = 'Usuario agregado correctamente.';
        $msg_type = 'success';
    } elseif (isset($_GET['deleted']) && $_GET['deleted'] == '1') {
        $message = 'Usuario eliminado correctamente.';
        $msg_type = 'success';
    }

    // Manejar formularios (alta / eliminación) en estilo clásico
    if (isset($_POST['accion']) && $_POST['accion'] == 'eliminar') {
        $id_delete = isset($_POST['id_usuario']) ? intval($_POST['id_usuario']) : 0;
        if ($id_delete > 0) {
            $del_sql = "DELETE FROM usuarios WHERE id = ?";
            $del_stmt = mysqli_prepare($x, $del_sql);
            if ($del_stmt) {
                mysqli_stmt_bind_param($del_stmt, 'i', $id_delete);
                if (mysqli_stmt_execute($del_stmt)) {
                    mysqli_stmt_close($del_stmt);
                    // PRG después de eliminar
                    $redirect_url = 'pagBusqueda.php';
                    if ($q !== '') {
                        $redirect_url .= '?q=' . urlencode($q) . '&deleted=1';
                    } else {
                        $redirect_url .= '?deleted=1';
                    }
                    header('Location: ' . $redirect_url);
                    exit;
                } else {
                    $message = 'Error al eliminar usuario: ' . mysqli_stmt_error($del_stmt);
                    $msg_type = 'error';
                }
                mysqli_stmt_close($del_stmt);
            } else {
                $message = 'Error en la consulta de eliminación.';
                $msg_type = 'error';
            }
        }
    }

    // Manejar envío del formulario de agregar usuario
    if (isset($_POST['accion']) && $_POST['accion'] == 'insertar') {
        $nombre = isset($_POST['name']) ? trim($_POST['name']) : '';
        $correo = isset($_POST['email']) ? trim($_POST['email']) : '';

        if ($nombre === '' || $correo === '') {
            $message = 'Nombre y correo son obligatorios.';
            $msg_type = 'error';
        } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $message = 'Correo no es válido.';
            $msg_type = 'error';
        } else {
            $insert_sql = "INSERT INTO usuarios (name, email) VALUES (?, ?)";
            $insert_stmt = mysqli_prepare($x, $insert_sql);
            if ($insert_stmt) {
                mysqli_stmt_bind_param($insert_stmt, 'ss', $nombre, $correo);
                if (mysqli_stmt_execute($insert_stmt)) {
                    mysqli_stmt_close($insert_stmt);
                    // PRG: evitar reenvío del formulario al recargar
                    $redirect_url = 'pagBusqueda.php';
                    // conservar posible búsqueda
                    if ($q !== '') {
                        $redirect_url .= '?q=' . urlencode($q) . '&added=1';
                    } else {
                        $redirect_url .= '?added=1';
                    }
                    header('Location: ' . $redirect_url);
                    exit;
                } else {
                    $message = 'Error al agregar usuario: ' . mysqli_stmt_error($insert_stmt);
                    $msg_type = 'error';
                }
                mysqli_stmt_close($insert_stmt);
            } else {
                $message = 'Error en la consulta de inserción.';
                $msg_type = 'error';
            }
        }
    }

    // Consulta de búsqueda o listado completo
    $stmt_busqueda = null;
    if (isset($_GET['buscar']) && $q !== '') {
        $sql = "SELECT id, name, email FROM usuarios WHERE name LIKE ? OR email LIKE ?";
        $stmt_busqueda = mysqli_prepare($x, $sql);
        if ($stmt_busqueda) {
            $like = "%" . $q . "%";
            mysqli_stmt_bind_param($stmt_busqueda, 'ss', $like, $like);
            mysqli_stmt_execute($stmt_busqueda);
            $result = mysqli_stmt_get_result($stmt_busqueda);
        } else {
            $result = false;
        }
    } else {
        $result = mysqli_query($x, "SELECT id, name, email FROM usuarios");
    }
    ?>

    <h1>Búsqueda de usuarios</h1>
    <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="text" name="q" placeholder="Buscar por nombre o correo" value="<?php echo htmlspecialchars($q); ?>">
        <input type="submit" name="buscar" value="Buscar">
        <?php if($q !== ''): ?>
            <a href="pagBusqueda.php">Limpiar</a>
        <?php endif; ?>
    </form>

    <h2>Agregar usuario</h2>
    <?php if ($message !== ''): ?>
        <p style="color: <?php echo $msg_type === 'success' ? 'green' : 'red'; ?>"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="accion" value="insertar">
        <label>Nombre: <input type="text" name="name" required></label>
        <label>Correo: <input type="email" name="email" required></label>
        <input type="submit" name="enviando" value="Agregar">
    </form>

    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <table border="1" cellpadding="6" cellspacing="0">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($fila['id']); ?></td>
                        <td><?php echo htmlspecialchars($fila['name']); ?></td>
                        <td><?php echo htmlspecialchars($fila['email']); ?></td>
                        <td>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="display:inline">
                                <input type="hidden" name="accion" value="eliminar">
                                <input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($fila['id']); ?>">
                                <input type="submit" name="eliminar" value="Eliminar" onclick="return confirm('Eliminar usuario ID <?php echo htmlspecialchars($fila['id']); ?>?')">
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No se encontraron usuarios.</p>
    <?php endif; ?>

    <?php
    if (isset($stmt_busqueda) && $stmt_busqueda) {
        mysqli_stmt_close($stmt_busqueda);
    }
    if (isset($result) && is_object($result)) {
        mysqli_free_result($result);
    }
    mysqli_close($x);
    ?>
</body>
</html>