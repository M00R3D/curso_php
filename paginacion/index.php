<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paginación</title>
</head>

<body>

<?php

try {

    $base = new PDO(
        "mysql:host=localhost; dbname=crud-db",
        "root",
        ""
    );

    $base->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    $base->exec("SET CHARACTER SET utf8");


    // Cantidad de registros por página
    $tamano_paginas = 3;


    // Página actual
    $pagina = isset($_GET["pagina"])
        ? (int)$_GET["pagina"]
        : 1;


    // Evitar páginas menores a 1
    if ($pagina < 1) {
        $pagina = 1;
    }


    // Calcular desde qué registro comenzar
    $inicio = ($pagina - 1) * $tamano_paginas;


    // Obtener usuarios de la página actual
    $sql = "SELECT id, nombre, apellido, direccion
            FROM datosusuarios
            LIMIT $inicio, $tamano_paginas";

    $resultado = $base->prepare($sql);

    $resultado->execute();

    $total_paginas = ceil($base->query("SELECT COUNT(*) FROM datosusuarios")->fetchColumn() / $tamano_paginas);

    // Mostrar usuarios
    while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {

        echo "ID: " . $registro['id'] . "<br>";
        echo "Nombre: " . $registro['nombre'] . "<br>";
        echo "Apellido: " . $registro['apellido'] . "<br>";
        echo "Dirección: " . $registro['direccion'] . "<br><br>";

    }

    $resultado->closeCursor();


} catch (PDOException $e) {

    echo "Error: " . $e->getMessage();

}
for ($i = 1; $i <= $total_paginas; $i++) {
    echo "<button><a href='index.php?pagina=$i'>$i</a></button> ";
}
?>
<p></p>pagina actual: <?php echo $pagina; ?></p>
<button><a href="index.php?pagina=<?php echo $pagina - 1; ?>">Anterior</a></button>
<button><a href="index.php?pagina=<?php echo $pagina + 1; ?>">Siguiente</a></button>
<button><a href="index.php?pagina=<?php echo $total_paginas; ?>">Última</a></button>

</body>
</html>