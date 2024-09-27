<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Requiere los archivos necesarios de PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mail = new PHPMailer(true);  // Crear una instancia de PHPMailer con excepción activada

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();                                   // Utilizar SMTP
        $mail->Host = 'mail.jasil.pe';                     // Servidor SMTP
        $mail->SMTPAuth = true;                            // Habilitar autenticación SMTP
        $mail->Username = 'soporte@jasil.pe';              // Nombre de usuario SMTP (tu correo)
        $mail->Password = 'mJE52B24FQXhXGM';                 // Contraseña SMTP (tu contraseña)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   // Habilitar TLS (o SSL)
        $mail->Port = 465;                                 // Puerto TCP para SSL
        // Configurar la codificación
        $mail->CharSet = 'UTF-8';
        // Configuración del remitente y destinatario
        $mail->setFrom('soporte@jasil.pe', 'Soporte JASIL'); // Remitente
        $mail->addAddress('cotizaciones@jasil.pe', 'Cotizaciones JASIL'); // Destinatario
        // Puedes añadir más destinatarios si es necesario
        // $mail->addCC('otrocorreo@jasil.pe');
        // $mail->addBCC('copiaoculta@jasil.pe');

        // Contenido del correo
        $mail->isHTML(true);                                // Enviar como HTML
        $mail->Subject = 'Nueva solicitud de cotización';  // Asunto del correo
        $mail->Body = '<html><body>';
        $mail->Body .= '<h2>Detalles de la solicitud de cotización</h2>';
        $mail->Body .= '<p><strong>Nombres Completos:</strong> ' . htmlspecialchars($_POST['fullName']) . '</p>';
        $mail->Body .= '<p><strong>Empresa o Compañía:</strong> ' . htmlspecialchars($_POST['company']) . '</p>';
        $mail->Body .= '<p><strong>Número Telefónico:</strong> ' . htmlspecialchars($_POST['phone']) . '</p>';
        $mail->Body .= '<p><strong>Correo Electrónico:</strong> ' . htmlspecialchars($_POST['email']) . '</p>';
        $mail->Body .= '<p><strong>Servicio:</strong> ' . htmlspecialchars($_POST['service']) . '</p>';
        $mail->Body .= '<p><strong>Detalle del Mensaje:</strong><br>' . nl2br(htmlspecialchars($_POST['message'])) . '</p>';
        $mail->Body .= '</body></html>';

        // Enviar correo
        $mail->send();
        echo 'Cotización enviada exitosamente.';
    } catch (Exception $e) {
        // Mostrar error si ocurre algún problema al enviar el correo
        echo 'No se pudo enviar el correo. Error: ', $mail->ErrorInfo;
    }
} else {
    echo 'Solicitud no válida.';
}
