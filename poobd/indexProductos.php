<!-- poobd\indexProductos.php -->
<?php
require ("getProductos.php");
$productos = new getProductos();
$array_productos = $productos->get_productos();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
    // echo "<pre>";
    // print_r($array_productos);
    // echo "</pre>";
    foreach($array_productos as $producto){
            echo "<h2>Producto ID: " . $producto['ID'] . "</h2>";
            echo "<p>Nombre: " . $producto['NOMBRE'] . "</p>";
            echo "<p>Precio: " . $producto['PRECIO'] . "</p>";
            echo "<p>Descripción: " . $producto['DESCRIPCION'] . "</p>";
            echo "<hr>";
        }
    ?>
</body>
</html>