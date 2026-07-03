<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        try {
            $conexion = new PDO("mysql:host=localhost;dbname=pdobd", "root", "");
            $conexion->exec("SET CHARACTER SET utf8");
            echo "Conexión establecida";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    ?>
</body>
</html>