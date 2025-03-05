<?php /** @var $completedTrivias */ ?>
<?php /** @var $category */ ?>
<?php /** @var $difficulty */ ?>
<?php /** @var $search */ ?>
<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h2 class="text-center fw-bold">🎵 Browse Trivia Games</h2>

    <!-- Show "Create Trivia" Button for Admins -->
    <?php if (session()->get('is_admin')): ?>
        <div class="text-end">
            <a href="<?= base_url('trivia/create') ?>" class="btn btn-warning">➕ Create Trivia</a>
        </div>
    <?php endif; ?>

    <!-- Search & Filters -->
    <form method="GET" action="<?= base_url('trivias') ?>" class="mt-4">
        <div class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search trivia..." value="<?= esc($search) ?>">
            </div>
            <div class="col-md-3">
                <select name="category" class="form-control">
                    <option value="">All Categories</option>
                    <option value="rock" <?= ($category == 'rock') ? 'selected' : '' ?>>Rock</option>
                    <option value="pop" <?= ($category == 'pop') ? 'selected' : '' ?>>Pop</option>
                    <option value="hiphop" <?= ($category == 'hiphop') ? 'selected' : '' ?>>Hip-Hop</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="difficulty" class="form-control">
                    <option value="">All Difficulties</option>
                    <option value="Easy" <?= ($difficulty == 'Easy') ? 'selected' : '' ?>>Easy</option>
                    <option value="Medium" <?= ($difficulty == 'Medium') ? 'selected' : '' ?>>Medium</option>
                    <option value="Hard" <?= ($difficulty == 'Hard') ? 'selected' : '' ?>>Hard</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-warning w-100">🔍 Search</button>
            </div>
        </div>
    </form>

    <!-- Trivia List -->
    <div class="row mt-4">
        <?php if (empty($trivias)): ?>
            <p class="text-center text-muted">No trivia games found.</p>
        <?php else: ?>
            <?php foreach ($trivias as $trivia): ?>
                <?php
                $hasCompleted = in_array($trivia['id'], $completedTrivias);
                ?>
                <div class="col-md-4">
                    <div class="card trivia-card <?= $hasCompleted ? 'bg-dark' : '' ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($trivia['title']) ?></h5>
                            <p class="card-text"><?= esc($trivia['description']) ?></p>
                            <span class="badge bg-primary"><?= esc($trivia['difficulty']) ?></span>

                            <div class="mt-3">
                                <?php if ($hasCompleted): ?>
                                    <button class="btn btn-sm btn-secondary" disabled>✅ Completed</button>
                                <?php else: ?>
                                    <a href="<?= base_url('trivia/play/' . $trivia['id']) ?>" class="btn btn-sm btn-warning">Play Now</a>
                                <?php endif; ?>

                                <?php if (session()->get('is_admin')): ?>
                                    <a href="<?= base_url('trivia/edit/' . $trivia['id']) ?>" class="btn btn-sm btn-outline-warning">✏️ Edit</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
