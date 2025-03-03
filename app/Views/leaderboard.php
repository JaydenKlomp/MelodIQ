<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h2 class="text-center fw-bold">🏆 Leaderboard</h2>

    <!-- Sorting Options -->
    <div class="text-center mt-3">
        <label for="sort" class="fw-bold">Sort By:</label>
        <select id="sort" class="form-select d-inline w-auto" onchange="sortLeaderboard()">
            <option value="total_points" <?= $sort == 'total_points' ? 'selected' : '' ?>>🏆 Total Points</option>
            <option value="correct_answers" <?= $sort == 'correct_answers' ? 'selected' : '' ?>>🎯 Accuracy</option>
            <option value="time_spent" <?= $sort == 'time_spent' ? 'selected' : '' ?>>⏳ Time Spent</option>
            <option value="trivia_played" <?= $sort == 'trivia_played' ? 'selected' : '' ?>>🎮 Games Played</option>
        </select>
    </div>

    <!-- Leaderboard Table -->
    <table class="table table-hover mt-4">
        <thead class="table-warning">
        <tr>
            <th>#</th>
            <th>Player</th>
            <th>🏆 Points</th>
            <th>🎯 Accuracy</th>
            <th>⏳ Time Spent</th>
            <th>🎮 Games Played</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $index => $user): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td>
                    <img src="<?= base_url($user['avatar'] ?: 'assets/img/default-avatar.png') ?>" class="rounded-circle" width="35" height="35">
                    <a href="<?= base_url('profile/' . $user['username']) ?>" class="fw-bold"><?= esc($user['username']) ?></a>
                </td>
                <td><?= esc($user['total_points']) ?></td>
                <td>
                    <?php
                    $totalAttempts = $user['correct_answers'] + ($user['incorrect_answers'] ?? 0);
                    $accuracy = ($totalAttempts > 0) ? round(($user['correct_answers'] / $totalAttempts) * 100, 2) : 0;
                    ?>
                    <?= $accuracy ?>%
                </td>

                <td><?= esc($user['time_spent']) ?> sec</td>
                <td><?= esc($user['trivia_played']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Sorting Script -->
<script>
    function sortLeaderboard() {
        var sortOption = document.getElementById("sort").value;
        window.location.href = "<?= base_url('leaderboard') ?>?sort=" + sortOption;
    }
</script>

<?= $this->endSection() ?>
