<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    class CompraPersonalizada {
        public float $precio;
        public static int $contadorCompras = 0; // Variable estática para contar el número de compras
        public static float $precioTotal = 0.0; // Variable estática para acumular el precio total de las compras
        public string $color;
        public string $calidad;
        public function __construct($precio = 30.0) {
            $this->precio = $precio;
            self::$contadorCompras++; // Incrementar el contador de compras cada vez que se crea una nueva compra
            self::$precioTotal += $precio; // Sumar el precio de la compra al precio total
        }

        public static function obtenerContador() {
            return self::$contadorCompras; // Método estático para obtener el valor del contador
        }
        public function actualizarColor($color) {
            $this->color = $color;
            $this->precio += 10.0; // Aumentar el precio de esta compra en 10.0
            self::$precioTotal += 10.0; // Aumentar el acumulado total de compras en 10.0

        }
        public function actualizarCalidad($calidad) {
            $this->calidad = $calidad;
            $this->precio += 20.0; // Aumentar el precio de esta compra en 20.0
            self::$precioTotal += 20.0; // Aumentar el acumulado total de compras en 20.0
        }
    }//se debe usar self:: porque las variables estáticas pertenecen a la clase y no a una instancia específica, por lo que se accede a ellas utilizando self:: en lugar de $this->.
    ?>
</body>
</html>