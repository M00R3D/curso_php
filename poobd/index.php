<?php
require ("getProductos.php");
$pais = $_GET["buscar"];
$productos = new getProductos();
$array_productos = $productos->get_productos_pais($pais);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .highlight{
        color: red;
        font-weight: bold;
    }
    form{
        margin-top: 20px;
        background-color: #f2f2f2;
        padding: 10px;  
    }
    input[type="text"]{
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    input[type="submit"]{
        background-color: blue;
        color: white;
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;

    }
    body{
        font-family: Arial, sans-serif;
        font-size:20px;
        display: flex;
        flex-direction: column;
    }
</style>
<body>

        <table width="50%" border="0" cellspacing="0" cellpadding="4">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Descripción</th>
                <th>Pais</th>
            </tr>
            <?php
            foreach($array_productos as $producto){
                echo "<tr>";
                echo "<td>" . $producto['ID'] . "</td>";
                echo "<td>" . $producto['NOMBRE'] . "</td>";
                echo "<td>" . $producto['PRECIO'] . "</td>";
                echo "<td>" . $producto['DESCRIPCION'] . "</td>";
                echo "<td>" . $producto['PAIS'] . "</td>";
                echo "</tr>";
            }
            ?>
        
        </table>
</body>
</html>
