<!-- busquedapdobd.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            display: grid;
            padding-left: 30%;
            padding-top: 5%;
            background-color: #8595a3;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            display: block;
        }
        th {
            display: block;
        }
    </style>
</head>
<body>
    <form action="eliminarpdobd.php" method="post">
        <table>
            <tr>
                <td><label>Id:<input type="text" name="id"></label></td>
            </tr>
            <tr>
                <td><input type="submit" value="Eliminar"></td>
            </tr>
        </table>
    </form>
   <?php
   
   $id = $_POST['id'] ?? '';
   $nombre = $_POST['nombre'] ?? '';
   $precio = $_POST['precio'] ?? '';
   $descripcion = $_POST['descripcion'] ?? '';
   if ($id !== '') {
       try {
           $conexion = new PDO("mysql:host=localhost;dbname=pdobd", "root", "");
           $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           $conexion->exec("SET CHARACTER SET utf8");

          

           // Delete statement
           $consulta = "DELETE FROM PRODUCTOS WHERE ID = :id";
           $resultado = $conexion->prepare($consulta);
           $resultado->execute([':id' => $id]);
           echo "Registro eliminado correctamente";
       } catch (PDOException $e) {
           echo "Error: " . $e->getMessage();
       } finally {
           $conexion = null;
       }
   }
   ?>


</body>
</html>
