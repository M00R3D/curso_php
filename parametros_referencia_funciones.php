<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $numero = 5;

        function aumentar_numero($num) {
            $num++;
            return $num;
        }

        function aumentar_numero_referenciado(&$num) {//referenciar parametros afecta a la variable original, no es necesario retornar el valor
            $num++;
        }

        aumentar_numero($numero);
        echo "<p>El numero despues de aumentar_numero es: " . $numero . "</p>";

        aumentar_numero_referenciado($numero);
        echo "<p>El numero despues de aumentar_numero_referenciado es: " . $numero . "</p>";
    ?>
</body>
</html>