<?php
require ("getUsuarios.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Introduce tus datos para iniciar sesión:</h1>
    <form action="comprueba_login.php" method="post">
        <label for="username">Nombre:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Iniciar sesión">
    </form>
</body>
</html>