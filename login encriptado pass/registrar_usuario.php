<?php
include_once 'getUsuarios.php';

if ($_POST) {
    $nombre = $_POST['username'];
    $contrasena = $_POST['password'];

    $usuarios = new getUsuarios();
    if ($usuarios->registrar_usuario_encriptado($nombre, $contrasena)) {
        echo "Usuario registrado con éxito.";
    } else {
        echo "Error al registrar el usuario.";
    }
}
?>