<?php
session_start();   
if (!isset($_SESSION["usuario"])) {
    header("Location: login/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION["usuario"]["name"]; ?>!</h1>   
</body>
</html>