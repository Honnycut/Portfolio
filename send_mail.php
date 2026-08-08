<?php
// Slå fejlvisning til, så vi kan se hvis noget går galt
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // 1. Hent og rens data
    $name    = htmlspecialchars($_POST['name'] ?? '');
    $email   = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['subject'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');

    // Tjek om felterne er udfyldt
    if (empty($name) || empty($email) || empty($message)) {
        http_response_code(400);
        echo "Udfyld venligst alle påkrævede felter.";
        exit;
    }

    // 2. Modtager & Afsender
    $to        = "piapetersen1103@gmail.com";
    $fromEmail = "kontakt@honnycut.dk";

    $email_subject = "Ny kontaktbesked: " . $subject;

    $body = "Du har modtaget en ny besked fra din webside.\n\n".
        "Navn: $name\n".
        "E-mail: $email\n\n".
        "Besked:\n$message";

    $headers  = "From: $fromEmail\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // 3. Send e-mail
    $sent = mail($to, $email_subject, $body, $headers, "-f " . $fromEmail);

    if ($sent) {
        http_response_code(200);
        echo "OK";
    } else {
        http_response_code(500);
        echo "Kunne ikke sende mailen via serveren.";
    }
    exit;
} else {
    http_response_code(405);
    echo "Metode ikke tilladt";
    exit;
}
?>
