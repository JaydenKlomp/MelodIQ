<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="<?= base_url('css/play.css') ?>">
<div class="container mt-5">
    <h2 class="text-center fw-bold"><?= esc($trivia['title']) ?></h2>
    <p class="text-muted text-center"><?= esc($trivia['description']) ?></p>

    <form id="trivia-form" action="<?= base_url('trivia/submit/' . $trivia['id']) ?>" method="POST">
        <input type="hidden" name="time_spent" id="time_spent" value="0">

        <div id="question-container"></div>

        <button type="button" id="next-question" class="btn btn-warning w-100 mt-4">Next</button>
        <button type="submit" id="submit-trivia" class="btn btn-success w-100 mt-4 d-none">Submit Trivia</button>
    </form>
</div>

<!-- ✅ Use CDN only, remove the local reference -->
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

<script id="question-data" type="application/json"><?= json_encode($questions) ?></script>
<script src="<?= base_url('js/trivia.js') ?>"></script> <!-- Keep this for Trivia Logic -->

<?= $this->endSection() ?>
