<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    //esta funcion convierte una frase a mayusculas, si el segundo parametro es true, solo la primera letra de cada palabra se convertira a mayuscula, si el segundo parametro es false, toda la frase se convertira a mayuscula
        function frase_mayus($string,$conversion = true) {  //el parametro $conversion es opcional, si no se le pasa un valor, por defecto sera true
            $string = strtolower($string);
            if($conversion) {
                $resultado=ucwords($string);
            } else {
                $resultado=strtoupper($string);
            }
            return $resultado;
        }

        echo frase_mayus("holamundo") ;
        echo frase_mayus("holamundo",false) ;
        // echo frase_mayus("HOLAMUNDO") ;
    ?>
</body>
</html>