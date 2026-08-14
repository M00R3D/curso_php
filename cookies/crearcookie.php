<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if(isset($_GET["idioma"])){
            $idioma = $_GET["idioma"];
            setcookie("idioma", $idioma, time() + 86400, "/");
            echo "Cookie creada con éxito";
            header("Location: ver_cookie.php");
        }else{
            echo "No se ha seleccionado ningún idioma";
        }
    ?>
</body>
</html>