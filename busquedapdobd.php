<!-- busquedapdobd.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            display: grid;
            padding-left: 30%;
            padding-top: 5%;
            background-color: #8595a3;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            display: block;
        }
        th {
            display: block;
        }
    </style>
</head>
<body>
    <form action="pdobd.php" method="get">
        <table>
            <tr>
                <td><label>Buscar por nombre:<input type="text" name="nombre"></label></td>
            </tr>
            <tr>
                <td><label>Buscar por precio:<input type="text" name="precio"></label></td>
            </tr>
            <tr>
                <td><input type="submit" value="Buscar"></td>
            </tr>
        </table>
    </form>
</body>
</html>
<!-- //este formulario envia el valor del input con name="buscar" a la página pdobd.php mediante el método GET, que es el que se utiliza para enviar datos a través de la URL. En pdobd.php se recibe el valor del input mediante $_GET['buscar'] y se utiliza para realizar la consulta a la base de datos. -->
