<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="calculando.php" method="post" name="datos_num" id="datos_num">
        <table width="30%">
            <input type="text" name="num1" id="num1" placeholder="Ingrese el primer numero">
            <input type="text" name="num2" id="num2" placeholder="Ingrese el segundo numero">
            <select name="operador" id="operador">
                <option value="suma">Suma</option>
                <option value="resta">Resta</option>
                <option value="multiplicacion">Multiplicacion</option>
                <option value="division">Division</option>
                <option value="modulo">Modulo</option>
            </select>
            <input type="submit" value="Calcular" name="calculando" id="calculando">
        </table>
    </form>

    
</body>
</html>