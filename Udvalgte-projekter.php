<?php

$projects = require __DIR__ . '/includes/udvalgte-projekter-data.php';

$slug = $_GET['project'] ?? 'spotless';

$currentProject = null;

foreach ($projects as $project) {
    if (($project['slug'] ?? '') === $slug) {
        $currentProject = $project;
        break;
    }
}

if (!$currentProject) {
    http_response_code(404);
    die('Projektet blev ikke fundet.');
}
?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">

    <title>Udvalgte projekter</title>

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

<main class="selected-mobile-page">

    <!-- =========================
         1. HERO
    ========================== -->
    <section class="selected-mobile-hero hero-theme-<?= htmlspecialchars($currentProject['slug']) ?>">

        <img
                src="img/billeder/hero_img.png"
                alt=""
                class="selected-mobile-hero-bg"
        >

        <canvas id="bubbleCanvas"></canvas>

        <a href="index.php"
           class="selected-mobile-logo"
           aria-label="Gå til forsiden">
            <img src="img/logo/PP-logo.png" alt="PP logo">
        </a>

        <div class="selected-mobile-hero-content">

            <h1 class="selected-mobile-title">
                <?= htmlspecialchars($currentProject['title']) ?>
            </h1>

            <img
                    src="<?= htmlspecialchars($currentProject['hero']['image']) ?>"
                    alt="<?= htmlspecialchars($currentProject['hero']['alt']) ?>"
                    class="selected-mobile-hero-project-img"
            >

        </div>

    </section>


    <!-- =========================
         2. PROJEKT INFO
    ========================== -->
    <section
            class="selected-mobile-project-section project-theme-<?= htmlspecialchars($currentProject['slug']) ?>"
    >

        <!-- Vandret projekt-slider -->
        <div class="selected-project-slider">

            <article class="selected-project-slide">
                <div class="selected-slide-bubbles" aria-hidden="true">
                    <span class="project-bubble bubble-a"></span>
                    <span class="project-bubble bubble-b"></span>
                    <span class="project-bubble bubble-c"></span>
                </div>

                <div class="selected-slide-content">
                    <h2>Projekt</h2>
                    <p>
                        <?= htmlspecialchars($currentProject['content']['projekt']) ?>
                    </p>
                </div>
            </article>


            <article class="selected-project-slide">
                <div class="selected-slide-bubbles" aria-hidden="true">
                    <span class="project-bubble bubble-a"></span>
                    <span class="project-bubble bubble-b"></span>
                    <span class="project-bubble bubble-c"></span>
                </div>

                <div class="selected-slide-content">
                    <h2>Proces</h2>
                    <p>
                        <?= htmlspecialchars($currentProject['content']['proces']) ?>
                    </p>
                </div>
            </article>


            <article class="selected-project-slide">
                <div class="selected-slide-bubbles" aria-hidden="true">
                    <span class="project-bubble bubble-a"></span>
                    <span class="project-bubble bubble-b"></span>
                </div>

                <div class="selected-slide-content">
                    <h2>Resultat</h2>
                    <p>
                        <?= htmlspecialchars($currentProject['content']['resultat']) ?>
                    </p>
                </div>
            </article>


            <article class="selected-project-slide">
                <div class="selected-slide-bubbles" aria-hidden="true">
                    <span class="project-bubble bubble-a"></span>
                    <span class="project-bubble bubble-b"></span>
                    <span class="project-bubble bubble-c"></span>
                </div>

                <div class="selected-slide-content">
                    <h2>Min rolle i projektet</h2>
                    <p>
                        <?= htmlspecialchars($currentProject['content']['rolle']) ?>
                    </p>
                </div>
            </article>


            <article class="selected-project-slide">
                <div class="selected-slide-bubbles" aria-hidden="true">
                    <span class="project-bubble bubble-a"></span>
                    <span class="project-bubble bubble-b"></span>
                    <span class="project-bubble bubble-c"></span>
                </div>

                <div class="selected-slide-content">
                    <h2>Kompetencer</h2>
                    <p>
                        <?= htmlspecialchars(
                                implode(' • ', $currentProject['skills'])
                        ) ?>
                    </p>
                </div>
            </article>

        </div>



        <!-- Visuel slider-indikator -->
        <div class="selected-project-scroll-indicator" aria-hidden="true">
            <span class="selected-project-scroll-line"></span>
            <span class="selected-project-scroll-handle"></span>
        </div>

    </section>


    <!-- =========================
         3. GALLERI
    ========================== -->

    <div class="selected-mobile-gallery-label">
        <span>Galleri</span>
    </div>

    <section class="selected-mobile-gallery">

        <div class="selected-mobile-gallery-track">

            <?php foreach ($currentProject['gallery'] as $image): ?>

                <button
                        type="button"
                        class="selected-mobile-gallery-item"
                >
                    <img
                            src="<?= htmlspecialchars($image['src']) ?>"
                            alt="<?= htmlspecialchars($image['alt']) ?>"
                    >
                </button>

            <?php endforeach; ?>

        </div>


        <div class="selected-mobile-gallery-slider" aria-hidden="true">
            <span class="slider-line"></span>
            <span class="slider-handle"></span>
        </div>

    </section>


    <!-- =========================
         4. LOGIN + WEBSITE
    ========================== -->
    <section class="selected-mobile-actions">

        <?php if (
                !empty($currentProject['login']) &&
                !empty($currentProject['login']['show'])
        ): ?>

            <div class="selected-mobile-login">

                <h2>Login til user:</h2>

                <?php if (!empty($currentProject['login']['username'])): ?>
                    <p>
                        Brugernavn:
                        <?= htmlspecialchars($currentProject['login']['username']) ?>
                    </p>
                <?php endif; ?>

                <?php if (!empty($currentProject['login']['password'])): ?>
                    <p>
                        Adgangskode:
                        <?= htmlspecialchars($currentProject['login']['password']) ?>
                    </p>
                <?php endif; ?>

            </div>

        <?php endif; ?>


        <?php if (!empty($currentProject['website']['show'])): ?>

            <a
                    href="<?= htmlspecialchars($currentProject['website']['url']) ?>"
                    class="selected-mobile-website-btn"
                    target="_blank"
                    rel="noopener noreferrer"
            >
                <?= htmlspecialchars($currentProject['website']['label']) ?>
            </a>

        <?php endif; ?>

    </section>

</main>

<!-- ==============
        Desktop
     ============== -->

<section class="selected-desktop-page">

    <nav class="sub-navbar">

        <div class="sub-logo">
            <a href="index.php" aria-label="gå til forside">
                <img src="img/logo/PP-logo.png" alt="PP logo">
            </a>
        </div>

        <ul class="desktop-nav-links">

            <li>
                <a href="index.php">Forside</a>
            </li>

            <li class="nav-divider">|</li>

            <li>
                <a href="Andre-projekter.php">Andre projekter</a>
            </li>

            <li class="nav-divider">|</li>

            <li>
                <a href="Udvalgte-projekter.php" class="active">
                    Udvalgte projekter
                </a>
            </li>

        </ul>

    </nav>

    <section class="selected-desktop-hero">

        <img src="img/billeder/hero_img.png" alt="" class="selected-desktop-hero-bg">

        <canvas id="selectedDesktopBubbleCanvas"></canvas>

        <h1>Udvalgte projekter</h1>

        <div class="selected-desktop-hero-images">
            <img src="img/billeder/hero1.png" alt="Spotless, Waybly og Semesterprøve">
        </div>

    </section>


    <section class="selected-desktop-projects">
        <div class="selected-desktop-tabs">

            <?php foreach ($projects as $index => $project): ?>

                <button type="button" class="selected-desktop-tab <?= $index === 0 ? 'active' : '' ?>" data-project="<?= htmlspecialchars($project['slug']) ?>">
                    <?= htmlspecialchars($project['title']) ?>
                </button>

            <?php endforeach; ?>
        </div>


        <div class="selected-desktop-card-stack">

            <?php foreach ($projects as $index => $project): ?>

                <article
                        class="selected-desktop-project-card <?= $index === 0 ? 'active' : '' ?>"
                        data-project-card="<?= htmlspecialchars($project['slug']) ?>"
                >

                    <div class="selected-desktop-card-inner">
                        <!-- VENSTRE SIDE -->
                        <div class="selected-desktop-card-gallery">

                            <div class="selected-desktop-main-image <?= htmlspecialchars($project['logo']['class']) ?>">
                                <img
                                        src="<?= htmlspecialchars($project['logo']['src']) ?>"
                                        alt="<?= htmlspecialchars($project['logo']['alt']) ?>"
                                >
                            </div>

                            <span class="selected-desktop-logo-label">Logo</span>

                            <?php $desktopGallery = array_slice($project['gallery'], 1); ?>

                            <?php foreach ($desktopGallery as $galleryIndex => $galleryImage): ?>

                                <div class="selected-desktop-gallery-row
                                    <?= $project['slug'] === 'semesterproeve'
                                    && $galleryIndex >= count($desktopGallery) - 2
                                        ? 'semester-bottom-image'
                                        : '' ?>">

                                    <img
                                            src="<?= htmlspecialchars($galleryImage['src']) ?>"
                                            alt="<?= htmlspecialchars($galleryImage['alt']) ?>"
                                    >

                                    <span class="selected-desktop-gallery-caption">
                <?= htmlspecialchars($galleryImage['label']) ?>
            </span>

                                </div>

                            <?php endforeach; ?>

                        </div>

                        <!-- HØJRE SIDE -->
                        <div class="selected-desktop-card-content">

                            <span class="selected-desktop-text-bubble"></span>

                            <div class="selected-desktop-text-block">
                                <h3>Projekt</h3>
                                <p>
                                    <?= htmlspecialchars($project['content']['projekt']) ?>
                                </p>
                            </div>


                            <div class="selected-desktop-text-block">
                                <h3>Proces</h3>
                                <p>
                                    <?= htmlspecialchars($project['content']['proces']) ?>
                                </p>
                            </div>


                            <div class="selected-desktop-text-block">
                                <h3>Resultat</h3>
                                <p>
                                    <?= htmlspecialchars($project['content']['resultat']) ?>
                                </p>
                            </div>


                            <div class="selected-desktop-text-block">
                                <h3>Min rolle i projektet</h3>
                                <p>
                                    <?= htmlspecialchars($project['content']['rolle']) ?>
                                </p>
                            </div>


                            <div class="selected-desktop-text-block">
                                <h3>Kompetencer</h3>
                                <p>
                                    <?= htmlspecialchars(implode(' • ', $project['skills'])) ?>
                                </p>
                            </div>

                        </div>

                    </div>


                    <!-- BUNDEN AF KORTET -->
                    <div class="selected-desktop-card-bottom">

                        <?php if (!empty($project['website']['show'])): ?>

                            <a
                                    href="<?= htmlspecialchars($project['website']['url']) ?>"
                                    class="selected-desktop-website-btn"
                                    target="_blank"
                                    rel="noopener noreferrer">

                                <?= htmlspecialchars($project['website']['label']) ?>
                            </a>

                        <?php endif; ?>


                        <?php if (
                                !empty($project['login']) &&
                                !empty($project['login']['show'])
                        ): ?>

                            <div class="selected-desktop-login">

                                <strong>Login til user:</strong>

                                <?php if (!empty($project['login']['username'])): ?>
                                    <span>
                                Brugernavn:
                                <?= htmlspecialchars($project['login']['username']) ?>
                            </span>
                                <?php endif; ?>


                                <?php if (!empty($project['login']['password'])): ?>
                                    <span>
                                Adgangskode:
                                <?= htmlspecialchars($project['login']['password']) ?>
                            </span>
                                <?php endif; ?>

                            </div>

                        <?php endif; ?>

                    </div>
                </article>

            <?php endforeach; ?>

        </div>
    </section>
</section>

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

<?php include "components/navbar.php"; ?>

<script src="index_js.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>

