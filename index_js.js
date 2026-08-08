document.addEventListener("DOMContentLoaded", function () {
    const contactModal = document.getElementById("contactModal");
    const successModal = document.getElementById("successModal");

    const openBtn = document.getElementById("openModalBtn");
    const closeContactBtn = document.getElementById("closeModalBtn");
    const closeSuccessBtn = document.getElementById("closeSuccessBtn");

    const contactForm = document.getElementById("contactForm");

    // Åbn kontakt-modal
    if (openBtn && contactModal) {
        openBtn.onclick = function () {
            contactModal.style.setProperty("display", "flex", "important");
        };
    }

    // Luk kontakt-modal
    if (closeContactBtn && contactModal) {
        closeContactBtn.onclick = function () {
            contactModal.style.setProperty("display", "none", "important");
        };
    }

    // Håndter formularafsendelse (Sendes til PHP via fetch)
    if (contactForm) {
        contactForm.addEventListener("submit", function (e) {
            e.preventDefault(); // Stopper side-genindlæsning

            // Samler alle felterne fra formularen (Navn, Email, Emne, Besked)
            const formData = new FormData(contactForm);

            // Sender dataen ned til PHP-filen i baggrunden
            fetch(contactForm.action || window.location.href, {
                method: "POST",
                body: formData
            })
                .then(response => {
                    if (response.ok) {
                        // 🌟 FØRST NÅR PHP HAR MODTAGET DATAEN, SKIFTES DER MODAL
                        if (contactModal) {
                            contactModal.style.setProperty("display", "none", "important");
                        }

                        if (successModal) {
                            successModal.style.setProperty("display", "flex", "important");
                        }

                        contactForm.reset();
                    } else {
                        alert("Der opstod en fejl på serveren. Prøv igen.");
                    }
                })
                .catch(error => {
                    console.error("Fejl ved afsendelse:", error);
                    alert("Kunne ikke forbinde til serveren.");
                });
        });
    }

    // Luk succes-modal på LUK-knappen
    if (closeSuccessBtn && successModal) {
        closeSuccessBtn.onclick = function () {
            successModal.style.setProperty("display", "none", "important");
        };
    }

    // Luk modal ved klik udenfor kortet
    window.onclick = function (e) {
        if (e.target === contactModal) {
            contactModal.style.setProperty("display", "none", "important");
        }
        if (e.target === successModal) {
            successModal.style.setProperty("display", "none", "important");
        }
    };
});

// --- BOBLER MED KORREKT ZONESTYRING & KOLLISION ---
document.addEventListener("DOMContentLoaded", function () {
    const canvas = document.getElementById("bubbleCanvas");
    if (!canvas) return;

    const ctx = canvas.getContext("2d");

    function resizeCanvas() {
        canvas.width = canvas.parentElement.clientWidth;
        canvas.height = canvas.parentElement.clientHeight;
    }
    resizeCanvas();
    window.addEventListener("resize", resizeCanvas);

    const colorGreen = "rgba(177, 249, 172, 0.45)";  // Grøn farve fra Figma
    const colorPurple = "rgba(243, 203, 233, 0.50)"; // Lilla/Rosa farve fra Figma

    class Bubble {
        constructor(x, y, radius, color, isLeftZone) {
            this.x = x;
            this.y = y;
            this.radius = radius;
            this.color = color;
            this.isLeftZone = isLeftZone; // true = Venstre side (Lilla felt), false = Højre side (Grønt felt)

            // Rolig start-hastighed
            this.vx = (Math.random() - 0.5) * 0.3;
            this.vy = (Math.random() - 0.5) * 0.3;
        }

        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
            ctx.fillStyle = this.color;
            ctx.fill();
            ctx.closePath();
        }

        update(bubbles) {
            this.x += this.vx;
            this.y += this.vy;

            // 1. KANTER: Bounce på top og bund
            if (this.y - this.radius < 0 || this.y + this.radius > canvas.height) {
                this.vy *= -1;
            }

            // 2. KORREKT ZONESTYRING MED HARD BOUNDARY BOUNCE
            const midX = canvas.width / 2;

            if (this.isLeftZone) {
                // Bobler i venstre side (Må IKKE overskride midten til højre)
                if (this.x - this.radius < 0) {
                    this.x = this.radius;
                    this.vx *= -1;
                }
                if (this.x + this.radius > midX) {
                    this.x = midX - this.radius;
                    this.vx *= -1;
                }
            } else {
                // Bobler i højre side (Må IKKE overskride midten til venstre)
                if (this.x - this.radius < midX) {
                    this.x = midX + this.radius;
                    this.vx *= -1;
                }
                if (this.x + this.radius > canvas.width) {
                    this.x = canvas.width - this.radius;
                    this.vx *= -1;
                }
            }

            // 3. BLØD KOLLISION (Mellem bobler i samme zone)
            for (let other of bubbles) {
                if (other === this) continue;

                let dx = other.x - this.x;
                let dy = other.y - this.y;
                let distance = Math.sqrt(dx * dx + dy * dy);
                let minDistance = this.radius + other.radius;

                if (distance < minDistance) {
                    let angle = Math.atan2(dy, dx);
                    let targetX = this.x + Math.cos(angle) * minDistance;
                    let targetY = this.y + Math.sin(angle) * minDistance;

                    let ax = (targetX - other.x) * 0.01;
                    let ay = (targetY - other.y) * 0.01;

                    this.vx -= ax;
                    this.vy -= ay;
                    other.vx += ax;
                    other.vy += ay;
                }
            }

            // Begræns max hastighed
            const maxSpeed = 0.5;
            let currentSpeed = Math.sqrt(this.vx * this.vx + this.vy * this.vy);
            if (currentSpeed > maxSpeed) {
                this.vx = (this.vx / currentSpeed) * maxSpeed;
                this.vy = (this.vy / currentSpeed) * maxSpeed;
            }

            this.draw();
        }
    }

    const bubbles = [];

    // GRØNNE BOBLER -> LIGGER PÅ DET LILLA FELT (VENSTRE SIDE)
    const greenSizes = [45, 60, 80, 50, 110];
    greenSizes.forEach(size => {
        let x = Math.random() * (canvas.width / 2 - size * 2) + size;
        let y = Math.random() * (canvas.height - size * 2) + size;
        bubbles.push(new Bubble(x, y, size, colorGreen, true));
    });

    // LILLA BOBLER -> LIGGER PÅ DET GRØNNE FELT (HØJRE SIDE)
    const purpleSizes = [50, 70, 90, 55, 120];
    purpleSizes.forEach(size => {
        let x = Math.random() * (canvas.width / 2 - size * 2) + canvas.width / 2 + size;
        let y = Math.random() * (canvas.height - size * 2) + size;
        bubbles.push(new Bubble(x, y, size, colorPurple, false));
    });

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        bubbles.forEach(bubble => bubble.update(bubbles));
        requestAnimationFrame(animate);
    }

    animate();
});

function toggleAbout() {
    const moreText = document.getElementById("moreText");
    const btnText = document.getElementById("btnText");
    const toggleBtn = document.getElementById("toggleBtn");

    moreText.classList.toggle("show");
    toggleBtn.classList.toggle("open");

    if (moreText.classList.contains("show")) {
        btnText.textContent = "Se mindre";
    } else {
        btnText.textContent = "Se mere";
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const slider = document.querySelector('.projects-slider');
    const dots = document.querySelectorAll('.slider-dots .dot');

    if (!slider || dots.length === 0) return;

    slider.addEventListener('scroll', () => {
        const scrollPosition = slider.scrollLeft;
        const maxScroll = slider.scrollWidth - slider.clientWidth;
        const cardWidth = slider.querySelector('.project-card').offsetWidth;
        const gap = 24;

        let activeIndex;

        // Hvis brugeren har scrollet helt til højre, aktiver den sidste dot uanset hvad
        if (Math.ceil(scrollPosition) >= maxScroll - 10) {
            activeIndex = dots.length - 1;
        } else {
            activeIndex = Math.round(scrollPosition / (cardWidth + gap));
        }

        // Opdater .active klassen
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === activeIndex);
        });
    });
});