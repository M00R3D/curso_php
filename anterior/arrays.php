<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    // $semana=array("lunes","martes","miercoles","jueves","viernes","sabado","domingo");

    // echo "<p>{$semana[0]}</p>";


    $datos=array("nombre"=>"job","apellido"=>"moore","edad"=>22);
    $datos["nacionalidad"]="mexicano"; //agregar un nuevo elemento al array asociativo
    echo "<p>{$datos}</p>";

    foreach($datos as $clave=>$valor){
        echo "<p>clave:{$clave}->valor:{$valor}</p>";
    }
    ?>
</body>
</html>