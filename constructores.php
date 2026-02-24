<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    class Objeto{
        public int $id;
        private string $nombre;
        private string $descripcion;
        private float $precio;
        private int $cantidad;
        private string $categoria;
        public function __construct($id, $nombre, $descripcion, $precio, $cantidad, $categoria) {
         //no es necesario asignar valores por defecto, se pueden pasar como parametros al crear el objeto
            $this->id = $id;
            $this->nombre = $nombre;
            $this->descripcion = $descripcion;
            $this->precio = $precio;
            $this->cantidad = $cantidad;
            $this->categoria = $categoria;
        }
        // public function __construct() {
        //     $this->id = 0;
        //     $this->nombre = "gamer keyboard";
        //     $this->descripcion = "A high-quality gaming keyboard";
        //     $this->precio = 300.0;
        //     $this->cantidad = 10;
        //     $this->categoria = "Electronics";
        // }
        public function getNombre() {
            return $this->nombre;
        }
        public function getDescripcion() {
            return $this->descripcion;
        }
        public function getPrecio() {
            return $this->precio;
        }
        public function getCantidad() {
            return $this->cantidad;
        }
        public function getCategoria() {
            return $this->categoria;
        }

        public function setNombre($nombre) {
            $this->nombre = $nombre;
        }
        public function setDescripcion($descripcion) {
            $this->descripcion = $descripcion;
        }
        public function setPrecio($precio) {
            $this->precio = $precio;
        }
        public function setCantidad($cantidad) {
            $this->cantidad = $cantidad;
        }
        public function setCategoria($categoria) {
            $this->categoria = $categoria;
        }


    }
    ?>
</body>
</html>