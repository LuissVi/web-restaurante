<?php
session_start(); // Siempre al inicio del script

// Redireccionar si no hay sesión iniciada
if (!isset($_SESSION["user"])) {
    header("Location: ../../login/login.php");
    exit(); // Siempre es buena práctica finalizar el script después de redirigir
}
// Cerrar sesión si se recibe ?salir
// if (isset($_GET["salir"])) {
//     session_destroy();  // Destruye la sesión
//     session_unset();    // Limpia las variables de sesión
//     header("Location: ../../login/login.php");
//     exit();
// }
?>
