<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>
<?php
use App\Models\FollowersModel;
$followersModel = new FollowersModel();
$isFollowing = session()->get('isLoggedIn') ? $followersModel->isFollowing(session()->get('id'), $user['id']) : false;
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <img src="<?= base_url($user['avatar'] ?: 'assets/img/default-avatar.png') ?>" class="rounded-circle border" width="120" height="120">
                    <h2 class="mt-3"><?= esc($user['username']) ?></h2>
                    <p class="text-muted"><?= esc($user['bio'] ?: 'No bio yet.') ?></p>

                    <div class="row mt-4">
                        <div class="col-md-4">
                            <h5 class="mb-1"><?= esc($user['trivia_played']) ?></h5>
                            <p class="text-muted">Games Played</p>
                        </div>
                        <div class="col-md-4">
                            <h5 class="mb-1"><?= esc($followers) ?></h5>
                            <p class="text-muted">Followers</p>
                        </div>
                        <div class="col-md-4">
                            <h5 class="mb-1"><?= esc($following) ?></h5>
                            <p class="text-muted">Following</p>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-4">
                            <h5 class="mb-1"><?= esc($user['total_points']) ?></h5>
                            <p class="text-muted">Total Points</p>
                        </div>
                        <div class="col-md-4">
                            <h5 class="mb-1"><?= esc($accuracy) ?>%</h5>
                            <p class="text-muted">Answer Accuracy</p>
                        </div>
                        <div class="col-md-4">
                            <h5 class="mb-1">#<?= rand(1, 1000) ?></h5>
                            <p class="text-muted">Leaderboard Rank</p>
                        </div>
                    </div>

                    <?php if (session()->get('isLoggedIn') && session()->get('id') !== $user['id']): ?>
                        <?php if ($isFollowing): ?>
                            <a href="<?= base_url('unfollow/' . $user['username']) ?>" class="btn btn-danger mt-3">Unfollow</a>
                        <?php else: ?>
                            <a href="<?= base_url('follow/' . $user['username']) ?>" class="btn btn-success mt-3">Follow</a>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if (session()->get('id') == $user['id']): ?>
                        <a href="<?= base_url('settings') ?>" class="btn btn-primary mt-3">Edit Profile</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
