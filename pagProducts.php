<?php ob_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
</body>
    <?php
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "cursophp";

    $x=mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if(!$x){
        die("Error de conexión: " . mysqli_connect_error());
    }
    mysqli_set_charset($x, "utf8");
    mysqli_select_db($x, $db_name) or die("Error al seleccionar la base de datos: " . mysqli_error($x));   

    $q = isset($_GET['q']) ? $_GET['q'] : '';

    $message='';
    $msg_type='';


    if(isset($_GET['added']) && $_GET['added'] == '1'){
        $message = "Producto agregado ";
        $msg_type = "success";
    } elseif (isset($_GET['deleted']) && $_GET['deleted'] == '1') {
        $message = "Error al agregar el producto";
        $msg_type = "error";
    }elseif(isset($_GET['updated']) && $_GET['updated'] == '1'){
        $message = "Producto actualizado";
        $msg_type = "success";
    } elseif (isset($_GET['updated']) && $_GET['updated'] == '0') {
        $message = "Error al actualizar el producto";
        $msg_type = "error";
    }
    if(isset($_POST['accion']) && $_POST['accion'] == 'crear') 
        {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
            $precio = isset($_POST['precio']) ? $_POST['precio'] : '';
            $sql_insert = "INSERT INTO productos (nombre, precio) VALUES ('$nombre', '$precio')";
            if (mysqli_query($x, $sql_insert)) {
                header("Location: pagProducts.php?added=1");
                exit();
            } else {
                header("Location: pagProducts.php?added=0");
                exit();
            }
        }
    if(isset($_POST['accion']) && $_POST['accion'] == 'insertar')
        {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
            $precio = isset($_POST['precio']) ? $_POST['precio'] : '';
            $sql_insert = "INSERT INTO productos (nombre, precio) VALUES ('$nombre', '$precio')";
            if (mysqli_query($x, $sql_insert)) {
                header("Location: pagProducts.php?added=1");
                exit();
            } else {
                header("Location: pagProducts.php?added=0");
                exit();
            }
        }
    if(isset($_POST['accion']) && $_POST['accion'] == 'editar') 
        {
        $id_edit = isset($_POST['id_edit']) ? $_POST['id_edit'] : '';
        $nombre_edit = isset($_POST['nombre_edit']) ? $_POST['nombre_edit'] : '';
        $precio_edit = isset($_POST['precio_edit']) ? $_POST['precio_edit'] : '';
        $sql_update = "UPDATE productos SET nombre='$nombre_edit', precio='$precio_edit' WHERE id='$id_edit'";
        if (mysqli_query($x, $sql_update)) {
            header("Location: pagProducts.php?updated=1");
            exit();
        } else {
            header("Location: pagProducts.php?updated=0");
            exit();
        }
        }
    if(isset($_POST['accion']) && $_POST['accion'] == 'eliminar') 
        {
            $id_delete = isset($_POST['id_delete']) ? $_POST['id_delete'] : '';
            $sql_delete = "DELETE FROM productos WHERE id='$id_delete'";
            if (mysqli_query($x, $sql_delete)) {
                header("Location: pagProducts.php?deleted=1");
                exit();
            } else {
                header("Location: pagProducts.php?deleted=0");
                exit();
            }
        }
        ?>
</html>