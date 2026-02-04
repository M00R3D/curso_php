<style>
    .validado{
        color: green;
        font-weight: bold;
    }
    .no_validado{
        color: red;
        font-weight: bold;
    }   
</style>
<?php 
        if(isset($_POST['enviando'])){
            $nombre = $_POST['nombre_usuario'];
            $edad = $_POST['edad_usuario'];

            if($nombre=="job" && $edad>=18){
                echo "<p class=\"validado\">tienes acceso</p>";
            }else{
                echo "<p class=\"no_validado\">no tienes acceso</p>";
            }
        }
?>