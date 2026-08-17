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

    public function comprobar_usuario_encriptado($nombre, $contrasena){
        try {
            $sql = "SELECT * FROM usuarios WHERE name = '$nombre'";
            $resultado = $this->conexion_db->query($sql);
            $resultado->execute(array());
            $usuario = $resultado->fetch(PDO::FETCH_ASSOC);
            $resultado->closeCursor();
            if ($usuario && password_verify($contrasena, $usuario['pass'])) {
                return $usuario;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error al comprobar el usuario: " . $e->getMessage();
            return false;
        }
    }

    public function registrar_usuario_encriptado($nombre, $contrasena){
        try {
            $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuarios (name, pass) VALUES ('$nombre', '$contrasena')";
            $resultado = $this->conexion_db->prepare($sql);
            $resultado->execute(array());
            $resultado->closeCursor();
            return true;
        } catch (PDOException $e) {
            echo "Error al registrar el usuario: " . $e->getMessage();
            return false;
        }
    }
}


?>