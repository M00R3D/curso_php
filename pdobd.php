<!-- pdobd.php -->
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $nombre=$_GET['nombre'] ?? '';
        $precio=$_GET['precio'] ?? '';
        try {
            $conexion = new PDO("mysql:host=localhost;dbname=pdobd", "root", "");
            //en esta linea usamos PDO para conectarnos a la base de datos, en este caso es mysql, el host es localhost, el nombre de la base de datos es pdobd, el usuario es root y la contraseña es vacía

            $conexion->exec("SET CHARACTER SET utf8");
            //esta linea sirve para que los acentos y caracteres especiales se muestren correctamente

            echo "Conexión establecida";

            $consulta ="SELECT NOMBRE, PRECIO, DESCRIPCION, ID FROM PRODUCTOS WHERE NOMBRE = :n_prod AND PRECIO = :p_prod";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(':n_prod' => $nombre, ':p_prod' => $precio));
            while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){

                echo "<table border='1'>";
                echo "<tr><th>Nombre</th><th>Precio</th><th>Descripción</th><th>ID</th></tr>";
                echo "<tr>";
                echo "<td>" . $registro['NOMBRE'] . "</td>";
                echo "<td>" . $registro['PRECIO'] . "</td>";
                echo "<td>" . $registro['DESCRIPCION'] . "</td>";
                echo "<td>" . $registro['ID'] . "</td>";
                echo "</tr>";
                echo "</table>";
            }
            
            //TODAS ESTAS LINEAS COMENTADAS NOS DARIAN ERROR PORQUE HAY QUE USAR FETCH_ASSOC PARA QUE NOS DEVUELVA UN ARRAY ASOCIATIVO Y NO UN OBJETO, YA QUE PDO POR DEFECTO DEVUELVE UN OBJETO.
            // echo $resultado;
            // echo "<table border='1'>";
            // echo "<tr><th>Nombre</th><th>Precio</th><th>Descripción</th><th>ID</th></tr>";
            // while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
            //     echo "<tr>";
            //     echo "<td>" . $fila['NOMBRE'] . "</td>";
            //     echo "<td>" . $fila['PRECIO'] . "</td>";
            //     echo "<td>" . $fila['DESCRIPCION'] . "</td>";
            //     echo "<td>" . $fila['ID'] . "</td>";
            //     echo "</tr>";
            // }
            // echo "</table>";
        } catch (PDOException $e) {
            //en este bloque de código se captura la excepción en caso de que ocurra un error al conectarse a la base de datos
            echo "Error: " . $e->getMessage();
        }finally {
            //en este bloque de código se cierra la conexión a la base de datos, aunque no es estrictamente necesario ya que PHP lo hace automáticamente al finalizar el script
            $conexion = null;
        }
    ?>
</body>
</html>