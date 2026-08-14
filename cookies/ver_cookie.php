<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if(!isset($_COOKIE["idioma"])){
            echo "No se ha seleccionado ningún idioma";
            header("Location: seleccion_idioma.php");
        }else if($_COOKIE["idioma"] == "es"){
            echo "El idioma seleccionado es: Español";
            header("Location: pag_es.php");
        }else if($_COOKIE["idioma"] == "en"){
            echo "El idioma seleccionado es: Inglés";
            header("Location: pag_en.php");
        }
    ?>
</body>
</html>