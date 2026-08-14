<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if(isset($_COOKIE["idioma"])){
        header("Location: ver_cookie.php");
    }else{
        echo "No se ha seleccionado ningún idioma, seleccione uno para ver la página en el idioma correspondiente";
    }
    ?>
    <p>Tabla de selección de idioma</p>
    <table border="1">
        <tr></tr>
            <td><a href="crearcookie.php?idioma=es" style="background-color: #a34a4a;">Español</a></td>
            <td><a href="crearcookie.php?idioma=en" style="background-color: #6fafbe;">Inglés</a></td>
        </tr>
    </table>
</body>
</html>