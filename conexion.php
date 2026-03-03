<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $db_host="localhost";
    $db_user="root";
    $db_pass="";
    $db_name="cursophp";

    $x=mysqli_connect($db_host,$db_user,$db_pass,$db_name);//mysqli_connect es más para el ámbito procedural, mientras que mysqli es para el ámbito orientado a objetos
    if(!$x){
        die("Error de conexión: " . mysqli_connect_error());
        echo "<br> <br>";
        exit();
    }else{
        echo "Conexión exitosa";
        echo "<br> <br>";
    }
    mysqli_set_charset($x,"utf8");//establecer el conjunto de caracteres a utf8 para evitar problemas con caracteres especiales
    mysqli_select_db($x,$db_name) or die("Error no se encuentra la base de datos:" . mysqli_error($x));
    $consulta="SELECT * FROM usuarios";
    $resultado=mysqli_query($x,$consulta);
    // echo "<p>la consulta es: $consulta </p> <br> <p>el resultado que nos da ejecutar la consulta es: " . var_export($resultado, true) . "</p>";
    
    for($i = 0; $i < mysqli_num_rows($resultado); $i++){
        $fila = mysqli_fetch_row($resultado);
        echo $fila[0] . " " . $fila[1] . " " . $fila[2] . "<br>";
    }
    mysqli_close($x);//cerrar la conexión a la base de datos
    ?>
</body>
</html>