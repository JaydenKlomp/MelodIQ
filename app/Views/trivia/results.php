<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>
<div class="container mt-5 text-center">
    <h2 class="fw-bold">Trivia Completed!</h2>
    <p class="lead">Your score for <strong><?= esc($trivia['title']) ?></strong></p>
    <h3 class="text-success"><?= esc($score) ?> Points</h3>
    <p>Correct Answers: <strong><?= esc($correctCount) ?></strong></p>
    <p>Time Taken: <strong><?= esc($timeTaken) ?> seconds</strong></p>

    <h4 class="mt-4">📋 Question Overview</h4>
    <div class="mt-3">
        <?php foreach ($questions as $q): ?>
            <div class="card mt-3 p-3 <?= ($q['user_answer_id'] == $q['correct_answer_id']) ? 'border-success' : 'border-danger' ?>">
                <h5><?= esc($q['question_text']) ?></h5>

                <?php if (!empty($q['video_url'])): ?>
                    <video width="100%" controls>
                        <source src="<?= esc($q['video_url']) ?>" type="video/mp4">
                    </video>
                <?php endif; ?>

                <?php if (!empty($q['audio_url'])): ?>
                    <audio controls>
                        <source src="<?= esc($q['audio_url']) ?>" type="audio/mpeg">
                    </audio>
                <?php endif; ?>

                <p class="mt-2">
                    <strong>Your Answer:</strong>
                    <span class="<?= ($q['user_answer_id'] == $q['correct_answer_id']) ? 'text-success' : 'text-danger' ?>">
                        <?= esc($q['user_answer_text'] ?? 'No Answer') ?>
                    </span>
                </p>

                <?php if ($q['user_answer_id'] != $q['correct_answer_id']): ?>
                    <p class="text-success"><strong>✅ Correct Answer:</strong> <?= esc($q['correct_answer_text']) ?></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <a href="<?= base_url('trivias') ?>" class="btn btn-primary mt-4">🔙 Back to Trivias</a>
</div>
<?= $this->endSection() ?>
