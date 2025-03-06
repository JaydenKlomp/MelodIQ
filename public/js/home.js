document.addEventListener("DOMContentLoaded", () => {
    // 🎵 Animate Hero Section
    anime({
        targets: ".hero h1",
        opacity: [0, 1],
        translateY: [-30, 0],
        duration: 800,
        easing: "easeOutQuad"
    });

    anime({
        targets: ".hero p",
        opacity: [0, 1],
        translateY: [-20, 0],
        delay: 200,
        duration: 800,
        easing: "easeOutQuad"
    });

    anime({
        targets: ".cta-btn",
        opacity: [0, 1],
        scale: [0.8, 1],
        delay: 400,
        duration: 800,
        easing: "easeOutBounce"
    });

    // 🔢 Animate User Stats (if logged in)
    let statNumbers = document.querySelectorAll(".stats h4");
    statNumbers.forEach(stat => {
        let finalValue = parseInt(stat.textContent);
        stat.textContent = "0";
        anime({
            targets: stat,
            innerHTML: [0, finalValue],
            easing: "easeOutExpo",
            round: 1,
            duration: 2000
        });
    });

    // 📜 Animate Trivia Category Cards
    anime({
        targets: ".trivia-card",
        opacity: [0, 1],
        translateY: [50, 0],
        duration: 800,
        delay: anime.stagger(200),
        easing: "easeOutQuad"
    });

    // 🏆 Animate Leaderboard Rows
    anime({
        targets: ".leaderboard-table tbody tr",
        opacity: [0, 1],
        translateY: [20, 0],
        duration: 500,
        delay: anime.stagger(100),
        easing: "easeOutQuad"
    });

    // 🌟 Hover Effect for Trivia Cards
    document.querySelectorAll(".trivia-card").forEach(card => {
        card.addEventListener("mouseenter", () => {
            anime({
                targets: card,
                scale: 1.05,
                duration: 300,
                easing: "easeOutQuad"
            });
        });
        card.addEventListener("mouseleave", () => {
            anime({
                targets: card,
                scale: 1,
                duration: 300,
                easing: "easeOutQuad"
            });
        });
    });

    // 🏅 Highlight Top 3 Players
    anime({
        targets: ".gold, .silver, .bronze",
        scale: [1, 1.1],
        duration: 600,
        easing: "easeInOutQuad",
        direction: "alternate",
        loop: true
    });
});
