<?php

// Eliminar la cookie
setcookie(
    "usuario",
    "",
    time() - 3600,
    "/"
);

// Redirigir al login
header("Location: onepagelogin.php");

exit();

?>