<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h2 class="text-center fw-bold">Create New Trivia</h2>

    <form id="trivia-form" action="<?= base_url('trivia/save') ?>" method="POST" class="mt-4" enctype="multipart/form-data">
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
        <div id="questions-container"></div>
        <button type="button" class="btn btn-primary mt-3" id="add-question">➕ Add Question</button>

        <button type="submit" class="btn btn-warning w-100 mt-4">Create Trivia</button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let questionCount = 0;

        function addQuestion() {
            questionCount++;

            let questionHTML = `
        <div class="card mt-3 p-3 question-card" data-question="${questionCount}">
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
                ${generateAnswerHTML(questionCount, 1)}
                ${generateAnswerHTML(questionCount, 2)}
            </div>
            <button type="button" class="btn btn-sm btn-success add-answer">➕ Add Answer</button>
            <button type="button" class="btn btn-sm btn-danger remove-question">🗑 Remove Question</button>

            <!-- Hidden field to store the correct answer ID -->
            <input type="hidden" name="questions[${questionCount}][correct]" class="correct-answer-hidden">
        </div>`;

            document.getElementById("questions-container").insertAdjacentHTML("beforeend", questionHTML);
        }

        function generateAnswerHTML(questionIndex, answerId) {
            return `
        <div class="answer-group mb-2">
            <div class="input-group">
                <input type="text" name="questions[${questionIndex}][answers][${answerId}][text]" class="form-control" placeholder="Answer ${answerId}" required>
                <div class="input-group-text">
                    <input type="radio" name="questions[${questionIndex}][correct]" value="${answerId}" required> Correct?
                </div>
                <button type="button" class="btn btn-danger btn-sm remove-answer">❌</button>
            </div>
        </div>`;
        }

        document.getElementById("add-question").addEventListener("click", addQuestion);

        document.addEventListener("click", function (e) {
            if (e.target.classList.contains("add-answer")) {
                let questionCard = e.target.closest(".question-card");
                let questionIndex = questionCard.dataset.question;
                let answerCount = questionCard.querySelectorAll(".answer-group").length + 1;

                let newAnswer = generateAnswerHTML(questionIndex, answerCount);
                questionCard.querySelector(".answers-container").insertAdjacentHTML("beforeend", newAnswer);
            }

            if (e.target.classList.contains("remove-answer")) {
                let answerGroup = e.target.closest(".answer-group");
                if (answerGroup) answerGroup.remove();
            }

            if (e.target.classList.contains("remove-question")) {
                e.target.closest(".question-card").remove();
            }
        });

        document.getElementById("trivia-form").addEventListener("submit", function (e) {
            let questions = document.querySelectorAll(".question-card");
            for (let question of questions) {
                let correctAnswer = question.querySelector('input[type="radio"]:checked');

                if (!correctAnswer) {
                    alert("Each question must have at least one correct answer.");
                    e.preventDefault();
                    return;
                }
            }
        });
    });
</script>


<?= $this->endSection() ?>
