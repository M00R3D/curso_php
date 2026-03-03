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
    }else{
        echo "Conexión exitosa";
        echo "<br> <br>";
    }

    $consulta="SELECT * FROM usuarios";
    $resultado=mysqli_query($x,$consulta);
    // echo "<p>la consulta es: $consulta </p> <br> <p>el resultado que nos da ejecutar la consulta es: " . var_export($resultado, true) . "</p>";
    
    for($i = 0; $i < mysqli_num_rows($resultado); $i++){
        $fila = mysqli_fetch_row($resultado);
        echo $fila[0] . " " . $fila[1] . " " . $fila[2] . "<br>";
    }
    ?>
</body>
</html>