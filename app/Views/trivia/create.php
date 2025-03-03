<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h2 class="text-center fw-bold">Create New Trivia</h2>

    <form action="<?= base_url('trivia/save') ?>" method="POST" class="mt-4" enctype="multipart/form-data">
        <!-- Trivia Details -->
        <div class="mb-3">
            <label class="form-label">Trivia Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label class="form-label">Category</label>
                <select name="category" class="form-control">
                    <option value="General">General</option>
                    <option value="Rock">Rock</option>
                    <option value="Pop">Pop</option>
                    <option value="Hip-Hop">Hip-Hop</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Difficulty</label>
                <select name="difficulty" class="form-control">
                    <option value="Easy">Easy</option>
                    <option value="Medium">Medium</option>
                    <option value="Hard">Hard</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Time Limit (seconds)</label>
                <input type="number" name="time_limit" class="form-control" min="10" max="300">
            </div>
        </div>

        <div class="mb-3 mt-3">
            <label class="form-label">Make Trivia Public?</label>
            <select name="public" class="form-control">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>

        <!-- Questions Section -->
        <h3 class="mt-4">Questions</h3>
        <div id="questions-container">
            <!-- Dynamic questions will be inserted here -->
        </div>
        <button type="button" class="btn btn-primary mt-3" id="add-question">Add Question</button>

        <button type="submit" class="btn btn-warning w-100 mt-4">Create Trivia</button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let questionCount = 0;

        document.getElementById("add-question").addEventListener("click", function () {
            questionCount++;

            let questionHTML = `
            <div class="card mt-3 p-3">
                <h5>Question ${questionCount}</h5>
                <div class="mb-3">
                    <label class="form-label">Question Text</label>
                    <input type="text" name="questions[${questionCount}][text]" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Video URL (Optional)</label>
                    <input type="text" name="questions[${questionCount}][video]" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Audio URL (Optional)</label>
                    <input type="text" name="questions[${questionCount}][audio]" class="form-control">
                </div>

                <h6>Answers</h6>
                <div class="answers-container">
                    <div class="mb-2">
                        <input type="text" name="questions[${questionCount}][answers][0][text]" class="form-control" placeholder="Answer 1" required>
                        <input type="checkbox" name="questions[${questionCount}][answers][0][correct]"> Correct?
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-success add-answer">Add Answer</button>
                <button type="button" class="btn btn-sm btn-danger remove-question">Remove Question</button>
            </div>
        `;

            document.getElementById("questions-container").insertAdjacentHTML("beforeend", questionHTML);
        });

        document.addEventListener("click", function (e) {
            if (e.target.classList.contains("add-answer")) {
                let answerCount = e.target.previousElementSibling.childElementCount;
                let questionIndex = e.target.closest(".card").querySelector("h5").textContent.split(" ")[1];

                let answerHTML = `
                <div class="mb-2">
                    <input type="text" name="questions[${questionIndex}][answers][${answerCount}][text]" class="form-control" placeholder="Answer ${answerCount + 1}" required>
                    <input type="checkbox" name="questions[${questionIndex}][answers][${answerCount}][correct]"> Correct?
                </div>
            `;
                e.target.previousElementSibling.insertAdjacentHTML("beforeend", answerHTML);
            }

            if (e.target.classList.contains("remove-question")) {
                e.target.closest(".card").remove();
            }
        });
    });
</script>
<?= $this->endSection() ?>
