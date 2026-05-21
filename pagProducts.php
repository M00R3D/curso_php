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
        $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($x, $_POST['nombre']) : '';
        $precio = isset($_POST['precio']) ? mysqli_real_escape_string($x, $_POST['precio']) : '';
        $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($x, $_POST['descripcion']) : '';
        $sql_insert = "INSERT INTO productos (nombre, precio, descripcion) VALUES ('$nombre', '$precio', '$descripcion')";
        if (mysqli_query($x, $sql_insert)) {
            header("Location: pagProducts.php?added=1");
            exit();
        } else {
            header("Location: pagProducts.php?added=0");
            exit();
        }
    } elseif ($accion == 'editar') {
        $id_edit = isset($_POST['id_edit']) ? intval($_POST['id_edit']) : 0;
        $nombre_edit = isset($_POST['nombre_edit']) ? mysqli_real_escape_string($x, $_POST['nombre_edit']) : '';
        $precio_edit = isset($_POST['precio_edit']) ? mysqli_real_escape_string($x, $_POST['precio_edit']) : '';
        $sql_update = "UPDATE productos SET nombre='$nombre_edit', precio='$precio_edit' WHERE id='$id_edit'";
        if (mysqli_query($x, $sql_update)) {
            header("Location: pagProducts.php?updated=1");
            exit();
        } else {
            header("Location: pagProducts.php?updated=0");
            exit();
        }
    } elseif ($accion == 'eliminar') {
        $id_delete = isset($_POST['id_delete']) ? intval($_POST['id_delete']) : 0;
        $sql_delete = "DELETE FROM productos WHERE id='$id_delete'";
        if (mysqli_query($x, $sql_delete)) {
            header("Location: pagProducts.php?deleted=1");
            exit();
        } else {
            header("Location: pagProducts.php?deleted=0");
            exit();
        }
    }
}

// Fetch products
$result = mysqli_query($x, "SELECT * FROM productos ORDER BY id DESC");

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
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="precio" placeholder="Precio" required>
        <input type="text" name="descripcion" placeholder="Descripción">
        <button type="submit">Agregar</button>
    </form>

    <h2>Productos</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr id="row-<?php echo $row['id']; ?>">
                <td><?php echo $row['id']; ?></td>
                <td class="name-cell"><?php echo htmlspecialchars($row['nombre']); ?></td>
                <td class="price-cell"><?php echo htmlspecialchars($row['precio']); ?></td>
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
                            <input type="text" name="nombre_edit" value="<?php echo htmlspecialchars($row['nombre']); ?>" required>
                            <input type="text" name="precio_edit" value="<?php echo htmlspecialchars($row['precio']); ?>" required>
                            <input type="text" name="descripcion_edit" value="<?php echo htmlspecialchars($row['descripcion']); ?>" required>
                            <button type="submit">Guardar</button>
                            <button type="button" onclick="hideEdit(<?php echo $row['id']; ?>)">Cancelar</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endwhile; ?>
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