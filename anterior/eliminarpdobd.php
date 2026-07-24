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
        $id=$_POST['id'] ?? '';
        $nombre=$_POST['nombre'] ?? '';
        $precio=$_POST['precio'] ?? '';
        $descripcion=$_POST['descripcion'] ?? '';
        try {
            $conexion = new PDO("mysql:host=localhost;dbname=pdobd", "root", "");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexion->exec("SET CHARACTER SET utf8");
            echo "Conexión establecida";
            $consulta ="DELETE FROM PRODUCTOS WHERE ID = :id";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(':id' => $id));
            echo "Registro eliminado correctamente";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }finally {
            $conexion = null;
        }
    ?>
</body>
</html>