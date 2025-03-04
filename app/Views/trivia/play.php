<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>
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

<script>
    let startTime = Date.now();
    let questions = <?= json_encode($questions) ?>;
    let currentIndex = 0;
    let userAnswers = {}; // Store all user answers

    function loadQuestion(index) {
        if (index >= questions.length) {
            document.getElementById('next-question').classList.add('d-none');
            document.getElementById('submit-trivia').classList.remove('d-none');
            return;
        }

        let question = questions[index];
        let answersHtml = '';

        question.answers.sort(() => Math.random() - 0.5); // Shuffle answers

        question.answers.forEach(answer => {
            let isChecked = userAnswers[question.id] === answer.id ? 'checked' : '';
            answersHtml += `
                <div class="form-check">
                    <input type="radio" name="question_${question.id}" value="${answer.id}" class="form-check-input" ${isChecked} required>
                    <label class="form-check-label">${answer.answer_text}</label>
                </div>
            `;
        });

        document.getElementById('question-container').innerHTML = `
            <div class="card mt-3 p-3">
                <h5>${index + 1}. ${question.question_text}</h5>
                ${question.video_url ? `<video width="100%" controls><source src="${question.video_url}" type="video/mp4"></video>` : ''}
                ${question.audio_url ? `<audio controls><source src="${question.audio_url}" type="audio/mpeg"></audio>` : ''}
                ${answersHtml}
            </div>
        `;
    }

    document.getElementById('next-question').addEventListener('click', function () {
        let selectedAnswer = document.querySelector(`input[name="question_${questions[currentIndex].id}"]:checked`);
        if (!selectedAnswer) {
            alert("Please select an answer before proceeding.");
            return;
        }

        // Store selected answer
        userAnswers[questions[currentIndex].id] = selectedAnswer.value;

        // Move to next question
        currentIndex++;
        loadQuestion(currentIndex);
    });

    document.getElementById("trivia-form").addEventListener("submit", function () {
        let endTime = Date.now();
        document.getElementById("time_spent").value = Math.floor((endTime - startTime) / 1000);

        // Append all answers to form before submitting
        for (let questionId in userAnswers) {
            let input = document.createElement("input");
            input.type = "hidden";
            input.name = `answers[${questionId}]`;
            input.value = userAnswers[questionId];
            this.appendChild(input);
        }
    });

    document.addEventListener('DOMContentLoaded', () => loadQuestion(currentIndex));
</script>

<?= $this->endSection() ?>
