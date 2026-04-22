document.addEventListener("DOMContentLoaded", function () {
    const cards = document.querySelectorAll(".operation-card");

    cards.forEach(function (card) {
        card.addEventListener("mousemove", function (event) {
            const rect = card.getBoundingClientRect();
            const x = event.clientX - rect.left;
            const y = event.clientY - rect.top;
            card.style.background = "radial-gradient(circle at " + x + "px " + y + "px, rgba(125, 211, 252, 0.28), rgba(255, 255, 255, 0.95) 56%)";
        });

        card.addEventListener("mouseleave", function () {
            card.style.background = "#ffffff";
        });
    });
});
