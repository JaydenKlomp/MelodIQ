<?php /** @var $topPlayers */ ?>
<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>
<div class="container mt-5">

    <!-- Hero Section -->
    <div class="hero">
        <h1>Welcome to MelodIQ</h1>
        <p>Test your music knowledge with fun and engaging trivia games!</p>
        <a href="<?= base_url('trivias') ?>" class="btn btn-lg btn-warning cta-btn">Play Now</a>
    </div>

    <!-- User Stats (if logged in) -->
    <?php if (session()->get('isLoggedIn')): ?>
        <div class="stats mt-5">
            <h3>Your Progress</h3>
            <div class="row mt-4">
                <div class="col-md-4">
                    <h4><?= esc($userStats['trivia_played'] ?? 0) ?></h4>
                    <p>Trivias Played</p>
                </div>
                <div class="col-md-4">
                    <h4><?= esc($userStats['total_points'] ?? 0) ?></h4>
                    <p>Total Points</p>
                </div>
                <div class="col-md-4">
                    <h4><?= esc($userStats['correct_answers'] ?? 0) ?></h4>
                    <p>Correct Answers</p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Trivia Categories -->
    <div class="mt-5 text-center">
        <h3>Explore Music Trivia</h3>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="trivia-card">
                    <h5>Classic Rock</h5>
                    <p>Test your knowledge of rock legends and timeless hits!</p>
                    <a href="<?= base_url('trivias?category=rock') ?>" class="btn btn-outline-light">Play Now</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="trivia-card">
                    <h5>Pop Music</h5>
                    <p>Can you recognize these pop anthems and artists?</p>
                    <a href="<?= base_url('trivias?category=pop') ?>" class="btn btn-outline-light">Play Now</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="trivia-card">
                    <h5>Hip-Hop & Rap</h5>
                    <p>Prove you're a rap expert with this hip-hop challenge!</p>
                    <a href="<?= base_url('trivias?category=hiphop') ?>" class="btn btn-outline-light">Play Now</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Leaderboard Section -->
    <div class="leaderboard mt-5 p-4">
        <h3 class="text-center">🏆 Top Players</h3>
        <div class="table-responsive">
            <table class="table leaderboard-table">
                <thead>
                <tr>
                    <th class="rank-col">Rank</th>
                    <th>Username</th>
                    <th>🏆 Points</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($topPlayers as $index => $player): ?>
                    <tr class="<?= ($index == 0) ? 'gold' : (($index == 1) ? 'silver' : (($index == 2) ? 'bronze' : '')) ?>">
                        <td class="rank-col">#<?= $index + 1 ?></td>
                        <td>
                            <a href="<?= base_url('profile/' . $player['username']) ?>" class="player-link">
                                <img src="<?= base_url($player['avatar'] ?: 'uploads/avatars/default.jpg') ?>" class="avatar-img">
                                <?= esc($player['username']) ?>
                            </a>
                        </td>
                        <td><strong><?= esc($player['total_points']) ?></strong></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
