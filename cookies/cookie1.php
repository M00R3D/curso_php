<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        setcookie("prueba", "esta es la información de la cookieeeeeeee", time() + 50, "/");
        // setcookie("prueba", "esta es la información de la cookieeeeeeee", time() -1, "/");
        //agregar el time-1 es la manera de eliminar la cookie, ya que le estamos dando un tiempo negativo, por lo que el navegador la elimina
    ?>
</body>
</html>