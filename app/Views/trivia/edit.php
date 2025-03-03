<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h2 class="text-center fw-bold">Edit Trivia: <?= esc($trivia['title']) ?></h2>

    <form action="<?= base_url('trivia/update/' . $trivia['id']) ?>" method="POST" class="mt-4" enctype="multipart/form-data">
        <!-- Trivia Details -->
        <div class="mb-3">
            <label class="form-label">Trivia Title</label>
            <input type="text" name="title" class="form-control" value="<?= esc($trivia['title']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" required><?= esc($trivia['description']) ?></textarea>
        </div>

        <h3 class="mt-4">Questions</h3>
        <div id="questions-container">
            <?php foreach ($questions as $index => $q): ?>
                <div class="card mt-3 p-3">
                    <h5>Question <?= $index + 1 ?></h5>
                    <div class="mb-3">
                        <label class="form-label">Question Text</label>
                        <input type="text" name="questions[<?= $q['id'] ?>][text]" class="form-control" value="<?= esc($q['question_text']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Video URL (Optional)</label>
                        <input type="text" name="questions[<?= $q['id'] ?>][video]" class="form-control" value="<?= esc($q['video_url']) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Audio URL (Optional)</label>
                        <input type="text" name="questions[<?= $q['id'] ?>][audio]" class="form-control" value="<?= esc($q['audio_url']) ?>">
                    </div>

                    <h6>Answers</h6>
                    <div class="answers-container">
                        <?php foreach ($q['answers'] as $a): ?>
                            <div class="mb-2">
                                <input type="text" name="questions[<?= $q['id'] ?>][answers][<?= $a['id'] ?>][text]" class="form-control" value="<?= esc($a['answer_text']) ?>" required>
                                <input type="checkbox" name="questions[<?= $q['id'] ?>][answers][<?= $a['id'] ?>][correct]" <?= $a['is_correct'] ? 'checked' : '' ?>> Correct?
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-success">Save Changes</button>

            <?php if (session()->get('is_admin')): ?>
                <a href="<?= base_url('trivia/delete/' . $trivia['id']) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this trivia? This action cannot be undone.');">Delete Trivia</a>
            <?php endif; ?>
        </div>
    </form>

</div>
<?= $this->endSection() ?>
