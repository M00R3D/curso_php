<?php
    // define("AUTOR", "Job",true); al parecer en el nuevo php ya no se puede usar el 3er paramentro para definir constantes case insensitive
    // echo "autor: " . AUTOR;
    define("AUTOR", "Job");
    echo "autor: " . AUTOR;
    echo "\n";
    echo "version de php: " .PHP_VERSION;
    echo "\n";
    echo "la ruta del servidor es: " .__DIR__;
    echo "\n";
    echo "el nombre del archivo es: " .__FILE__;
    echo "\n";
    echo "la linea del codigo es: " .__LINE__;
?>