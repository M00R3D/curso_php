<!-- poobd\conexion.php -->
<?php
    require ("config.php");

    class Conexion{
        protected $conexion_db;

        public function __construct(){
                $this->conexion_db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET, DB_USER, DB_PASS);

                try {
                    $this->conexion_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    echo "Fallo al conectar a MySQL: " . $e->getMessage();
                }
        }
    }
?>