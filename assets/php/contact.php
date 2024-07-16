<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
// Only process POST reqeusts.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form fields and remove whitespace.
    $name = strip_tags(trim($_POST["name"]));
    $name = str_replace(array("\r", "\n"), array(" ", " "), $name);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $number = filter_var(trim($_POST["number"]), FILTER_SANITIZE_EMAIL);
    //$subject = filter_var(trim($_POST["subject"]), FILTER_SANITIZE_EMAIL);
    $subject = $_POST["subject"];
    $message = trim($_POST["message"]);

    // Check that data was sent to the mailer.
    if (empty($name) or empty($message) or empty($subject) or !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Set a 400 (bad request) response code and exit.
        http_response_code(400);
        echo "Please complete the form and try again.";
        exit;
    }

    // Set the recipient email address.
    // FIXME: Update this to your desired email address.
    $recipient = "atencionalcliente@jordelingeneriasas.com";

    // Set the email subject.
    $subject = "$subject";

    // Build the email content.
    //$email_content = "Name: $name\n";
    //$email_content .= "Email: $email\n";
    //$email_content .= "Number: $number\n\n";
    //$email_content .= "Subject: $subject\n\n";
    //$email_content .= "Message:\n$message\n";

    $email_content = '
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Correo Electrónico Formal</title>
<style>
    /* Estilos generales */
    body {
        position: relative;
        z-index: 1;
        padding: 160px 0 120px;
        background-image: url(../img/hero/fondo1.png); /* Verifica que la ruta sea correcta */
        background-repeat: no-repeat;
        background-position: left bottom;
        background-size: cover;
        font-family: Arial, sans-serif;
        line-height: 1.6;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 600px;
        margin: 20px auto;
        background: #ffffff;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h1, p {
        margin: 0 0 10px;
    }
    p {
        font-size: 16px;
    }
    .saludo {
        margin-bottom: 20px;
    }
    .despedida {
        margin-top: 20px;
    }
    .footer {
        margin-top: 20px;
        font-size: 14px;
        color: #777;
    }
</style>
</head>
<body>
<div class="container">
    <h1>Asunto: ' . $subject . '</h1>
    <p class="saludo">Estimado Sr. Jordel ,</p>
    <p>' . $message . '</p>
    <p class="footer">Saludos cordiales,<br>' . $name . '<br>Teléfono: ' . $number . '<br>Correo electrónico: ' . $email . '</p>
</div>
</body>
</html>

    ';
    $headers = "MIME-VERSION: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    // Build the email headers.
    $email_headers = "$subject";

    // Send the email.
    if (mail($recipient, $email_headers, $email_content, $headers)) {
        // Set a 200 (okay) response code.
        http_response_code(200);
?>
        <!-- Error 404 Template 1 - Bootstrap Brain Component -->
        <title>Connected´s || El mundo a tu alcance</title>
        <link rel="shortcut icon" type="image/x-icon" href="../img/logo.png" />
        <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/error-404s/error-404-1/assets/css/error-404-1.css">
        <style>
            body {
                position: relative;
                z-index: 1;
                padding: 160px 0 120px;
                background-image: url(../img/hero/fondo1.png);
                /* Verifica que la ruta sea correcta */
                background-repeat: no-repeat;
                background-position: left bottom;
                background-size: cover;
                font-family: Arial, sans-serif;
                line-height: 1.6;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }
        </style>

        <body>
            <section class="py-3 py-md-5 min-vh-100 d-flex justify-content-center align-items-center">
                <div class="container">
                    <div class="row">
                        <div style="text-align: center;">
                            <figure class="figure">
                                <img src="../img/logo.png" class="figure-img img-fluid rounded" alt="...">
                            </figure>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center">
                                <h2 class="d-flex justify-content-center align-items-center gap-2 mb-4">
                                    Super!! En Unos Momentos Uno De Nuestros Asesores Se Comunicara Con Usted
                                </h2>
                                <h3 class="h2 mb-2">Correo Enviado Exitosamente.</h3>
                                <p class="mb-5">Gracias Por comunicarte con nosotros.</p>
                                <a class="btn bsb-btn-5xl btn-dark rounded-pill px-5 fs-6 m-0" href="#" onclick="history.back(); return false;" role="button">Volver al Inicio</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </body>
    <?php
    } else {
        // Set a 500 (internal server error) response code.
        http_response_code(500);

    ?>
        <title>Connected´s || El mundo a tu alcance</title>
        <link rel="shortcut icon" type="image/x-icon" href="../img/logo.png" />
        <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/error-404s/error-404-1/assets/css/error-404-1.css">
        <!-- Error 404 Template 1 - Bootstrap Brain Component -->
        <style>
            body {
                position: relative;
                z-index: 1;
                padding: 160px 0 120px;
                background-image: url(../img/hero/fondo1.png);
                /* Verifica que la ruta sea correcta */
                background-repeat: no-repeat;
                background-position: left bottom;
                background-size: cover;
                font-family: Arial, sans-serif;
                line-height: 1.6;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }
        </style>

        <body>
            <section class="py-3 py-md-5 min-vh-100 d-flex justify-content-center align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center">
                                <h2 class="d-flex justify-content-center align-items-center gap-2 mb-4">
                                    <span class="display-1 fw-bold">4</span>
                                    <i class="bi bi-exclamation-circle-fill text-danger display-4"></i>
                                    <span class="display-1 fw-bold bsb-flip-h">4</span>
                                </h2>
                                <h3 class="h2 mb-2">¡Ups! Tu Correo No se Puedo Enviar.</h3>
                                <p class="mb-5">Por favor Vuelve a intentar o escribenos a nuestros canales por whatsapp.</p>
                                <a class="btn bsb-btn-5xl btn-dark rounded-pill px-5 fs-6 m-0" href="#" onclick="history.back(); return false;" role="button">Back to Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </body>
    <?php
    }
} else {
    // Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    ?>
    <title>Connected´s || El mundo a tu alcance</title>
    <link rel="shortcut icon" type="image/x-icon" href="../img/logo.png" />
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/error-404s/error-404-1/assets/css/error-404-1.css">
    <!-- Error 404 Template 1 - Bootstrap Brain Component -->
    <section class="py-3 py-md-5 min-vh-100 d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <h2 class="d-flex justify-content-center align-items-center gap-2 mb-4">
                            <span class="display-1 fw-bold">4</span>
                            <i class="bi bi-exclamation-circle-fill text-danger display-4"></i>
                            <span class="display-1 fw-bold bsb-flip-h">4</span>
                        </h2>
                        <h3 class="h2 mb-2">¡Ups! Tu Correo No se Puedo Enviar.</h3>
                        <p class="mb-5">Por favor Vuelve a intentar o escribenos a nuestros canales por whatsapp.</p>
                        <a class="btn bsb-btn-5xl btn-dark rounded-pill px-5 fs-6 m-0" href="#" onclick="history.back(); return false;" role="button">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
}
