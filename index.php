<?php
/**
 * @var db $db
 */
require "settings/init.php";

$statusMsg = "";

?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">
    
    <title>Pia's_Portfolio</title>
    
    <meta name="robots" content="All">
    <meta name="author" content="Pia Petersen">
    <meta name="copyright" content="Pia Petersen">
    
    <link href="css/styles.css" rel="stylesheet" type="text/css">

    <!-- Font Awesome ikoner -->
    <script src="https://kit.fontawesome.com/737b386bab.js" crossorigin="anonymous"></script>

    <!-- FAVICON -->
    <link rel="icon" type="image/png" href="img/logo/PP-logo.png">

    <!-- Bootstraps ikoner -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <meta name=" viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<header class="hero-header">

    <img src="img/billeder/hero_img.png" alt="Hero baggrund" class="hero-bg-img">

    <!-- Canvas til fysik-baserede bobler -->
    <canvas id="bubbleCanvas"></canvas>

    <nav class="navbar">
        <div class="logo">
            <img src="img/logo/PP-logo.png" alt="PP logo">
        </div>
    </nav>

    <!-- Hoved-layout til venstre/højre split -->
    <div class="hero-main-layout">

        <!-- Venstre side: Tekst & Knapper -->
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

        <!-- Højre side: Nyt lille billede -->
        <div class="hero-image-side">
            <img src="img/billeder/hero_billede.png" alt="Pia" class="hero-side-img">
        </div>

    </div>
</header>

<!-- Contact Modal Popup -->
<div id="contactModal" class="modal-overlay">
    <div class="modal-card">
        <button type="button" class="modal-close" id="closeModalBtn">&times;</button>

        <div class="modal-header-info">
            <p><strong>Du kan komme i kontakt med mig på flere måder:</strong></p>
            <p>📞 +45 4266074</p>
            <p>✉️ piapetersen1979@live.dk</p>
            <small>Eller du kan udfylde nedenstående formular. Jeg glæder mig til at høre fra dig!</small>
        </div>

        <form class="contact-form" id="contactForm">
            <label for="name">Navn (skal udfyldes)</label>
            <input type="text" id="name" name="name" required>

            <label for="email">E-mail (skal udfyldes)</label>
            <input type="email" id="email" name="email" required>

            <label for="subject">Emne</label>
            <input type="text" id="subject" name="subject">

            <label for="message">Din Besked</label>
            <textarea id="message" name="message" rows="4" required></textarea>

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

    <div class="projects-container">

        <!-- Wrapper til kortene og den smalle rosa bjælke -->
        <div class="projects-cards-wrap">
            <div class="projects-bg-bar"></div> <!-- Smal rosa stribe bagved -->

            <!-- Rosa bjælke bag det nederste centrerede kort -->
            <div class="projects-bg-bar-bottom"></div>

            <div class="projects-slider">
                <!-- Kort 1: Spotless -->
                <div class="project-card">
                    <div class="card-img-wrapper dark-blue-bg">
                        <img src="img/logo/logo_blue.png" alt="Spotless logo" style="filter: brightness(0) invert(1);">
                    </div>
                    <h3 class="card-title">Spotless</h3>
                    <p class="card-desc-title">SaaS - Software as a Service</p>
                    <p class="card-desc">Opgaven gik ud på at transformere en manuel eller forældet proces til en forenklet, digital SaaS-løsning med fokus på øget brugervenlighed.</p>
                    <a href="Spotless.php" class="btn-card d-lg-none">Se mere...</a>
                </div>

                <!-- Kort 2: Waybly -->
                <div class="project-card">
                    <div class="card-img-wrapper blue-bg">
                        <img src="img/logo/midwlogo.png" alt="Waybly logo">
                    </div>
                    <h3 class="card-title">Waybly</h3>
                    <p class="card-desc-title">UX & Tilgængelighed</p>
                    <p class="card-desc">Et projekt med fokus på User Experience og tilgængeligt design, hvor brugerbehov og kontekst var drivkraften bag den endelige digitale løsning.</p>
                    <a href="Waybly.php" class="btn-card d-lg-none">Se mere...</a>
                </div>

                <!-- Kort 3: Semesterprøve -->
                <div class="project-card">
                    <div class="card-img-wrapper green-bg" style="position: relative; overflow: hidden; border-radius: 24px;">
                        <img src="img/logo/logo1-1.png" alt="Semesterprøve logo" style="position: absolute; top: 50%; left: 50%; width: 80%; height: 80%; object-fit: contain; transform: translate(-48%, -48%);">
                    </div>
                    <h3 class="card-title">2. Semesterprøve</h3>
                    <p class="card-desc-title">Førstehjælpseksperten</p>
                    <p class="card-desc">Et tværfagligt projekt med fokus på helstøbte digitale løsninger. Opgaven kombinerede pensum fra 1. og 2. semester inden for UI-design, UX-research, indholdscreation, frontend og backend.</p>
                    <a href="Semesterproeve.php" class="btn-card d-lg-none">Se mere...</a>
                </div>
            </div>
        </div>

        <!-- Fælles knap på desktop PLACERET UDEN FOR bjælken -->
        <div class="projects-desktop-btn-wrap d-none d-lg-flex">
            <a href="Andre-projekter.php" class="btn-projects-all">Se mere....</a>
        </div>

        <!-- Indikator prikker (Mobil & Tablet) -->
        <div class="slider-dots d-lg-none">
            <span class="dot active"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>

    </div>
</section>

<!-- HVEM ER JEG? SEKTION (3 Kolonner på Desktop) -->
<section class="about-section">
    <div class="about-container">
        <!-- Kolonne 1: Billede -->
        <div class="profile-img-wrapper">
            <img src="img/billeder/me.png" alt="Pia - Multimediedesigner" class="profile-img">
        </div>

        <!-- Kolonne 2: Overskrift & Lodret Streg -->
        <div class="about-header-col">
            <h2 class="about-title">Hvem er jeg?</h2>
            <div class="about-divider d-none d-lg-block"></div>
        </div>

        <!-- Kolonne 3: Tekst -->
        <div class="about-text-wrapper">
            <p class="about-intro">
                Godt design handler ikke kun om, hvordan det ser ud – men om, hvordan det føles at bruge.
            </p>

            <div class="about-more-text" id="moreText">
                <p>
                    Jeg hedder Pia og studerer til multimediedesigner med fokus på UI/UX og brugervenlige digitale løsninger.Jeg brænder<br>for at skabe intuitive designs, hvor funktionalitet, æstetik og brugeroplevelse går hånd i hånd.
                </p>
                <p>
                    Min erfaring fra kundeservice, procesoptimering og pædagogik har givet mig en stærk forståelse for mennesker<br>og deres behov – en styrke, jeg tager med ind i hver eneste designproces.
                </p>
            </div>

            <button class="toggle-btn d-lg-none" id="toggleBtn" onclick="toggleAbout()">
                <span id="btnText">Se mere</span>
                <svg id="btnIcon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m6 9 6 6 6-6"/>
                </svg>
            </button>
        </div>
    </div>
</section>

<!-- MINE KOMPETENCER -->
<section class="skills-section">
    <div class="skills-container">
        <h2 class="skills-title">Mine kompetencer</h2>

        <div class="skills-grid">
            <div class="skill-badge">
                <img src="img/icon/figma_logo_icon_147289.png" class="skill-icon" alt="Figma">
                <span>Figma</span>
            </div>
            <div class="skill-badge">
                <img src="img/icon/image (7-1).png" class="skill-icon" alt="UI/UX">
                <span>UI/UX</span>
            </div>
            <div class="skill-badge">
                <img src="img/icon/adobe-illustrator-icon-free-png.webp" class="skill-icon" alt="Adobe Illustrator">
                <span>Adobe Illustrator</span>
            </div>
            <div class="skill-badge">
                <img src="img/icon/Logo-Adobe-Photoshop-CC-Vector-PNG.png" class="skill-icon" alt="Photoshop">
                <span>Photoshop</span>
            </div>
            <div class="skill-badge">
                <img src="img/icon/optimering.png" class="skill-icon" alt="Procesoptimering">
                <span>Proces<br>optimering</span>
            </div>
            <div class="skill-badge">
                <img src="img/icon/VN.png" class="skill-icon" alt="Video editor">
                <span>Video editor</span>
            </div>
            <div class="skill-badge">
                <img src="img/icon/frontend.png" class="skill-icon" alt="Front">
                <span>Frontend</span>
            </div>
            <div class="skill-badge">
                <img src="img/icon/Backend.png" class="skill-icon" alt="Back">
                <span>Backend</span>
            </div>
            <div class="skill-badge">
                <img src="img/icon/images.png" class="skill-icon" alt="HTML/CSS">
                <span>HTML/CSS<br>Javascript</span>
            </div>
            <div class="skill-badge">
                <img src="img/icon/bootstrap-logo-rounded-free-png.webp" class="skill-icon" alt="Bootstrap">
                <span>Bootstrap</span>
            </div>
            <div class="skill-badge">
                <img src="img/icon/SCSS-File-Flat-Icon-Vector-Graphics-14768656-1-1-580x348.png" class="skill-icon" alt="Scss">
                <span>Scss</span>
            </div>
            <div class="skill-badge">
                <img src="img/icon/php-file-format-icon-php-file-format-3d-render-icon-with-transparent-background-php-file-format-document-color-icon-vector.png" class="skill-icon" alt="PHP">
                <span>PHP - SaaS</span>
            </div>
        </div>

        <div class="skills-socials">
            <a href="https://www.facebook.com/pia.a.petersen" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                <i class="fa-brands fa-facebook-f"></i>
            </a>
            <a href="https://www.linkedin.com/in/pia-petersen-5aa252395/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                <i class="fa-brands fa-linkedin-in"></i>
            </a>
            <a href="https://github.com/Honnycut/Portfolio" target="_blank" rel="noopener noreferrer" aria-label="GitHub">
                <i class="fa-brands fa-github"></i>
            </a>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="index_js.js"></script>

</body>
</html>
