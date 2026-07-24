<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
    <table width="50%" border="0" cellspacing="0" cellpadding="4">
            <tr>
                <td width="30%">Total Compra:</td>
                <td width="70%"><label for="total_compra"></label>
                    <input name="total_compra" type="text" id="total_compra" size="40" maxlength="40"></td>
            </tr>
            <tr>
                <td width="30%">Tipo de cliente:</td>
                <td width="70%"><label for="tipo_cliente"></label>
                    <select name="tipo_cliente" id="tipo_cliente">
                        <option value="regular">Regular</option>
                        <option value="premium">Premium</option>
                        <option value="vip">VIP</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="enviando" id="enviando" value="Enviar"></td>
            </tr>
        
        </table>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $totalCompra = $_POST["total_compra"];
        $tipoCliente = $_POST["tipo_cliente"];
        $descuento = ($tipoCliente == "regular") ? 0 : (($tipoCliente == "premium") ? 0.1 : 0.2);    
        //la estructura del operador ternario es: condicion ? valor_si_verdadero : valor_si_falso
        echo "Tu descuento es de " . ($descuento * 100) . "%";
    }
    ?>
</body>
</html>