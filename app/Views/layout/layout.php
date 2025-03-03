<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MelodIQ - Music Trivia</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">

    <!-- jQuery & Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= base_url() ?>">MelodIQ</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if (session()->get('is_admin')): ?>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-warning text-white mx-2" href="<?= base_url('trivia/create') ?>">Create Trivia</a>
                    </li>
                <?php endif; ?>

                <li class="nav-item"><a class="nav-link" href="<?= base_url('trivias') ?>">Trivias</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('leaderboard') ?>">Leaderboard</a></li>

                <!-- Profile Dropdown -->
                <li class="nav-item dropdown">
                    <?php if(session()->get('isLoggedIn')): ?>
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <img src="<?= base_url(session()->get('avatar') ?: 'uploads/avatars/default.png') ?>" class="rounded-circle border" width="35" height="35">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('profile') ?>">Profile</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('settings') ?>">Settings</a></li>
                            <li><a class="dropdown-item text-danger" href="<?= base_url('logout') ?>">Logout</a></li>
                        </ul>
                    <?php else: ?>
                        <a class="nav-link dropdown-toggle" href="#" id="guestDropdown" role="button" data-bs-toggle="dropdown">
                            <img src="<?= base_url('uploads/avatars/default.png') ?>" class="rounded-circle border" width="35" height="35">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="guestDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('login') ?>">Login</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('register') ?>">Register</a></li>
                        </ul>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container mt-4">
    <?= $this->renderSection('content') ?>
</div>

</body>
</html>
