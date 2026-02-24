<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include 'constructores.php';
    $objeto1 = new Objeto(1, "gamer keyboard", "A high-quality gaming keyboard", 300.0, 10, "Electronics");
    // echo "<p>El nombre del producto es: " . $objeto1->getNombre() . "</p>";
    // echo "<p>La descripcion del producto es: " . $objeto1->getDescripcion() . "</p>";
    // echo "<p>El precio del producto es: " . $objeto1->getPrecio() . "</p>";
    // echo "<p>La cantidad del producto es: " . $objeto1->getCantidad() . "</p>";
    // echo "<p>La categoria del producto es: " . $objeto1->getCategoria() . "</p>";

    $objeto1->nombre="intento de cambio de nombre sin usar el setter";
    //aqui saldra error porque nombre es private, lo que quiere decir que solo se puede acceder a esa propiedad dentro de la clase, no desde fuera de ella, por eso es necesario usar el setter para cambiar el valor de esa propiedad
    ?>
</body>
</html>