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
        $nombre=$_POST['nombre'] ?? '';
        $precio=$_POST['precio'] ?? '';
        $descripcion=$_POST['descripcion'] ?? '';
        try {
            $conexion = new PDO("mysql:host=localhost;dbname=pdobd", "root", "");
            //en esta linea usamos PDO para conectarnos a la base de datos, en este caso es mysql, el host es localhost, el nombre de la base de datos es pdobd, el usuario es root y la contraseña es vacía
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //esta linea sirve para que PDO nos muestre los errores en caso de que ocurra alguno tratandolo como objeto, es decir, que nos muestre el error en un formato más legible y fácil de entender
            $conexion->exec("SET CHARACTER SET utf8");
            //esta linea sirve para que los acentos y caracteres especiales se muestren correctamente

            echo "Conexión establecida";

            $consulta ="INSERT INTO PRODUCTOS(NOMBRE, PRECIO, DESCRIPCION) VALUES(:n_prod, :p_prod, :d_prod)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(':n_prod' => $nombre, ':p_prod' => $precio, ':d_prod' => $descripcion));
            echo "Registro insertado correctamente";

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