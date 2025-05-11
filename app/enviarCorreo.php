<?php
header('Content-Type: application/json');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Si usaste Composer:
//require 'vendor/autoload.php';

// Si descargaste manualmente:
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['email']) && isset($_POST['nombre']) && isset($_POST['accion'])) {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $accion = $_POST['accion'];

        try {
            // Configuración del servidor SMTP
            $mail->SMTPDebug = 0; //Controla el nivel de información o debug que muestra PHPMailer cuando intenta enviar el correo(0=modo silencioso;2=muestra la conexion y el error que devuelve(informacion sencible))


            $mail->isSMTP(); //usa SMTP: q es el método standar para envio; es como decirle q se conecte directamente al servidor de correos
            $mail->Host       = 'smtp.gmail.com';           // Servidor de Gmail
            $mail->SMTPAuth   = true;
            $mail->Username   = 'luisitex2085@gmail.com';         // Tu correo Gmail
            $mail->Password   = 'ugnr mcxm rbgq gfwc'; // Tu contraseña de aplicación
            $mail->SMTPSecure = "tls";
            $mail->Port       = 587;

            // Remitente y destinatario
            $mail->setFrom('luisitex2085@gmail.com', 'admin-Restaurante');
            $mail->addAddress($email);

            // Contenido del correo
            $mail->isHTML(true); //permite html      
            if ($accion === "aceptar") {
                $mail->Subject = 'Confirmación de Reserva';
                $mail->Body    = "Hola " . $nombre . "<br><h1>¡Gracias por tu confianza!</h1><p>Tu Reserva ha sido confirmada.</p>";
            } elseif ($accion === "negar") {
                $mail->Subject = 'Reserva rechazada';
                $mail->Body    = "Hola " . $nombre . "<br><h1>¡Gracias por tu confianza!</h1><p>Lo sentimos no se pudo concretar la reserva-aforo al tope</p>";
            } else {
                throw new Exception("Acción inválida");
            }

            if ($mail->send()) {
                echo json_encode(["message" => "Correo enviado correctamente"]);
            } else {
                echo json_encode(["error" => "Hubo un problema al enviar el correo."]);
            }
        } catch (Exception $e) {
            echo json_encode(["error" => "Error al enviar correo: {$mail->ErrorInfo}"]);
        }
        //{$mail->ErrorInfo}:mensaje espesífico de PHPMailer, describe el fallo en el envío
    } else {
        echo json_encode(["error" => "Faltan datos requeridos (email o nombre)."]);
    }
}
