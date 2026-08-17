<?php

session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    require("getUsuarios.php");

    $nombre = $_POST["username"];
    $contrasena = $_POST["password"];

    $getUsuarios = new getUsuarios();

    $usuario = $getUsuarios->comprobar_usuario(
        $nombre,
        $contrasena
    );

    if ($usuario) {

        $_SESSION["usuario"] = $usuario;

    } else {

        $error = "Nombre o contraseña incorrectos";

    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inicio de sesión</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;

            font-family: Arial, sans-serif;

            background: #f2f2f2;

            display: flex;
            flex-direction: column;
            align-items: center;

            padding: 50px 20px;
        }

        h1 {
            margin-bottom: 25px;

            color: #222;

            text-align: center;
        }

        /* LOGIN */

        form {
            width: 100%;
            max-width: 400px;

            background: white;

            padding: 30px;

            border-radius: 15px;

            box-shadow:
                0 5px 20px rgba(0, 0, 0, 0.1);

            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;

            font-weight: bold;

            color: #444;
        }

        input[type="text"],
        input[type="password"] {

            width: 100%;

            padding: 12px;

            margin-bottom: 18px;

            border: 2px solid #ddd;

            border-radius: 8px;

            font-size: 16px;

            transition: 0.2s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {

            outline: none;

            border-color: #555;

            box-shadow:
                0 0 0 3px rgba(0, 0, 0, 0.08);
        }

        input[type="submit"] {

            padding: 12px;

            border: none;

            border-radius: 8px;

            background: #222;

            color: white;

            font-size: 16px;

            font-weight: bold;

            cursor: pointer;

            transition: 0.2s;
        }

        input[type="submit"]:hover {

            background: #444;

            transform: translateY(-2px);
        }

        /* ERROR */

        .error {

            color: red;

            margin-bottom: 15px;

            text-align: center;
        }

        /* BIENVENIDA */

        .bienvenida {

            background: white;

            padding: 40px;

            border-radius: 15px;

            box-shadow:
                0 5px 20px rgba(0, 0, 0, 0.1);

            text-align: center;

            width: 100%;
            max-width: 500px;
        }

        .bienvenida h1 {

            margin-bottom: 20px;
        }

        .cerrar {

            display: inline-block;

            padding: 12px 20px;

            background: #222;

            color: white;

            text-decoration: none;

            border-radius: 8px;

            transition: 0.2s;
        }

        .cerrar:hover {

            background: #444;

            transform: translateY(-2px);
        }

        /* CARTAS */

        #cartas {

            display: flex;

            gap: 20px;

            margin-top: 30px;
        }

        .carta {

            width: 100px;
            height: 100px;

            border-radius: 12px;

            transition:
                transform 0.3s ease,
                box-shadow 0.3s ease;

            cursor: pointer;
        }

        .carta:hover {

            transform:
                scale(1.1)
                rotate(3deg);

            box-shadow:
                0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .roja {
            background-color: red;
        }

        .verde {
            background-color: green;
        }

        .azul {
            background-color: blue;
        }

    </style>

</head>

<body>

<?php if (isset($_SESSION["usuario"])): ?>

    <!-- USUARIO LOGUEADO -->

    <div class="bienvenida">

        <h1>
            Bienvenido,
            <?php echo $_SESSION["usuario"]["name"]; ?>!
        </h1>

        <a
            class="cerrar"
            href="cerrar_sesion.php"
        >
            Cerrar sesión
        </a>

    </div>

<?php else: ?>

    <!-- FORMULARIO DE LOGIN -->

    <?php if ($error !== ""): ?>

        <p class="error">
            <?php echo $error; ?>
        </p>

    <?php endif; ?>

    <h1>
        Introduce tus datos para iniciar sesión:
    </h1>

    <form
        action="onepagelogin.php"
        method="post"
    >

        <label for="username">
            Nombre:
        </label>

        <input
            type="text"
            id="username"
            name="username"
            required
        >

        <label for="password">
            Contraseña:
        </label>

        <input
            type="password"
            id="password"
            name="password"
            required
        >

        <input
            type="submit"
            value="Iniciar sesión"
        >

    </form>

<?php endif; ?>


<h1>Cartas de colores con hover</h1>

<div id="cartas">

    <div class="carta roja"></div>

    <div class="carta verde"></div>

    <div class="carta azul"></div>

</div>

</body>

</html>