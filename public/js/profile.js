document.addEventListener("DOMContentLoaded", () => {
    // 🎭 Animate Profile Header
    anime({
        targets: ".profile-avatar",
        scale: [0.8, 1],
        opacity: [0, 1],
        duration: 800,
        easing: "easeOutQuad"
    });

    anime({
        targets: ".profile-header h2",
        opacity: [0, 1],
        translateY: [-20, 0],
        duration: 800,
        easing: "easeOutQuad",
        delay: 200
    });

    anime({
        targets: ".profile-bio",
        opacity: [0, 1],
        translateY: [-10, 0],
        duration: 800,
        easing: "easeOutQuad",
        delay: 400
    });

    // 📊 Animate Profile Stats
    anime({
        targets: ".stat-number",
        innerHTML: function (el) {
            return [0, parseInt(el.innerHTML)];
        },
        easing: "easeOutExpo",
        round: 1,
        duration: 2000
    });

    // ✨ Button Hover Effects
    document.querySelectorAll(".btn-action").forEach(button => {
        button.addEventListener("mouseenter", () => {
            anime({
                targets: button,
                scale: 1.1,
                duration: 300,
                easing: "easeOutQuad"
            });
        });
        button.addEventListener("mouseleave", () => {
            anime({
                targets: button,
                scale: 1,
                duration: 300,
                easing: "easeOutQuad"
            });
        });
    });

    // 🔥 Profile Avatar Hover Animation
    document.querySelector(".profile-avatar").addEventListener("mouseenter", () => {
        anime({
            targets: ".profile-avatar",
            scale: 1.15,
            duration: 300,
            easing: "easeOutQuad"
        });
    });

    document.querySelector(".profile-avatar").addEventListener("mouseleave", () => {
        anime({
            targets: ".profile-avatar",
            scale: 1,
            duration: 300,
            easing: "easeOutQuad"
        });
    });
});
