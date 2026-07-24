<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $var1=true;
    $var2=false;
    $resultado=$var1 && $var2;
    
    if($resultado==true){
        echo "Correcto";
    }
    else{
        echo "Incorrecto";
    }

    $var3=true;
    $var4=false;
    $resultado2=$var3 and $var4;
    if($resultado2==true){
        echo "Correcto";
    }
    else{
        echo "Incorrecto";
    }
    ?>
</body>
</html>

<!-- el primer echo dice "Incorrecto" debido a la prioridad de los operadores -->
 <!-- el operador "and" tiene menor prioridad que el operador "=" -->
  <!-- por lo tanto, la asignación se realiza primero y luego se evalúa el "and" -->
<!-- el segundo echo dice "Correcto" porque el operador "and" se evalúa después de la asignación, lo que da como resultado "true" -->
 