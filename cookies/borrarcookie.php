<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        try{setcookie("idioma", "", time() -1, "/");}
        catch(Exception $e){echo "Error al eliminar la cookie: " . $e->getMessage();}
    ?>
</body>
</html>