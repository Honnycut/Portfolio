<?php
/**
 * @var db $db
 */

require "settings/init.php";

$json_path = 'data/projects.json';
$all_projects = [];

if (file_exists($json_path)) {
    $json_data = file_get_contents($json_path);
    $all_projects = json_decode($json_data, true) ?? [];
}

// Konfiguration af de 3 sektioner nøjagtigt fra din Figma
$sektioner = [
        [
                'category' => 'tema',
                'title'    => 'Tema opgaver',
                'subtitle' => 'Herunder ses og beskrives nogle af de temaer vi har været igennem under 1. og 2. semester.'
        ],
        [
                'category' => 'projekter',
                'title'    => 'Andet skolearbejde',
                'subtitle' => 'Korte projekter, øvelser og idegenerering lavet i løbet af uddannelsen.'
        ],
        [
                'category' => 'Fritid',
                'title'    => 'Andre projekter & kreative hobbier',
                'subtitle' => 'Et udvalg af mine egne projekter, hobbier og ting jeg hygger mig med privat.'
        ]
];
?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">

    <title>Andre projekter</title>

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

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<header class="sub-hero-header">
    <img src="img/billeder/hero_img.png" alt="Hero baggrund" class="sub-hero-bg-img">

    <canvas id="bubbleCanvas"></canvas>

    <nav class="sub-navbar">
        <div class="sub-logo">
            <a href="index.php" aria-label="gå til forside">
            <img src="img/logo/PP-logo.png" alt="PP logo">
            </a>
        </div>

        <!-- NYT DESKTOP MENU-LINKS (Bevarer din sub-navbar og aktiveres på desktop via SCSS) -->
        <ul class="desktop-nav-links">
            <li><a href="index.php">Forside</a></li>
            <li class="nav-divider">|</li>
            <li><a href="Andre-projekter.php" class="active">Andre projekter</a></li>
            <li class="nav-divider">|</li>
            <li><a href="#">Udvalgte projekter</a></li>
        </ul>

    </nav>

    <div class="sub-hero-layout">
        <div class="sub-hero-text">
            <h1 class="sub-hero-title">
                Andre <span class="hero-title-break">Projekter</span>
            </h1>
        </div>

        <div class="sub-hero-img-box">
            <img src="img/billeder/hero-target.png" alt="Andre Projekter" class="sub-hero-img">
        </div>
    </div>
</header>

<main class="page-projects-wrapper">

    <?php foreach ($sektioner as $sektion): ?>
        <?php
        $filtered_projects = array_filter($all_projects, function($project) use ($sektion) {
            return isset($project['category']) && strtolower($project['category']) === strtolower($sektion['category']);
        });
        ?>

        <!-- Sektion -->
        <section class="section-card-group">
            <div class="section-card-container">

                <h2 class="section-title"><?php echo htmlspecialchars($sektion['title']); ?></h2>
                <p class="section-subtitle"><?php echo htmlspecialchars($sektion['subtitle']); ?></p>

                <!-- Grid -->
                <div class="section-grid">
                    <?php if (!empty($filtered_projects)): ?>
                        <?php foreach ($filtered_projects as $item): ?>

                            <!-- Universelt Kort (Med præcise figma data & images) -->
                            <div class="universal-card js-popup-card"
                                 data-title="<?php echo htmlspecialchars($item['title'] ?? ''); ?>"
                                 data-images='<?php echo htmlspecialchars(json_encode($item['images'] ?? []), ENT_QUOTES, 'UTF-8'); ?>'
                                 data-desc="<?php echo htmlspecialchars($item['description'] ?? ''); ?>">

                                <div class="card-bg" style="background-image: url('<?php echo htmlspecialchars($item['thumbnail'] ?? ''); ?>');"></div>

                                <div class="card-badge">
                                    <span class="universal-card-title"><?php echo nl2br(htmlspecialchars($item['title'] ?? '')); ?></span>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

            </div>
        </section>

    <?php endforeach; ?>

</main>

<!-- NY DESKTOP FOOTER (Viser SoMe ikoner på stor skærm) -->
<footer class="site-footer">
    <div class="social-icons">

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
</footer>

<!-- FÆLLES UNIVERSAL POP-UP MODAL (Med Galleri) -->
<div id="globalModal" class="global-modal-overlay">
    <div class="global-modal-content">
        <button class="global-modal-close" id="globalModalClose">&times;</button>
        <h3 id="globalModalTitle" class="global-modal-title"></h3>

        <!-- Billed-container til at vise alle billeder fra 'images' -->
        <div id="globalModalGallery" class="global-modal-gallery"></div>

        <p id="globalModalDesc" class="global-modal-desc"></p>
    </div>
</div>

<div id="imageLightbox" class="image-lightbox">
    <button class="image-lightbox-close" aria-label="Luk billede">
        &times;
    </button>

    <img id="imageLightboxImg" src="" alt="">
</div>

<?php include "components/navbar.php"; ?>

<script src="index_js.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>