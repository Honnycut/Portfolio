<?php
/**
 * @var db $db
 */

require "settings/init.php";
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

    <!-- Canvas til fysik-baserede bobler -->
    <canvas id="bubbleCanvas"></canvas>

    <nav class="navbar">
        <div class="logo">
            <img src="img/logo/e5c3a926-0a69-4233-8852-ee861d1e8d96-1.png" alt="PP logo">
        </div>
    </nav>

    <!-- Centreret layout -->
    <div class="sub-hero-layout">
        <div class="sub-hero-text">
            <h1>ANDRE PROJEKTER</h1>
        </div>

        <div class="sub-hero-img-box">
            <img src="img/billeder/hero-target.png" alt="Andre Projekter" class="sub-hero-img">
        </div>
    </div>
</header>

<?php include "components/navbar.php"; ?>

<script src="index_js.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>