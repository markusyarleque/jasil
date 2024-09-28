<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Requiere los archivos necesarios de PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

require_once('admin/includes/load.php');
$ip = $_SERVER['REMOTE_ADDR'];
// Verifica el CAPTCHA
$secretKey = getenv('RECAPTCHA_SECRET_KEY');
$captchaResponse = $_POST['recaptcha'];
$verifyResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captchaResponse");
$responseData = json_decode($verifyResponse);

if ($responseData) {
    $validar_ip = find_ip($ip);
    if ($validar_ip !== null && $validar_ip >= 3) {
        echo
        json_encode(['status' => 'intents', 'message' => 'Has enviado demasiadas solicitudes en poco tiempo. Por favor, inténtalo más tarde.']);
    } else {
        if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $email = $_POST['email'];

            // Revisa si el correo ya está registrado
            $emails = find_emails($email);

            if ($emails) {
                echo
                json_encode(['status' => 'exists', 'message' => 'Este correo ya está registrado.']);
            } else {
                // Inserta el correo en la base de datos

                $query = "INSERT INTO emails_suscriptions (";
                $query .= "email, ip_address";
                $query .= ") VALUES (";
                $query .= " '{$email}', '{$ip}'";
                $query .= ")";
                if ($db->query($query)) {
                    //sucess
                    $mail = new PHPMailer(true);  // Crear una instancia de PHPMailer con excepción activada

                    try {
                        // Configuración del servidor SMTP
                        $mail->isSMTP();                                   // Utilizar SMTP
                        $mail->Host = $host_email;                     // Servidor SMTP
                        $mail->SMTPAuth = true;                            // Habilitar autenticación SMTP
                        $mail->Username = $support_email;              // Nombre de usuario SMTP (tu correo)
                        $mail->Password = $support_pass;                 // Contraseña SMTP (tu contraseña)
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   // Habilitar TLS (o SSL)
                        $mail->Port = $port_smtp;                                 // Puerto TCP para SSL
                        // Configurar la codificación
                        $mail->CharSet = 'UTF-8';
                        // Configuración del remitente y destinatario
                        $mail->setFrom($support_email, 'Soporte JASIL'); // Remitente
                        $mail->addAddress($support_email, 'Soporte JASIL'); // Destinatario

                        // Contenido del correo
                        $mail->isHTML(true);                                // Enviar como HTML
                        $mail->Subject = 'Nuevo suscriptor';  // Asunto del correo
                        $mail->Body = '<html><body>';
                        $mail->Body .= '<h2>Detalles del subscriptor</h2>';
                        $mail->Body .= '<p><strong>Correo Electrónico:</strong> ' . htmlspecialchars($email) . '</p>';
                        $mail->Body .= '</body></html>';

                        // Enviar correo
                        $mail->send();
                        echo json_encode(['status' => 'ok', 'message' => 'Gracias por subscribirte']);
                    } catch (Exception $e) {
                        // Mostrar error si ocurre algún problema al enviar el correo
                        echo 'No se pudo enviar el correo. Error: ', $mail->ErrorInfo;
                    }
                } else {
                    //failed
                    //$session->msg('d', ' Error al guardar el correo.');
                    echo
                    json_encode(['status' => 'error_query', 'message' => 'Error al guardar el correo']);
                }
            }
        } else {
            echo
            json_encode(['status' => 'error_email', 'message' => 'Por favor, introduce un correo válido.']);
        }
    }
} else {
    echo
    json_encode(['status' => 'error_captcha', 'message' => 'Por favor, verifica que no eres un robot.']);
}
