document.addEventListener("DOMContentLoaded", () => {
    let currentIndex = 0;
    let userAnswers = {};
    let startTime = Date.now();
    let questions = JSON.parse(document.getElementById("question-data").textContent);

    function animateQuestionEntry() {
        anime({
            targets: "#question-container",
            opacity: [0, 1],
            translateX: [100, 0], // Move in from the right
            duration: 800,
            easing: "easeOutQuad"
        });
    }

    function animateAnswerSelection(target) {
        anime({
            targets: target,
            scale: [1, 1.1],
            duration: 200,
            easing: "easeInOutQuad",
            direction: "alternate"
        });
    }

    function loadQuestion(index) {
        if (index >= questions.length) {
            document.getElementById("next-question").classList.add("d-none");
            document.getElementById("submit-trivia").classList.remove("d-none");

            // 🎉 Confetti when the quiz is done
            confetti({
                particleCount: 150,
                spread: 80,
                origin: { y: 0.6 }
            });
            return;
        }

        let question = questions[index];
        let answersHtml = "";

        question.answers.sort(() => Math.random() - 0.5); // Shuffle answers

        question.answers.forEach(answer => {
            let isChecked = userAnswers[question.id] === answer.id ? "checked" : "";
            answersHtml += `
            <div class="form-check fade-in" onclick="animateAnswerSelection(this)">
                <input type="radio" name="question_${question.id}" value="${answer.id}" class="form-check-input" ${isChecked} required>
                <label class="form-check-label">${answer.answer_text}</label>
            </div>
        `;
        });

        let container = document.getElementById("question-container");

        // 🔹 Preserve space by keeping height
        container.style.minHeight = container.offsetHeight + "px";
        container.style.visibility = "hidden";  // Hide content without collapsing

        setTimeout(() => {
            container.innerHTML = ` 
            <div class="card mt-3 p-4 animated-question">
                <h5 class="question-text">${index + 1}. ${question.question_text}</h5>
                ${question.video_url ? `<video width="100%" controls><source src="${question.video_url}" type="video/mp4"></video>` : ""}
                ${question.audio_url ? `<audio controls><source src="${question.audio_url}" type="audio/mpeg"></audio>` : ""}
                ${answersHtml}
            </div>
        `;

            container.style.visibility = "visible"; // Make visible after replacing content

            anime({
                targets: "#question-container",
                opacity: [0, 1],
                translateX: [100, 0],
                duration: 500,
                easing: "easeOutQuad"
            });

            updateProgressBar();
        }, 50); // Small delay prevents flicker
    }


    document.getElementById("next-question").addEventListener("click", function () {
        let selectedAnswer = document.querySelector(`input[name="question_${questions[currentIndex].id}"]:checked`);
        if (!selectedAnswer) {
            alert("Please select an answer before proceeding.");
            return;
        }

        userAnswers[questions[currentIndex].id] = selectedAnswer.value;

        let container = document.getElementById("question-container");

        anime({
            targets: "#question-container",
            opacity: [1, 0],
            translateX: [0, -100], // Move left smoothly
            duration: 500,
            easing: "easeInQuad",
            complete: function () {
                currentIndex++;

                // Preserve height while changing content
                container.style.minHeight = container.offsetHeight + "px";
                loadQuestion(currentIndex);
            }
        });
    });


    document.getElementById("trivia-form").addEventListener("submit", function () {
        let endTime = Date.now();
        document.getElementById("time_spent").value = Math.floor((endTime - startTime) / 1000);

        for (let questionId in userAnswers) {
            let input = document.createElement("input");
            input.type = "hidden";
            input.name = `answers[${questionId}]`;
            input.value = userAnswers[questionId];
            this.appendChild(input);
        }
    });

    function updateProgressBar() {
        let progress = ((currentIndex + 1) / questions.length) * 100;
        document.getElementById("progress-bar").style.width = progress + "%";
    }

    loadQuestion(currentIndex);
});
