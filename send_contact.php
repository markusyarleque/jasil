<?php
require_once('admin/includes/load.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mail = new PHPMailer(true);

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
        $mail->addAddress($contact_email, 'Contacto JASIL'); // Destinatario

        // Contenido del correo
        $mail->isHTML(true);                                // Enviar como HTML
        $mail->Subject = 'Nueva solicitud de contacto';  // Asunto del correo
        $mail->Body = '<html><body>';
        $mail->Body .= '<h2>Detalles de la solicitud de contacto</h2>';
        $mail->Body .= '<p><strong>Nombres Completos:</strong> ' . htmlspecialchars($_POST['Name']) . '</p>';
        $mail->Body .= '<p><strong>Número Telefónico:</strong> ' . htmlspecialchars($_POST['PhoneNumber']) . '</p>';
        $mail->Body .= '<p><strong>Correo Electrónico:</strong> ' . htmlspecialchars($_POST['Email']) . '</p>';
        $mail->Body .= '<p><strong>Detalle del Mensaje:</strong><br>' . nl2br(htmlspecialchars($_POST['Massage'])) . '</p>';
        $mail->Body .= '</body></html>';

        // Enviar correo
        $mail->send();
        echo 'Solicitud enviada exitosamente.';
    } catch (Exception $e) {
        // Mostrar error si ocurre algún problema al enviar el correo
        echo 'No se pudo enviar el correo. Error: ', $mail->ErrorInfo;
    }
} else {
    echo 'Solicitud no válida.';
}
