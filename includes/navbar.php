<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$currentPage = basename($_SERVER['PHP_SELF']);

$currentDir = basename(dirname($_SERVER['PHP_SELF']));

$basePath = ($currentDir === 'students' || $currentDir === 'instructors') ? '../' : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $pageTitle ?? "Tech Journey" ?> | Tech Journey</title>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="<?= $basePath ?>css/style.css?v=<?= filemtime($basePath . 'css/style.css') ?>">

    <!-- Tracks CSS -->
    <?php if ($currentPage == 'tracks.php'): ?>
        <link rel="stylesheet" href="<?= $basePath ?>css/trackCss.css?v=<?= filemtime($basePath . 'css/trackCss.css') ?>">
    <?php endif; ?>

    <!-- Events CSS -->
    <?php if (
        $currentPage === 'events.php' ||
        $currentPage === 'add_events.php' ||
        $currentPage === 'edit_events.php'
    ): ?>
        <link rel="stylesheet"
            href="<?= $basePath ?>css/event_istructor_style.css?v=<?= filemtime($basePath . 'css/event_istructor_style.css') ?>">
    <?php endif; ?>

    <!-- Resources CSS -->
    <?php if ($currentPage == 'Resources-page.php'): ?>
        <link rel="stylesheet"
            href="<?= $basePath ?>css/resourseCss.css?v=<?= filemtime($basePath . 'css/resourseCss.css') ?>">
    <?php endif; ?>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body class="<?= $currentPage == 'index.php' || $currentPage == 'tracks.php' ? 'animated-page' : '' ?>"></body>>

<nav class="navbar">

    <div class="navbar-container">

        <!-- Logo -->
        <div class="navbar-left-group">
            <a href="<?= $basePath ?>index.php" class="logo">
                <img src="<?= $basePath ?>images/logo without background.png" alt="Tech Journey">
            </a>
        </div>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navLinks"
            aria-controls="navLinks" aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>

        <!-- Navigation -->
        <ul class="nav-links collapse" id="navLinks">

            <!-- Home -->
            <li>
                <a href="<?= $basePath ?>index.php" class="<?= $currentPage == 'index.php' ? 'active' : '' ?>">
                    Home
                </a>
            </li>

            <!-- Tracks -->
            <li>
                <a href="<?= $basePath ?>tracks.php" class="<?= $currentPage == 'tracks.php' ? 'active' : '' ?>">
                    Tracks
                </a>
            </li>

            <!-- Resources -->
            <li>
                <a href="<?= $basePath ?>Resources-page.php"
                    class="<?= $currentPage == 'Resources-page.php' ? 'active' : '' ?>">
                    Resources
                </a>
            </li>

            <!-- Events -->
            <?php
            if (isset($_SESSION['user_id']) && ($_SESSION['role'] ?? '') === 'instructor') {
                $eventsLink = $basePath . 'instructors/add_events.php';
            } else {
                $eventsLink = $basePath . 'students/events.php';
            }
            ?>

            <li>
                <a href="<?= $eventsLink ?>"
                    class="<?= $currentPage == 'events.php' || $currentPage == 'add_events.php' || $currentPage == 'edit_events.php' ? 'active' : '' ?>">
                    Events
                </a>
            </li>

            <!-- About -->
            <li>
                <a href="<?= $basePath ?>index.php#about">
                    About
                </a>
            </li>

            <?php if (!(isset($_SESSION['user_id']) && in_array(($_SESSION['role'] ?? ''), ['student', 'instructor'], true))): ?>
                <!-- Login -->
                <li id="navLoginItem"><a href="<?= $basePath ?>login.php" class="login-btn">Login</a></li>
            <?php endif; ?>

        </ul>

        <?php if (isset($_SESSION['user_id']) && in_array(($_SESSION['role'] ?? ''), ['student', 'instructor'], true)): ?>
            <div class="student-nav-account student-nav-account-right">
                <a href="<?= $basePath ?>profile.php" class="student-nav-avatar" aria-label="My Profile">
                    <?php
                    $navImage = $_SESSION['user_image'] ?? '';
                    $navParts = preg_split('/\\s+/', trim($_SESSION['user_name'] ?? ''), -1, PREG_SPLIT_NO_EMPTY);
                    $navInitials = '';
                    if ($navParts) {
                        $navInitials = strtoupper(substr($navParts[0], 0, 1));
                        if (count($navParts) > 1)
                            $navInitials .= strtoupper(substr($navParts[count($navParts) - 1], 0, 1));
                    }
                    ?>
                    <?php if ($navImage): ?>
                        <img src="<?= $basePath . htmlspecialchars($navImage, ENT_QUOTES, 'UTF-8') ?>" alt="Profile">
                    <?php else: ?>
                        <span><?= htmlspecialchars($navInitials ?: 'U') ?></span>
                    <?php endif; ?>
                </a>
                <a href="<?= $basePath ?>logout.php" class="student-logout">Logout</a>
            </div>
        <?php endif; ?>

    </div>

</nav>