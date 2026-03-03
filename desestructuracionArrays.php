<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $persona=[
        "nombre"=>"Job",
        "apellido"=>"Moore",
        "edad"=>22
    ]
    ["nombre"=>$elNombre, "apellido"=>$elApellido, "edad"=>$laEdad]= $persona;
    //la desestructuración de arrays es una forma de asignar los valores de un array    
    echo "El nombre es: " . $elNombre . "<br>";
    echo "El apellido es: " . $elApellido . "<br>";
    echo "La edad es: " . $laEdad . "<br>";
    //también se puede usar la función list() para desestructurar un array indexado
    ?>
</body>
</html>