<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h2 class="text-center fw-bold"><?= esc($trivia['title']) ?></h2>
    <p class="text-muted text-center"><?= esc($trivia['description']) ?></p>

    <form id="trivia-form" action="<?= base_url('trivia/submit/' . $trivia['id']) ?>" method="POST">
        <input type="hidden" name="time_spent" id="time_spent" value="0">

        <?php foreach ($questions as $index => $q): ?>
            <div class="card mt-3 p-3">
                <h5><?= $index + 1 ?>. <?= esc($q['question_text']) ?></h5>

                <?php if (!empty($q['video_url'])): ?>
                    <div class="mt-2">
                        <video width="100%" controls>
                            <source src="<?= esc($q['video_url']) ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                <?php endif; ?>

                <?php if (!empty($q['audio_url'])): ?>
                    <div class="mt-2">
                        <audio controls>
                            <source src="<?= esc($q['audio_url']) ?>" type="audio/mpeg">
                            Your browser does not support the audio tag.
                        </audio>
                    </div>
                <?php endif; ?>

                <?php foreach ($q['answers'] as $a): ?>
                    <div class="form-check">
                        <input type="radio" name="answers[<?= $q['id'] ?>]" value="<?= $a['id'] ?>" class="form-check-input" required>
                        <label class="form-check-label"><?= esc($a['answer_text']) ?></label>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

        <button type="submit" class="btn btn-warning w-100 mt-4">Submit Answers</button>
    </form>
</div>

<script>
    let startTime = Date.now();

    document.getElementById("trivia-form").addEventListener("submit", function() {
        let endTime = Date.now();
        document.getElementById("time_spent").value = Math.floor((endTime - startTime) / 1000);
    });
</script>

<?= $this->endSection() ?>
