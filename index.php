<?php
/**
 * @var db $db
 */
require "settings/init.php";

$statusMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Hent data fra formularen og rens dem
    $name    = htmlspecialchars($_POST['name']);
    $email   = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Din e-mailadresse, hvor beskeden skal modtages
    $to = "piapetersen1979@live.dk";

    // E-mail overskrift
    $email_subject = "Ny kontaktbesked fra: " . $subject;

    // E-mailens indhold
    $body = "Du har modtaget en ny besked fra din webside.\n\n".
            "Navn: $name\n".
            "E-mail: $email\n\n".
            "Besked:\n$message";

    // Headers
    $headers = "From: webmaster@ditdomaene.dk\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send e-mailen
    if (mail($to, $email_subject, $body, $headers)) {
        $statusMsg = "Tak! Din besked er blevet sendt.";
    } else {
        $statusMsg = "Der opstod en fejl. Prøv venligst igen.";
    }
}
?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">
    
    <title>Pia's_Portfolio</title>
    
    <meta name="robots" content="All">
    <meta name="author" content="Udgiver">
    <meta name="copyright" content="Information om copyright">
    
    <link href="css/styles.css" rel="stylesheet" type="text/css">

    <!-- Font Awesome ikoner -->
    <script src="https://kit.fontawesome.com/737b386bab.js" crossorigin="anonymous"></script>

    <!-- Bootstraps ikoner -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="s

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<header class="hero-header">

    <img src="img/billeder/hero_img.png" alt="Hero baggrund" class="hero-bg-img">

    <!-- Canvas til fysik-baserede bobler -->
    <canvas id="bubbleCanvas"></canvas>

    <nav class="navbar">
        <div class="logo">
            <img src="img/logo/e5c3a926-0a69-4233-8852-ee861d1e8d96-1.png" alt="PP logo">
        </div>
    </nav>

    <div class="hero-content">
        <h1>Multimediestuderende<br>med fokus på<br>kreativ og digital<br>identitet.</h1>

        <p class="hero-subtitle">
            Jeg skaber digitale oplevelser gennem design, UX, visuel identitet og kreativ udvikling.
        </p>

        <div class="hero-buttons">
            <a href="Andre-projekter.php" class="btn-custom btn-custom-primary">Se mit arbejdet</a>
            <button id="openModalBtn" type="button" class="btn-custom btn-custom-secondary">Kontakt mig</button>
        </div>
    </div>
</header>

<!-- Contact Modal Popup -->
<div id="contactModal" class="modal-overlay">
    <div class="modal-card">
        <button type="button" class="modal-close" id="closeModalBtn">&times;</button>

        <div class="modal-header-info">
            <p><strong>Du kan komme i kontakt med mig på flere måder:</strong></p>
            <p>📞 +45 12 34 56 78</p>
            <p>✉️ din-email@adresse.dk</p>
            <small>Eller du kan udfylde nedenstående formular. Jeg glæder mig til at høre fra dig!</small>
        </div>

        <form class="contact-form" id="contactForm">
            <label for="name">Navn (skal udfyldes)</label>
            <input type="text" id="name" required>

            <label for="email">E-mail (skal udfyldes)</label>
            <input type="email" id="email" required>

            <label for="subject">Emne</label>
            <input type="text" id="subject">

            <label for="message">Din Besked</label>
            <textarea id="message" rows="4" required></textarea>

            <button type="submit" class="btn-send">SEND</button>
        </form>
    </div>
</div>

<!-- Tak Modal Popup -->
<div id="successModal" class="modal-overlay">
    <div class="modal-card success-card">
        <h2>Tak for din besked! 💚</h2>
        <p>Din besked er sendt, og jeg vender tilbage hurtigst muligt. Tak fordi du tog dig tid til at kontakte mig.</p>
        <button type="button" id="closeSuccessBtn" class="btn-luk">LUK</button>
    </div>
</div>

<!-- UDVALGTE PROJEKTER SEKTION -->
<section class="projects-section">
    <h2 class="section-title">Udvalgte projekter</h2>

    <div class="projects-slider">
        <!-- Kort 1: Spotless (Nu med dark-blue-bg) -->
        <div class="project-card">
            <div class="card-img-wrapper dark-blue-bg">
                <img src="img/logo/logo_blue.png" alt="Spotless logo" style="filter: brightness(0) invert(1);">
            </div>
            <h3 class="card-title">Spotless</h3>
            <a href="Spotless.php" class="btn-card">Se mere...</a>
        </div>

        <!-- Kort 2: Waybly (Nu med blue-bg) -->
        <div class="project-card">
            <div class="card-img-wrapper blue-bg">
                <img src="img/logo/midwlogo.png" alt="Waybly logo">
            </div>
            <h3 class="card-title">Waybly</h3>
            <a href="Waybly.php" class="btn-card">Se mere...</a>
        </div>

        <!-- Kort 3: Semesterprøve -->
        <div class="project-card">
            <div class="card-img-wrapper green-bg" style="position: relative; overflow: hidden; border-radius: 24px;">
                <img src="img/logo/logo1-1.png" alt="Semesterprøve logo" style="position: absolute; top: 50%; left: 50%; width: 80%; height: 80%; object-fit: contain; transform: translate(-48%, -48%);">
            </div>
            <h3 class="card-title">Semesterprøve</h3>
            <a href="Semesterproeve.php" class="btn-card">Se mere...</a>
        </div>
    </div>

    <!-- Indikator prikker i bunden -->
    <div class="slider-dots">
        <span class="dot active"></span>
        <span class="dot"></span>
        <span class="dot"></span>
    </div>
</section>

<section class="about-section">
    <div class="about-container">
        <div class="profile-img-wrapper">
            <!-- Ret stien 'img/profile.jpg' til det rigtige navn på dit profilbillede -->
            <img src="img/profile.jpg" alt="Pia - Multimediedesigner" class="profile-img">
        </div>

        <h2 class="about-title">Hvem er jeg?</h2>

        <p class="about-intro">
            Godt design handler ikke kun om, hvordan det ser ud – men om, hvordan det føles at bruge.
        </p>

        <div class="about-more-text" id="moreText">
            <p>
                Jeg hedder Pia og studerer til multimediedesigner med fokus på UI/UX og brugervenlige digitale løsninger. Jeg brænder for at skabe intuitive designs, hvor funktionalitet, æstetik og brugeroplevelse går hånd i hånd.
            </p>
            <p>
                Min erfaring fra kundeservice, procesoptimering og pædagogik har givet mig en stærk forståelse for mennesker og deres behov – en styrke, jeg tager med ind i hver eneste designproces.
            </p>
        </div>

        <button class="toggle-btn" id="toggleBtn" onclick="toggleAbout()">
            <span id="btnText">Se mere</span>
            <svg id="btnIcon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m6 9 6 6 6-6"/>
            </svg>
        </button>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="index_js.js"></script>

</body>
</html>
