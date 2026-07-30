<?php
require ("getUsuarios.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["username"];
    $contrasena = $_POST["password"];

    $getUsuarios = new getUsuarios();
    $usuario = $getUsuarios->comprobar_usuario($nombre, $contrasena);

    if ($usuario) {
        echo "Inicio de sesión exitoso";
    } else {
        echo "Nombre o contraseña incorrectos";
    }
}
?>