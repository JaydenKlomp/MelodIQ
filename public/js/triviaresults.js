document.addEventListener("DOMContentLoaded", () => {
    // 🎉 Confetti effect when the results page loads
    if (typeof confetti === "function") {
        confetti({
            particleCount: 150,
            spread: 80,
            origin: { y: 0.6 }
        });
    }

    // 🏆 Animate the score counter
    let scoreElement = document.getElementById("score-counter");
    let finalScore = parseInt(scoreElement.dataset.score);

    anime({
        targets: scoreElement,
        innerHTML: [0, finalScore], // Count from 0 to final score
        easing: "easeOutExpo",
        round: 1, // Ensures no decimal points
        duration: 2000
    });

    // 📜 Animate the questions appearing one by one
    anime({
        targets: ".question-card",
        opacity: [0, 1],
        translateY: [50, 0],
        duration: 800,
        delay: anime.stagger(200), // Stagger animations
        easing: "easeOutQuad"
    });

    // 🌟 Correct answers get a glowing effect
    anime({
        targets: ".border-success",
        boxShadow: ["0px 0px 0px rgba(0,255,0,0)", "0px 0px 15px rgba(0,255,0,0.7)"],
        duration: 1000,
        easing: "easeInOutQuad",
        loop: true,
        direction: "alternate"
    });

    anime({
        targets: ".border-danger",
        boxShadow: ["0px 0px 0px rgba(255, 76, 76, 0.0)", "0px 0px 15px rgba(255, 76, 76, 0.7)"],
        duration: 800,
        easing: "easeInOutQuad",
        loop: true,
        direction: "alternate"
    });


    // 🎭 Button hover effect
    let backButton = document.querySelector(".btn-primary");
    backButton.addEventListener("mouseenter", () => {
        anime({
            targets: backButton,
            scale: 1.1,
            duration: 300,
            easing: "easeOutQuad"
        });
    });
    backButton.addEventListener("mouseleave", () => {
        anime({
            targets: backButton,
            scale: 1,
            duration: 300,
            easing: "easeOutQuad"
        });
    });
});
