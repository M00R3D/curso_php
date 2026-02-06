<?php
        if(isset($_POST['calculando']))
        {
            $n1 = $_POST['num1'];
            $n2 = $_POST['num2'];
            $operador = $_POST['operador'];

            if(!strcmp($operador, "suma"))
            {
                $resultado = $n1 + $n2;
                echo "<p>El resultado de la suma es: " . $resultado . "</p>";
            }
            if(!strcmp($operador, "resta"))
            {
                $resultado = $n1 - $n2;
                echo "<p>El resultado de la resta es: " . $resultado . "</p>";
            }
            if(!strcmp($operador, "multiplicacion"))
            {
                $resultado = $n1 * $n2;
                echo "<p>El resultado de la multiplicacion es: " . $resultado . "</p>";
            }
            if(!strcmp($operador, "division"))
            {
                if($n2 != 0)
                {
                    $resultado = $n1 / $n2;
                    echo "<p>El resultado de la division es: " . $resultado . "</p>";
                }
                else
                {
                    echo "<p>No se puede dividir entre cero</p>";
                }
            }
            if(!strcmp($operador, "modulo"))
            {
                if($n2 != 0)
                {
                    $resultado = $n1 % $n2;
                    echo "<p>El resultado del modulo es: " . $resultado . "</p>";
                }
                else
                {
                    echo "<p>No se puede calcular el modulo entre cero</p>";
                }
            }
        }
    ?>