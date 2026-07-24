<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $num1 = rand(1, 100);
        echo "<p>El numero generado aleatoriamente es: " . $num1 . "</p>";
        $num2 = 5.129401248;
        echo "<br>";echo "<br>";
        echo "<p>El numero con decimales es: " . $num2 . "</p>";
        echo "<br>";echo "<br>";
        echo "<p>El numero redondeado es: " . round($num2) . "</p>";
        $num3 = "6.123456789";
        echo "<br>";echo "<br>";
        echo "<p>El int que era string es: " . (int)$num3 . "</p>";

    ?>
</body>
</html>