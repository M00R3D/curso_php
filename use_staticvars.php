<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include 'staticvars.php';
    

    $compra1 = new CompraPersonalizada();
    echo "<p>precio total de las compras: " . CompraPersonalizada::$precioTotal . "</p>";
    echo "<p>contador de compras: " . CompraPersonalizada::$contadorCompras .
    $compra1->actualizarColor("rojo");
    $compra1->actualizarCalidad("alta");

    echo "<br>";echo "<br>";
    echo "<p>precio total de las compras: " . CompraPersonalizada::$precioTotal . "</p>";
    echo "<p>color de la compra 1: " . $compra1->color . "</p>";
    echo "<p>calidad de la compra 1: " . $compra1->calidad . "</p>";
    ?>  
</body>
</html>