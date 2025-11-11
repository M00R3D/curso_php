<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .highlight{
        color: red;
        font-weight: bold;
    }

</style>
<body>
    <?php 
    // function threeRandomNumbers($min, $max) {
        // return rand($min, $max) . ", " . rand($min, $max) . ", " . rand($min, $max);
    // }

    // $var1 = "this is var1";
    // $var2 = "this is var2";
    // $var3 = "this is var3";

    // echo $var1 . $var2 . $var3; 
    /* print "<br>";
     print $var1 . " " . $var2 . " " . $var3; */

    // echo threeRandomNumbers(1, 100);

    // $varLocal = "this is a local variable";
    // include("includevar.php");
    // testScope();
    //a pesar de llamar a la funcion, la variable local no cambia su valor fuera de la funcion
    // echo $varLocal;

    // function staticVariables() {
    //     static $count = 0;
    //     $count++;
    //     echo "This function has been called $count times.<br>";    
    // }

    // staticVariables();
    // staticVariables();
    // staticVariables();
    // staticVariables();


    // echo "<br>";

    // function nonStaticVariables() {
    //     $count = 0;
    //     $count++;
    //     echo "This function has been called $count times.<br>";    
    // }
    // nonStaticVariables();
    // nonStaticVariables();
    // nonStaticVariables();
    // nonStaticVariables();
    $var1="highlight";
    $var2="HIGHLIGHT";
    echo "<p class='$var1'>this is a phrase $var1</p>";
    echo "<p class=\"$var1\">this is a phrase</p>";

    $result = strcmp($var1,$var2);
    if ($result > 0) {
        echo "<p>$var1 es mayor que $var2</p>";
    } elseif ($result < 0) {
        echo "<p>$var1 es menor que $var2</p>";
    } else {
        echo "<p>$var1 es igual a $var2</p>";
    }
    echo "<p>Resultado de la comparación: $result</p>";
    ?>
</body>
</html>
