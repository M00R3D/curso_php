<?php

session_start();

if (!isset($_SESSION["usuario"])) {

    header("Location: onepagelogin.php");
    exit();

}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inicio</title>

</head>

<body>

    <h1>
        Bienvenido,
        <?php echo $_SESSION["usuario"]["name"]; ?>!
    </h1>

    <a href="cerrar_sesion.php">
        Cerrar sesión
    </a>

</body>

</html>