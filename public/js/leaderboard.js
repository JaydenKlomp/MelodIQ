document.addEventListener("DOMContentLoaded", () => {
    // 🎉 Animate leaderboard entry
    anime({
        targets: ".leaderboard-container",
        opacity: [0, 1],
        translateY: [-50, 0],
        duration: 800,
        easing: "easeOutQuad"
    });

    // 🏆 Animate table rows one by one
    anime({
        targets: ".leaderboard-row",
        opacity: [0, 1],
        translateY: [20, 0],
        duration: 500,
        delay: anime.stagger(100), // Delays each row appearing
        easing: "easeOutQuad"
    });

    // 🌟 Animate ranking numbers
    anime({
        targets: ".rank-number",
        scale: [0.8, 1],
        duration: 500,
        easing: "easeOutBack",
        delay: anime.stagger(100)
    });

    // 🎭 Hover effect for rows
    document.querySelectorAll(".leaderboard-row").forEach(row => {
        row.addEventListener("mouseenter", () => {
            anime({
                targets: row,
                scale: 1.03,
                duration: 300,
                easing: "easeOutQuad"
            });
        });
        row.addEventListener("mouseleave", () => {
            anime({
                targets: row,
                scale: 1,
                duration: 300,
                easing: "easeOutQuad"
            });
        });
    });
});

