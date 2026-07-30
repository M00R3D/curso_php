<?php
require ("conexion.php");

class getUsuarios extends Conexion{
    public function get_usuarios(){
        try {
            $sql = "SELECT * FROM usuarios";
            $resultado = $this->conexion_db->query($sql);
            $usuarios = array();
            while($row = $resultado->fetch(PDO::FETCH_ASSOC)){
                $usuarios[] = $row;
            }
            return $usuarios;
        } catch (PDOException $e) {
            echo "Error al obtener los usuarios: " . $e->getMessage();
            return array();
        }
    }
    public function get_usuarios_por_nombre($nombre){
        try {
            $sql = "SELECT * FROM usuarios WHERE name = '$nombre'";
            $resultado = $this->conexion_db->query($sql);
            $resultado->execute(array());
            $usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $resultado->closeCursor();
            return $usuarios;
        } catch (PDOException $e) {
            echo "Error al obtener los usuarios: " . $e->getMessage();
            return array();
        }
    }

    public function comprobar_usuario($nombre, $contrasena){
        try {
            $sql = "SELECT * FROM usuarios WHERE name = '$nombre' AND pass = '$contrasena'";
            $resultado = $this->conexion_db->query($sql);
            $resultado->execute(array());
            $usuario = $resultado->fetch(PDO::FETCH_ASSOC);
            $resultado->closeCursor();
        } catch (PDOException $e) {
            echo "Error al comprobar el usuario: " . $e->getMessage();
            $usuario = false;
        }
        return $usuario;
    }
}
?>