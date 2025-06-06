<?php
require_once("../config/conexion.php");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST["nombre"]) && !empty($_POST["email"]) && !empty($_POST["fecha"]) && !empty($_POST["hora"]) && !empty($_POST["personas"])  && !empty($_POST["nombre"])) {
        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        $fecha = $_POST["fecha"];
        $hora = $_POST["hora"];
        $personas = $_POST["personas"];
        $observacion = $_POST["observacion"] ?? " "; //si el campo observacion tiene valor lo usa sinó usa null;
        $regex = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

        // $sql = "INSERT INTO `reservas` (`id`, `nombre`, `email`, `fecha`, `hora`, `nroPersonas`, `observacion`) VALUES (NULL, $nombre,$email,$fecha, $hora,$personas NULL";
        // $query = $conexion->query($sql);
        if (preg_match($regex, $email)) {
            $stmt = $conexion->prepare("INSERT INTO `reservas` (`nombre`, `email`, `fecha`, `hora`, `nroPersonas`, `observacion`) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param("ssssis", $nombre, $email, $fecha, $hora, $personas, $observacion);
            // $stmt->execute();
            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Reserva guardada"]);
            } else {
                echo json_encode(["status" => "error", "message" => "No se pudo guardar los datos"]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "email:tipo ejemplo@..."]);
        }
    } else {
        echo '{"status":"eror","message":"Todos los campos son obligatorios"}';
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (!empty($_GET["id"])) {
        buscarCliente($_GET["id"]);
    } else {
        buscarCliente();
    }
}

function buscarCliente($id = null)
{
    global $conexion;
    $query = "SELECT * FROM `reservas`";
    if ($id != null) {
        $query .= " WHERE id=$id";
    }
    $resp = $conexion->query($query);

    if ($resp) {
        if ($resp->num_rows > 0) {
            echo json_encode($resp->fetch_all(MYSQLI_ASSOC));
        } else {
            // echo '{"error":"el id:' .$id .' no existe"}';
            echo json_encode(["error" => "El id: $id no existe"]);
        }
    }else {
        echo json_encode(["error" => "No se encontraron datos"]);
    }
}
