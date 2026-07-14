<!-- busquedapdobd.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="pdobd.php" method="get">
        <label>Buscar:<input type="text" name="buscar"></label>
        <input type="submit" value="Buscar">
    </form>
</body>
</html>
//este formulario envia el valor del input con name="buscar" a la página pdobd.php mediante el método GET, que es el que se utiliza para enviar datos a través de la URL. En pdobd.php se recibe el valor del input mediante $_GET['buscar'] y se utiliza para realizar la consulta a la base de datos.
