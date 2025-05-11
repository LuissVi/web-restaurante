<?php
session_start();
require_once(__DIR__ . "/../../config/conexion.php");
$usuario="";
$password="";

if (isset($_POST["iniciar"])) {
    if (empty($_POST["usua"])) {
        $eUsuario = "Introducir usuario";
    }
    if (empty($_POST["pass"])) {
        $ePassword = "Introducir Contraseña";
    }

    $usuario = $_POST["usua"];
    $password = $_POST["pass"];
    // echo "Usuario: " . $usuario;
    // echo "Contraseña: " . $password;
    
    if (!isset($eUsuario) && !isset($ePassword)) {
        $query = $conexion->prepare("SELECT usuario, password FROM usuarios WHERE usuario = ?");
        $query->bind_param("s", $usuario);
        $query->execute();
        $resultado = $query->get_result();

        if ($resultado->num_rows > 0) {
            $datos = $resultado->fetch_assoc();
            if (password_verify($password, $datos["password"])) {
                $_SESSION["user"] = $datos["usuario"];
                $_SESSION["pass"] = $datos["password"];
                // echo "Sesión guardada correctamente";
                 header("Location: /proyecto-web-reservas/public/serv-admin/admin.php");
                //  echo $datos['usuario'];
                 exit();
            } else {
                $error="Contraseña incorrecta";
            }
        } else {
            $falso="Usuario no encontrado";
        }
    }
}
?>
