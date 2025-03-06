document.addEventListener("DOMContentLoaded", () => {
    // 🎲 Animate Trivia Cards
    anime({
        targets: ".trivia-card",
        opacity: [0, 1],
        translateY: [50, 0],
        duration: 800,
        delay: anime.stagger(200),
        easing: "easeOutQuad"
    });

    // ✅ Pulse effect for completed trivia
    anime({
        targets: ".completed",
        boxShadow: ["0px 0px 10px rgba(0,255,0,0.4)", "0px 0px 20px rgba(0,255,0,0.7)"],
        duration: 800,
        easing: "easeInOutQuad",
        loop: true,
        direction: "alternate"
    });

    // 🔥 Hover Effects
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
});
