<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $conexion = mysqli_connect("localhost", "root", "", "cursophp");
        if($conexion->connect_errno){
            die("Error al conectar a la base de datos: " . $conexion->connect_errno);
        }
        $conexion->set_charset("utf8");
        $sql = "SELECT * FROM productos";
        $resultado = $conexion->query($sql);
        if($conexion->connect_errno){
            die("Error al conectar a la base de datos: " . $conexion->connect_errno);
        }
        // while($fila=$resultado->fetch_assoc()){
        //     echo "<table><tr><td>";
        // echo $fila['id'] . "<td></td>";
        // echo $fila['codigo_articulo'] . "<td></td>";
        // echo $fila['seccion'] . "<td>  </td>";
        // echo $fila['nombre'] . "<td>  </td>";
        // echo $fila['precio'] . "<td>  </td>";
        // echo $fila['fecha'] . "<td>  </td>";
        // echo $fila['pais_origen'] . "<td>  </td>";
        // echo $fila['importado'] . "<td>  </td>";
        // echo $fila['descripcion'] . "<td>  </td>";

        // }
        while($fila=$resultado->fetch_array()){
        echo "<table><tr><td>";
        echo $fila[0] . "<td></td>";
        echo $fila[1] . "<td></td>";
        echo $fila[2] . "<td></td>";
        echo $fila[3] . "<td></td>";
        echo $fila[4] . "<td></td>";
        echo $fila[5] . "<td></td>";
        echo $fila[6] . "<td></td>";
        echo $fila[7] . "<td></td>";
        echo $fila[8] . "<td></td>";
        }
    ?>
</body>
</html>