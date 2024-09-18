<?php
require_once('admin/includes/load.php');
$ip = $_SERVER['REMOTE_ADDR'];
// Verifica el CAPTCHA
$secretKey = "6LcNxkcqAAAAAI-f1xr1x25xMnAKSAgiqkbpxeKI";
$captchaResponse = $_POST['recaptcha'];
$verifyResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captchaResponse");
$responseData = json_decode($verifyResponse);

if ($responseData->success) {
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
                    //echo "Gracias por suscribirte";
                    // Enviar correo de notificación
                    /*$to = "soporte@jasil.pe";
                $subject = "Nuevo suscriptor";
                $message = "Nuevo suscriptor: " . $email;
                $headers = "From: noreply@jasil.pe";
                mail($to, $subject, $message, $headers);*/
                    echo json_encode(['status' => 'ok', 'message' => 'Gracias por subscribirte']);
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
