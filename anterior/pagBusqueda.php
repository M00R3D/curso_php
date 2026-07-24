<?php ob_start(); ?>
<!-- el ob_start(); se usa para para activar el almacenamiento en búfer de salida (output buffering). Esto permite que el script guarde todo el contenido generado (HTML, echo, print) en un búfer interno en lugar de enviarlo inmediatamente al navegador. -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }
        .modal-box {
            background: #fff;
            width: 90%;
            max-width: 420px;
            margin: 80px auto;
            padding: 16px;
            border: 1px solid #999;
        }
    </style>
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
    } elseif (isset($_GET['updated']) && $_GET['updated'] == '1') {
        $message = 'Usuario actualizado correctamente.';
        $msg_type = 'success';
    }

    // Manejar formulario de editar usuario
    if (isset($_POST['accion']) && $_POST['accion'] == 'editar') {
        $id_edit = isset($_POST['id_usuario']) ? intval($_POST['id_usuario']) : 0;
        $nombre_edit = isset($_POST['name']) ? trim($_POST['name']) : '';
        $correo_edit = isset($_POST['email']) ? trim($_POST['email']) : '';

        if ($id_edit <= 0 || $nombre_edit === '' || $correo_edit === '') {
            $message = 'Datos inválidos para editar usuario.';
            $msg_type = 'error';
        } elseif (!filter_var($correo_edit, FILTER_VALIDATE_EMAIL)) {
            $message = 'Correo no es válido.';
            $msg_type = 'error';
        } else {
            $upd_sql = "UPDATE usuarios SET name = ?, email = ? WHERE id = ?";
            $upd_stmt = mysqli_prepare($x, $upd_sql);
            if ($upd_stmt) {
                mysqli_stmt_bind_param($upd_stmt, 'ssi', $nombre_edit, $correo_edit, $id_edit);
                if (mysqli_stmt_execute($upd_stmt)) {
                    mysqli_stmt_close($upd_stmt);
                    // PRG después de editar
                    $redirect_url = 'pagBusqueda.php';
                    if ($q !== '') {
                        $redirect_url .= '?q=' . urlencode($q) . '&updated=1';
                    } else {
                        $redirect_url .= '?updated=1';
                    }
                    header('Location: ' . $redirect_url);
                    exit;
                } else {
                    $message = 'Error al actualizar usuario: ' . mysqli_stmt_error($upd_stmt);
                    $msg_type = 'error';
                }
                mysqli_stmt_close($upd_stmt);
            } else {
                $message = 'Error en la consulta de actualización.';
                $msg_type = 'error';
            }
        }
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
                            <input
                                type="button"
                                value="Editar"
                                data-id="<?php echo htmlspecialchars($fila['id']); ?>"
                                data-name="<?php echo htmlspecialchars($fila['name'], ENT_QUOTES); ?>"
                                data-email="<?php echo htmlspecialchars($fila['email'], ENT_QUOTES); ?>"
                                onclick="abrirModalEditar(this)">
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

    <div id="modalEditar" class="modal-overlay">
        <div class="modal-box">
            <h3>Editar usuario</h3>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="accion" value="editar">
                <input type="hidden" name="id_usuario" id="edit_id" value="">
                <p>
                    <label>Nombre:</label>
                    <input type="text" name="name" id="edit_name" required>
                </p>
                <p>
                    <label>Correo:</label>
                    <input type="email" name="email" id="edit_email" required>
                </p>
                <input type="submit" value="Guardar cambios">
                <input type="button" value="Cancelar" onclick="cerrarModalEditar()">
            </form>
        </div>
    </div>

    <script>
        function abrirModalEditar(btn) {
            document.getElementById('edit_id').value = btn.getAttribute('data-id');
            document.getElementById('edit_name').value = btn.getAttribute('data-name');
            document.getElementById('edit_email').value = btn.getAttribute('data-email');
            document.getElementById('modalEditar').style.display = 'block';
        }

        function cerrarModalEditar() {
            document.getElementById('modalEditar').style.display = 'none';
        }

        window.onclick = function (event) {
            var modal = document.getElementById('modalEditar');
            if (event.target === modal) {
                cerrarModalEditar();
            }
        };
    </script>

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