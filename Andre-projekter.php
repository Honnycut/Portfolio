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
    <meta name="author" content="Udgiver">
    <meta name="copyright" content="Information om copyright">

    <link href="css/styles.css" rel="stylesheet" type="text/css">

    <!-- Font Awesome ikoner -->
    <script src="https://kit.fontawesome.com/737b386bab.js" crossorigin="anonymous"></script>

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
            <img src="img/logo/e5c3a926-0a69-4233-8852-ee861d1e8d96-1.png" alt="PP logo">
        </div>

        <!-- NYT DESKTOP MENU-LINKS (Bevarer din sub-navbar og aktiveres på desktop via SCSS) -->
        <ul class="desktop-nav-links">
            <li><a href="index.php">Forside</a></li>
            <li><a href="Andre_projekter.php" class="active">Andre projekter</a></li>
            <li><a href="index.php#udvalgte">Udvalgte projekter</a></li>
            <li><a href="index.php#kontakt">Kontakt</a></li>
        </ul>

    </nav>

    <div class="sub-hero-layout">
        <div class="sub-hero-text">
            <h1 class="sub-hero-title">Andre<br>Projekter</h1>
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
        <a href="https://www.facebook.com/pia.a.petersen" target="_blank" rel="noopener noreferrer" aria-label="Facebook"></a>
            <i class="fa-brands fa-facebook-f"></i>
        <a href="https://www.linkedin.com/in/pia-petersen-5aa252395/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"></a>
            <i class="fa-brands fa-linkedin-in"></i>
        <a href="https://github.com/Honnycut/Portfolio" target="_blank" rel="noopener noreferrer" aria-label="GitHub"></a>
            <i class="fa-brands fa-github"></i>
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

<?php include "components/navbar.php"; ?>

<script src="index_js.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>