<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>
<div class="container mt-5 text-center">
    <h2 class="fw-bold">Trivia Completed!</h2>
    <p class="lead">Your score for <strong><?= esc($trivia['title']) ?></strong></p>
    <h3 class="text-success"><?= esc($score) ?> Points</h3>
    <p>Correct Answers: <strong><?= esc($correctCount) ?></strong></p>

    <a href="<?= base_url('trivias') ?>" class="btn btn-primary mt-3">🔙 Back to Trivias</a>
</div>
<?= $this->endSection() ?>
