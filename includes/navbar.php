<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? "Tech Journey" ?> | Tech Journey</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css?v=<?= filemtime('css/style.css') ?>">
    <?php if ($currentPage == 'tracks.php'): ?>
        <link rel="stylesheet" href="css/trackCss.css?v=<?= filemtime('css/trackCss.css') ?>">
    <?php endif; ?>

    <?php if ($currentPage == 'add_events.php'): ?>
        <link rel="stylesheet" href="../css/event_istructor_style.css?v <?= filemtime('../css/event_istructor_style.css') ?>">
    <?php endif; ?>

    <?php if ($currentPage == 'events.php'): ?>
        <link rel="stylesheet" href="../css/event_istructor_style.css?v <?= filemtime('../css/event_istructor_style.css') ?>">
    <?php endif; ?>

    <?php if ($currentPage == 'Resources-page.php'): ?>
        <link rel="stylesheet" href="css/resourseCss.css?v=<?= filemtime('css/resourseCss.css') ?>">
    <?php endif; ?>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar">
        <div class="navbar-container">

            <!-- Logo -->
            <a href="index.php" class="logo">
                <img src="images/logo without background.png" alt="Tech Journey">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navLinks"
                aria-controls="navLinks" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <ul class="nav-links collapse" id="navLinks">

                <li>
                    <a href="index.php" class="<?= $currentPage == 'index.php' ? 'active' : '' ?>">
                        Home
                    </a>
                </li>

                <li>
                    <a href="tracks.php" target="_blank" class="<?= $currentPage == 'tracks.php' ? 'active' : '' ?>">
                        Tracks
                    </a>
                </li>
                <li>
                    <a href="Resources-page.php" target="_blank"
                        class="<?= $currentPage == 'Resources-page.php' ? 'active' : '' ?>">
                        Resources
                    </a>
                </li>

                <li>
                    <a href="events.php" target="_blank" class="<?= $currentPage == 'events.php' ? 'active' : '' ?>">
                        Events
                    </a>
                </li>


                <li>
                    <a href="index.php#about">
                        About
                    </a>
                </li>

                <li id="navLoginItem">
                    <a href="login.php" class="login-btn" target="_blank">Login</a>
                </li>

            </ul>

        </div>
    </nav>