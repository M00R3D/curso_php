<?php
ob_start();

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "cursophp";

$x = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$x) {
    die("Error de conexión: " . mysqli_connect_error());
}
mysqli_set_charset($x, "utf8");
mysqli_select_db($x, $db_name) or die("Error al seleccionar la base de datos: " . mysqli_error($x));

$message = '';
$msg_type = '';

if (isset($_GET['added'])) {
    if ($_GET['added'] == '1') {
        $message = "Producto agregado";
        $msg_type = "success";
    } else {
        $message = "Error al agregar el producto";
        $msg_type = "error";
    }
}
if (isset($_GET['updated'])) {
    if ($_GET['updated'] == '1') {
        $message = "Producto actualizado";
        $msg_type = "success";
    } else {
        $message = "Error al actualizar el producto";
        $msg_type = "error";
    }
}
if (isset($_GET['deleted'])) {
    if ($_GET['deleted'] == '1') {
        $message = "Producto eliminado";
        $msg_type = "success";
    } else {
        $message = "Error al eliminar el producto";
        $msg_type = "error";
    }
}

// Handle POST actions
if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];
    if ($accion == 'insertar' || $accion == 'crear') {
        $codigo_articulo = isset($_POST['codigo_articulo']) ? trim($_POST['codigo_articulo']) : '';
        $seccion = isset($_POST['seccion']) ? trim($_POST['seccion']) : '';
        $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
        $precio = isset($_POST['precio']) ? floatval($_POST['precio']) : 0;
        $fecha = isset($_POST['fecha']) ? trim($_POST['fecha']) : '';
        $importado = isset($_POST['importado']) ? intval($_POST['importado']) : 0;
        $pais_origen = isset($_POST['pais_origen']) ? trim($_POST['pais_origen']) : '';
        $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';

        $stmt = mysqli_prepare($x, "INSERT INTO productos (codigo_articulo, seccion, nombre, precio, fecha, importado, pais_origen, descripcion) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssdsiss", $codigo_articulo, $seccion, $nombre, $precio, $fecha, $importado, $pais_origen, $descripcion);
            $ok = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } else {
            $ok = false;
        }

        if ($ok) {
            header("Location: pagProducts.php?added=1");
            exit();
        } else {
            header("Location: pagProducts.php?added=0");
            exit();
        }
    } elseif ($accion == 'editar') {
        $id_edit = isset($_POST['id_edit']) ? intval($_POST['id_edit']) : 0;
        $codigo_articulo_edit = isset($_POST['codigo_articulo_edit']) ? trim($_POST['codigo_articulo_edit']) : '';
        $seccion_edit = isset($_POST['seccion_edit']) ? trim($_POST['seccion_edit']) : '';
        $nombre_edit = isset($_POST['nombre_edit']) ? trim($_POST['nombre_edit']) : '';
        $precio_edit = isset($_POST['precio_edit']) ? floatval($_POST['precio_edit']) : 0;
        $fecha_edit = isset($_POST['fecha_edit']) ? trim($_POST['fecha_edit']) : '';
        $importado_edit = isset($_POST['importado_edit']) ? intval($_POST['importado_edit']) : 0;
        $pais_origen_edit = isset($_POST['pais_origen_edit']) ? trim($_POST['pais_origen_edit']) : '';
        $descripcion_edit = isset($_POST['descripcion_edit']) ? trim($_POST['descripcion_edit']) : '';

        $stmt = mysqli_prepare($x, "UPDATE productos SET codigo_articulo = ?, seccion = ?, nombre = ?, precio = ?, fecha = ?, importado = ?, pais_origen = ?, descripcion = ? WHERE id = ?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssdsissi", $codigo_articulo_edit, $seccion_edit, $nombre_edit, $precio_edit, $fecha_edit, $importado_edit, $pais_origen_edit, $descripcion_edit, $id_edit);
            $ok = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } else {
            $ok = false;
        }

        if ($ok) {
            header("Location: pagProducts.php?updated=1");
            exit();
        } else {
            header("Location: pagProducts.php?updated=0");
            exit();
        }
    } elseif ($accion == 'eliminar') {
        $id_delete = isset($_POST['id_delete']) ? intval($_POST['id_delete']) : 0;

        $stmt = mysqli_prepare($x, "DELETE FROM productos WHERE id = ?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $id_delete);
            $ok = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } else {
            $ok = false;
        }

        if ($ok) {
            header("Location: pagProducts.php?deleted=1");
            exit();
        } else {
            header("Location: pagProducts.php?deleted=0");
            exit();
        }
    }
}

// Fetch products
$result = false;
$stmt = mysqli_prepare($x, "SELECT id, codigo_articulo, seccion, nombre, precio, fecha, importado, pais_origen, descripcion FROM productos ORDER BY id DESC");
if ($stmt) {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Productos</title>
    <style>
        body{font-family: Arial, Helvetica, sans-serif; padding:20px}
        .message{padding:10px;border-radius:4px;margin-bottom:12px}
        .message.success{background:#e6ffed;color:#046c2e}
        .message.error{background:#ffe6e6;color:#8a1c1c}
        table{width:100%;border-collapse:collapse;margin-top:12px}
        th,td{border:1px solid #ddd;padding:8px;text-align:left}
        .actions{display:flex;gap:8px}
        .edit-row{display:none}
        form.inline{display:inline}
        .form-inline input[type=text]{padding:6px;margin-right:6px}
    </style>
</head>
<body>

    <h1>Gestión de Productos</h1>

    <?php if ($message): ?>
        <div class="message <?php echo $msg_type; ?>"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <h2>Agregar producto</h2>
    <form method="post" action="pagProducts.php">
        <input type="hidden" name="accion" value="insertar">
        <input type="text" name="codigo_articulo" placeholder="Código Artículo" required>
        <input type="text" name="seccion" placeholder="Sección" required>
        <input type="text" name="nombre" placeholder="Nombre Artículo" required>
        <input type="text" name="precio" placeholder="Precio" required>
        <input type="date" name="fecha" required>
        <select name="importado" required>
            <option value="0">No importado</option>
            <option value="1">Importado</option>
        </select>
        <input type="text" name="pais_origen" placeholder="País de Origen" required>
        <input type="text" name="descripcion" placeholder="Descripción">
        <button type="submit">Agregar</button>
    </form>

    <h2>Productos</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Sección</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Fecha</th>
                <th>Importado</th>
                <th>País Origen</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($result): ?>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr id="row-<?php echo $row['id']; ?>">
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['codigo_articulo']); ?></td>
                <td><?php echo htmlspecialchars($row['seccion']); ?></td>
                <td class="name-cell"><?php echo htmlspecialchars($row['nombre']); ?></td>
                <td class="price-cell"><?php echo htmlspecialchars($row['precio']); ?></td>
                <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                <td><?php echo intval($row['importado']) === 1 ? 'Sí' : 'No'; ?></td>
                <td><?php echo htmlspecialchars($row['pais_origen']); ?></td>
                <td class="description-cell"><?php echo htmlspecialchars($row['descripcion']); ?></td>
                <td>
                    <div class="actions">
                        <button type="button" onclick="showEdit(<?php echo $row['id']; ?>)">Editar</button>
                        <form method="post" class="inline" onsubmit="return confirm('¿Eliminar este producto?');">
                            <input type="hidden" name="accion" value="eliminar">
                            <input type="hidden" name="id_delete" value="<?php echo $row['id']; ?>">
                            <button type="submit">Eliminar</button>
                        </form>
                    </div>

                    <div class="edit-row" id="edit-<?php echo $row['id']; ?>">
                        <form method="post" action="pagProducts.php" class="form-inline">
                            <input type="hidden" name="accion" value="editar">
                            <input type="hidden" name="id_edit" value="<?php echo $row['id']; ?>">
                            <input type="text" name="codigo_articulo_edit" value="<?php echo htmlspecialchars($row['codigo_articulo']); ?>" required>
                            <input type="text" name="seccion_edit" value="<?php echo htmlspecialchars($row['seccion']); ?>" required>
                            <input type="text" name="nombre_edit" value="<?php echo htmlspecialchars($row['nombre']); ?>" required>
                            <input type="text" name="precio_edit" value="<?php echo htmlspecialchars($row['precio']); ?>" required>
                            <input type="date" name="fecha_edit" value="<?php echo htmlspecialchars($row['fecha']); ?>" required>
                            <select name="importado_edit" required>
                                <option value="0" <?php echo intval($row['importado']) === 0 ? 'selected' : ''; ?>>No importado</option>
                                <option value="1" <?php echo intval($row['importado']) === 1 ? 'selected' : ''; ?>>Importado</option>
                            </select>
                            <input type="text" name="pais_origen_edit" value="<?php echo htmlspecialchars($row['pais_origen']); ?>" required>
                            <input type="text" name="descripcion_edit" value="<?php echo htmlspecialchars($row['descripcion']); ?>" required>
                            <button type="submit">Guardar</button>
                            <button type="button" onclick="hideEdit(<?php echo $row['id']; ?>)">Cancelar</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="10">No se pudieron cargar los productos.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

    <script>
        function showEdit(id){
            document.getElementById('edit-'+id).style.display = 'block';
        }
        function hideEdit(id){
            document.getElementById('edit-'+id).style.display = 'none';
        }
    </script>

</body>
</html>