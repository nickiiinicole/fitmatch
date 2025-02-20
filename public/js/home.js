document.addEventListener("DOMContentLoaded", function () {
    const reviewsContainer = document.querySelector(".review-container");
    const cards = document.querySelectorAll(".card");
    const title = document.getElementById("titulo");
    const button = document.querySelector("#btnLogOut");
    let isPaused = false;

    // Verifica que reviewsContainer exista
    if (reviewsContainer) {
        function moveSlider() {
            if (!isPaused) {
                reviewsContainer.style.transform = `translateX(-250px)`;
                setTimeout(() => {
                    reviewsContainer.appendChild(reviewsContainer.firstElementChild);
                    reviewsContainer.style.transition = "none";
                    reviewsContainer.style.transform = "translateX(0)";
                    setTimeout(() => {
                        reviewsContainer.style.transition = "transform 0.5s ease-in-out";
                    });
                }, 500);
            }
        }

        setInterval(moveSlider, 3000);

        // Pausar animación al pasar el mouse
        reviewsContainer.addEventListener("mouseenter", () => (isPaused = true));
        reviewsContainer.addEventListener("mouseleave", () => (isPaused = false));
    }

    // Efecto en las cards (hover y click)
    if (cards.length > 0) {
        cards.forEach((card) => {
            card.addEventListener("mouseenter", () => {
                gsap.to(card, {
                    scale: 1.05,
                    rotation: 2,
                    duration: 0.3,
                    ease: "power2.out",
                });
            });

            card.addEventListener("mouseleave", () => {
                gsap.to(card, {
                    scale: 1,
                    rotation: 0,
                    duration: 0.3,
                    ease: "power2.out",
                });
            });

            // Animación de giro al hacer click
            card.addEventListener("click", () => {
                gsap.to(card, {
                    rotationY: "+=360",
                    duration: 0.8,
                    ease: "power2.inOut",
                });
            });
        });
    }

    // Cambio de color del título
    if (title) {
        const colors = ["#ff3cac", "#ff6ec7", "#7367F0", "#32aaff", "#2ce69b", "#ff9f43"];
        let colorIndex = 0;

        function changeColor() {
            title.style.color = colors[colorIndex];
            colorIndex = (colorIndex + 1) % colors.length;
        }

        setInterval(changeColor, 1500);
    }

    // Efecto en botón de logout
    if (button) {
        button.addEventListener("click", function () {
            this.classList.add("active");
            setTimeout(() => {
                this.classList.remove("active");
            }, 500);
        });
    }
});
document.addEventListener("DOMContentLoaded", function () {
    const words = ["PSYCHOLOGICAL FLEXIBILITY", "BELONGING", "RESILIENCE"];
    let index = 0;
    const textElement = document.getElementById("triangle-text");

    function changeWord() {
        textElement.style.opacity = "0"; // Desvanece el texto
        setTimeout(() => {
            textElement.textContent = words[index];
            textElement.style.opacity = "1"; // Aparece con nueva palabra
            index = (index + 1) % words.length;
        }, 500);
    }

    setInterval(changeWord, 3000); // Cambia cada 3 segundos
});
