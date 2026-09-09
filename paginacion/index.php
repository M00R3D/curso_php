<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    try{
        $base=new PDO ("mysql:host=localhost; dbname=crud-db", "root", "");
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $base->exec("SET CHARACTER SET utf8");
        $sql_total="SELECT id,nombre,apellido,direccion FROM datosusuarios LIMIT 0,3";
        $resultado=$base->prepare($sql_total);
        $resultado->execute(array());
        while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
            echo "ID: " . $registro['id'] . "<br>";
            echo "Nombre: " . $registro['nombre'] . "<br>";
            echo "Apellido: " . $registro['apellido'] . "<br>";
            echo "Dirección: " . $registro['direccion'] . "<br><br>";
        }
        $resultado->closeCursor();
    }
    catch (PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    ?>
</body>
</html>