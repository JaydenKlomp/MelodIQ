<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="<?= base_url('css/profile.css') ?>">

<?php
use App\Models\FollowersModel;
$followersModel = new FollowersModel();
$isFollowing = session()->get('isLoggedIn') ? $followersModel->isFollowing(session()->get('id'), $user['id']) : false;
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card profile-card shadow-lg">
                <div class="card-body text-center">
                    <div class="profile-header">
                        <img src="<?= base_url($user['avatar'] ?: 'uploads/avatars/default.jpg') ?>" class="profile-avatar">
                        <h2 class="mt-3"><?= esc($user['username']) ?></h2>
                        <p class="profile-bio"><?= esc($user['bio'] ?: 'No bio yet.') ?></p>
                    </div>

                    <!-- User Stats -->
                    <div class="profile-stats">
                        <div class="stat-item">
                            <h5 class="stat-number"><?= esc($user['trivia_played']) ?></h5>
                            <p>Games Played</p>
                        </div>
                        <div class="stat-item">
                            <h5 class="stat-number"><?= esc($followers) ?></h5>
                            <p>Followers</p>
                        </div>
                        <div class="stat-item">
                            <h5 class="stat-number"><?= esc($following) ?></h5>
                            <p>Following</p>
                        </div>
                    </div>

                    <div class="profile-stats">
                        <div class="stat-item">
                            <h5 class="stat-number"><?= esc($user['total_points']) ?></h5>
                            <p>Total Points</p>
                        </div>
                        <div class="stat-item">
                            <h5 class="stat-number"><?= esc($accuracy) ?>%</h5>
                            <p>Answer Accuracy</p>
                        </div>
                        <div class="stat-item">
                            <h5 class="stat-number">#<?= esc($rank) ?></h5>
                            <p>Leaderboard Rank</p>
                        </div>
                    </div>

                    <!-- Follow & Edit Profile Buttons -->
                    <div class="profile-actions mt-4">
                        <?php if (session()->get('isLoggedIn') && session()->get('id') !== $user['id']): ?>
                            <?php if ($isFollowing): ?>
                                <a href="<?= base_url('unfollow/' . $user['username']) ?>" class="btn btn-danger btn-action">Unfollow</a>
                            <?php else: ?>
                                <a href="<?= base_url('follow/' . $user['username']) ?>" class="btn btn-success btn-action">Follow</a>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if (session()->get('id') == $user['id']): ?>
                            <a href="<?= base_url('settings') ?>" class="btn btn-primary btn-action">Edit Profile</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
<script src="<?= base_url('js/profile.js') ?>"></script>

<?= $this->endSection() ?>
