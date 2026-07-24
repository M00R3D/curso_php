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
    form{
        margin-top: 20px;
        background-color: #f2f2f2;
        padding: 10px;  
    }
    input[type="text"]{
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    input[type="submit"]{
        background-color: blue;
        color: white;
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;

    }
    body{
        font-family: Arial, sans-serif;
        font-size:20px;
        display: flex;
        flex-direction: column;
    }
</style>
<body>
    <!-- // function threeRandomNumbers($min, $max) {
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
    // $var1="highlight";
    // $var2="HIGHLIGHT";
    // echo "<p class='$var1'>this is a phrase $var1</p>";
    // echo "<p class=\"$var1\">this is a phrase</p>";

    // $result = strcmp($var1,$var2);
    // if ($result > 0) {
    //     echo "<p>$var1 es mayor que $var2</p>";
    // } elseif ($result < 0) {
    //     echo "<p>$var1 es menor que $var2</p>";
    // } else {
    //     echo "<p>$var1 es igual a $var2</p>";
    // }
    // echo "<p>Resultado de la comparación: $result</p>";  -->
    <form action="validacion.php" method="post" name="datos_usuario" id="datos_usuario">
        <table width="50%" border="0" cellspacing="0" cellpadding="4">
            <tr>
                <td width="30%">Nombre:</td>
                <td width="70%"><label for="nombre_usuario"></label>
                    <input name="nombre_usuario" type="text" id="nombre_usuario" size="40" maxlength="40"></td>
            </tr>
            <tr>
                <td width="30%">Edad:</td>
                <td width="70%"><label for="edad_usuario"></label>
                    <input name="edad_usuario" type="text" id="edad_usuario" size="40" maxlength="40"></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="enviando" id="enviando" value="Enviar"></td>
            </tr>
        
        </table>
    </form>
</body>
</html>
