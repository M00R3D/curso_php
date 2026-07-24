<!-- poobd\getProductos.php -->
<?php
require ("conexion.php");

class getProductos extends Conexion{
    public function get_productos(){
        $sql = "SELECT * FROM productos";
        $resultado = $this->conexion_db->query($sql);
        $productos = array();
        while($row = $resultado->fetch_assoc()){
            $productos[] = $row;
        }
        return $productos;
    }
}
?>