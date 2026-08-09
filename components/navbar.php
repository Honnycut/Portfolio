<?php
// Hent navnet på den nuværende side
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav class="bottom-nav">
    <a href="index.php" class="nav-item <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
        <i class="bi bi-house-door-fill"></i>
        <span class="nav-label">Home</span>
    </a>

    <a href="Andre-projekter.php" class="nav-item <?php echo ($current_page == 'Andre-projekter.php') ? 'active' : ''; ?>">
        <i class="bi bi-clipboard-data-fill"></i>
        <span class="nav-label">Andre projekter</span>
    </a>

    <a href="Spotless.php" class="nav-item <?php echo ($current_page == 'Spotless.php') ? 'active' : ''; ?>">
        <img src="img/icon/spotless.png" alt="Waybly" class="nav-icon-img">
        <span class="nav-label">Spotless</span>
    </a>

    <a href="Waybly.php" class="nav-item <?php echo ($current_page == 'Waybly.php') ? 'active' : ''; ?>">
        <img src="img/icon/waybly.png" alt="Waybly" class="nav-icon-img">
        <span class="nav-label">Waybly</span>
    </a>

    <a href="Semesterproeve.php" class="nav-item <?php echo ($current_page == 'Semesterproeve.php') ? 'active' : ''; ?>">
        <img src="img/icon/first.help.png" alt="Waybly" class="nav-icon-img">
        <span class="nav-label">Semesterprøve</span>
    </a>
</nav>