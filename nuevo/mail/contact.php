<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Requiere Composer (o puedes incluir los archivos manualmente si no usas Composer)
require '../vendor/autoload.php'; // Asegúrate de que esta ruta sea correcta

// Validación
if (
  empty($_POST['name']) ||
  empty($_POST['subject']) ||
  empty($_POST['message']) ||
  !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
) {
  http_response_code(500);
  exit();
}

// Sanitización
$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$m_subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));

// PHPMailer configuración
$mail = new PHPMailer(true);

try {
  // Configuración del servidor SMTP
  $mail->Host = 'mail.jordelingeneriasas.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'atencionalcliente@jordelingenieriasas.com';
  $mail->Password = 'JordelIngeneriasas10@'; // Cambia esto por la contraseña real
  $mail->SMTPSecure = 'ssl'; // o 'tls'
  $mail->Port = 465;
  // Remitente y destinatario
  $mail->setFrom($email, $name);
  $mail->addAddress('atencionalcliente@jordelingenieriasas.com', 'Jordelingenería');
  $mail->addReplyTo($email, $name);

  // Contenido del correo
  $mail->isHTML(false); // Usa true si prefieres HTML
  $mail->Subject = "$m_subject: $name";
  $mail->Body    = "You have received a new message from your website contact form.\n\n" .
    "Here are the details:\n\n" .
    "Name: $name\n\nEmail: $email\n\nSubject: $m_subject\n\nMessage: $message";

  $mail->send();
  http_response_code(200);
  echo "Message sent successfully.";
} catch (Exception $e) {
  http_response_code(500);
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
