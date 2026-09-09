<?php

$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$baseDatos = "crud-db";

// Conexión
$conexion = new mysqli($servidor, $usuario, $contrasena, $baseDatos);

// Comprobar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener datos
$sql = "SELECT * FROM datosusuarios";
$resultado = $conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Datos de usuarios</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }

        .btn {
            padding: 6px 12px;
            border: none;
            text-decoration: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
        }

        .editar {
            background-color: #007bff;
        }

        .insertar {
            background-color: #94b113;
        }

        .eliminar {
            background-color: #dc3545;
        }

        .guardar {
            background-color: #28a745;
        }

        .cancelar {
            background-color: #6c757d;
        }

        #formularioInsertar {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f5f5f5;
        }

        #formularioInsertar input {
            padding: 8px;
            margin-right: 5px;
        }

        td input {
            width: 90%;
            padding: 6px;
        }

    </style>

</head>

<body>

    <h1>Datos de usuarios</h1>

    <!-- BOTÓN INSERTAR -->

    <button
        class="btn insertar"
        onclick="mostrarFormulario()"
    >
        Insertar
    </button>


    <!-- FORMULARIO PARA INSERTAR -->

    <div id="formularioInsertar" style="display: none;">

        <h3>Nuevo usuario</h3>

        <input
            type="text"
            id="nombreNuevo"
            placeholder="Nombre"
        >

        <input
            type="text"
            id="apellidoNuevo"
            placeholder="Apellido"
        >

        <input
            type="text"
            id="direccionNueva"
            placeholder="Dirección"
        >

        <button
            class="btn guardar"
            onclick="insertarUsuario()"
        >
            Guardar
        </button>

        <button
            class="btn cancelar"
            onclick="ocultarFormulario()"
        >
            Cancelar
        </button>

    </div>


    <!-- TABLA -->

    <table>

        <thead>

            <tr>

                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Dirección</th>
                <th>Acciones</th>

            </tr>

        </thead>

        <tbody id="tablaUsuarios">

        <?php

        if ($resultado->num_rows > 0) {

            while ($fila = $resultado->fetch_assoc()) {

        ?>

            <tr id="fila-<?php echo $fila['id']; ?>">

                <td>
                    <?php echo $fila["id"]; ?>
                </td>

                <td class="nombre">
                    <?php echo htmlspecialchars($fila["nombre"]); ?>
                </td>

                <td class="apellido">
                    <?php echo htmlspecialchars($fila["apellido"]); ?>
                </td>

                <td class="direccion">
                    <?php echo htmlspecialchars($fila["direccion"]); ?>
                </td>

                <td>

                    <button
                        class="btn editar"
                        onclick="editarUsuario(<?php echo $fila['id']; ?>)"
                    >
                        Editar
                    </button>

                    <button
                        class="btn eliminar"
                        onclick="eliminarUsuario(<?php echo $fila['id']; ?>)"
                    >
                        Eliminar
                    </button>

                </td>

            </tr>

        <?php

            }

        } else {

        ?>

            <tr>

                <td colspan="5">
                    No hay usuarios registrados.
                </td>

            </tr>

        <?php

        }

        ?>

        </tbody>

    </table>


<script>


// ==========================================
// MOSTRAR FORMULARIO INSERTAR
// ==========================================

function mostrarFormulario() {

    document.getElementById("formularioInsertar").style.display = "block";

}


// ==========================================
// OCULTAR FORMULARIO INSERTAR
// ==========================================

function ocultarFormulario() {

    document.getElementById("formularioInsertar").style.display = "none";

}


// ==========================================
// INSERTAR USUARIO
// ==========================================

function insertarUsuario() {

    const nombre = document.getElementById("nombreNuevo").value;
    const apellido = document.getElementById("apellidoNuevo").value;
    const direccion = document.getElementById("direccionNueva").value;

    if (nombre === "" || apellido === "" || direccion === "") {

        alert("Completa todos los campos.");

        return;
    }

    const datos = new FormData();

    datos.append("nombre", nombre);
    datos.append("apellido", apellido);
    datos.append("direccion", direccion);


    fetch("insertar.php", {

        method: "POST",
        body: datos

    })

    .then(response => response.text())

    .then(resultado => {

        alert(resultado);

        // Limpiar campos

        document.getElementById("nombreNuevo").value = "";
        document.getElementById("apellidoNuevo").value = "";
        document.getElementById("direccionNueva").value = "";

        ocultarFormulario();

        // Actualizar tabla

        location.reload();

    });

}


// ==========================================
// EDITAR USUARIO
// ==========================================

function editarUsuario(id) {

    const fila = document.getElementById("fila-" + id);

    const nombre = fila.querySelector(".nombre").textContent.trim();
    const apellido = fila.querySelector(".apellido").textContent.trim();
    const direccion = fila.querySelector(".direccion").textContent.trim();


    fila.querySelector(".nombre").innerHTML =
        `<input type="text" id="nombre-${id}" value="${nombre}">`;

    fila.querySelector(".apellido").innerHTML =
        `<input type="text" id="apellido-${id}" value="${apellido}">`;

    fila.querySelector(".direccion").innerHTML =
        `<input type="text" id="direccion-${id}" value="${direccion}">`;


    fila.querySelector("td:last-child").innerHTML = `

        <button
            class="btn guardar"
            onclick="actualizarUsuario(${id})"
        >
            Guardar
        </button>

        <button
            class="btn cancelar"
            onclick="cancelarEdicion(${id})"
        >
            Cancelar
        </button>

    `;

}


// ==========================================
// ACTUALIZAR USUARIO
// ==========================================

function actualizarUsuario(id) {

    const nombre =
        document.getElementById("nombre-" + id).value;

    const apellido =
        document.getElementById("apellido-" + id).value;

    const direccion =
        document.getElementById("direccion-" + id).value;


    const datos = new FormData();

    datos.append("id", id);
    datos.append("nombre", nombre);
    datos.append("apellido", apellido);
    datos.append("direccion", direccion);


    fetch("actualizar.php", {

        method: "POST",
        body: datos

    })

    .then(response => response.text())

    .then(resultado => {

        alert(resultado);

        location.reload();

    });

}


// ==========================================
// CANCELAR EDICIÓN
// ==========================================

function cancelarEdicion(id) {

    location.reload();

}


// ==========================================
// ELIMINAR USUARIO
// ==========================================

function eliminarUsuario(id) {

    if (!confirm("¿Seguro que quieres eliminar este usuario?")) {

        return;

    }


    fetch("eliminar.php?id=" + id)

    .then(response => response.text())

    .then(resultado => {

        alert(resultado);

        location.reload();

    });

}

</script>


</body>

</html>

<?php

$conexion->close();

?>