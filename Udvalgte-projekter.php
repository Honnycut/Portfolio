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

<?php include "components/navbar.php"; ?>

<script src="index_js.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>

