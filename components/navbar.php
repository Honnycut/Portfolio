<?php
$current_page = basename($_SERVER['PHP_SELF']);
$current_project = $_GET['project'] ?? '';
?>

<nav class="bottom-nav">

    <!-- HOME -->
    <a href="index.php"
       class="nav-item <?php echo ($current_page === 'index.php') ? 'active' : ''; ?>">

        <i class="bi bi-house-fill"></i>
        <span class="nav-label">Home</span>
    </a>


    <!-- ANDRE PROJEKTER -->
    <a href="Andre-projekter.php"
       class="nav-item <?php echo ($current_page === 'Andre-projekter.php') ? 'active' : ''; ?>">

        <i class="bi bi-clipboard-data-fill"></i>
        <span class="nav-label">Andre projekter</span>
    </a>


    <!-- SPOTLESS -->
    <a href="Udvalgte-projekter.php?project=spotless"
       class="nav-item <?php echo (
               $current_page === 'Udvalgte-projekter.php'
               && $current_project === 'spotless'
       ) ? 'active' : ''; ?>">

        <img
                src="img/icon/spotless.png"
                alt="Spotless"
                class="nav-icon-img"
        >

        <span class="nav-label">Spotless</span>
    </a>


    <!-- WAYBLY -->
    <a href="Udvalgte-projekter.php?project=waybly"
       class="nav-item <?php echo (
               $current_page === 'Udvalgte-projekter.php'
               && $current_project === 'waybly'
       ) ? 'active' : ''; ?>">

        <img
                src="img/icon/waybly.png"
                alt="Waybly"
                class="nav-icon-img"
        >

        <span class="nav-label">Waybly</span>
    </a>


    <!-- SEMESTERPRØVE -->
    <a href="Udvalgte-projekter.php?project=semesterproeve"
       class="nav-item <?php echo (
               $current_page === 'Udvalgte-projekter.php'
               && $current_project === 'semesterproeve'
       ) ? 'active' : ''; ?>">

        <img
                src="img/icon/first.help.png"
                alt="Semesterprøve"
                class="nav-icon-img"
        >

        <span class="nav-label">Semesterprøve</span>
    </a>

</nav>