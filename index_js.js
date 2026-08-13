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
            fetch("send_mail.php", {
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

    const colorGreen = "rgba(177, 249, 172, 0.45)";  // Grøn farve
    const colorPurple = "rgba(241,170,223,0.47)"; // Lilla/Rosa farve

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
    const greenSizes = [25, 40, 60, 30, 70];
    greenSizes.forEach(size => {
        let x = Math.random() * (canvas.width / 2 - size * 2) + size;
        let y = Math.random() * (canvas.height - size * 2) + size;
        bubbles.push(new Bubble(x, y, size, colorGreen, true));
    });

    // LILLA BOBLER -> LIGGER PÅ DET GRØNNE FELT (HØJRE SIDE)
    const purpleSizes = [35, 50, 70, 30, 80];
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

// --- ISOLERET POP-UP KODE MED KORREKT BILLEDGALLERI ---
document.addEventListener("DOMContentLoaded", function () {

    const globalModal = document.getElementById("globalModal");
    const globalModalClose = document.getElementById("globalModalClose");

    const globalModalTitle = document.getElementById("globalModalTitle");
    const globalModalGallery = document.getElementById("globalModalGallery");
    const globalModalDesc = document.getElementById("globalModalDesc");

    const popupCards = document.querySelectorAll(".js-popup-card");


    /* =====================================================
       NORMAL PROJEKT-POPUP
       ===================================================== */

    if (popupCards.length > 0 && globalModal) {

        popupCards.forEach(card => {

            card.addEventListener("click", function () {

                const title = this.getAttribute("data-title");
                const desc = this.getAttribute("data-desc");
                const imagesJson = this.getAttribute("data-images");

                const normalizedTitle = (title || "").trim().toLowerCase();

                if (globalModalGallery) {

                    globalModalGallery.classList.remove(
                        "gallery-stacked",
                        "gallery-brochure"
                    );

                    if (
                        normalizedTitle === "bmc" ||
                        normalizedTitle === "user journey"
                    ) {
                        globalModalGallery.classList.add("gallery-stacked");
                    }

                    if (normalizedTitle === "re-design brochure") {
                        globalModalGallery.classList.add("gallery-brochure");
                    }
                }


                if (globalModalTitle) {
                    globalModalTitle.textContent = title || "";
                }


                if (globalModalDesc) {
                    globalModalDesc.textContent = desc || "";
                }


                /* Tøm og genopbyg galleriet */
                if (globalModalGallery) {

                    globalModalGallery.innerHTML = "";


                    try {

                        const images = JSON.parse(
                            imagesJson || "[]"
                        );


                        images.forEach(imgSrc => {

                            const imgElem =
                                document.createElement("img");

                            imgElem.src = imgSrc;

                            imgElem.alt = title || "";

                            globalModalGallery.appendChild(
                                imgElem
                            );

                        });


                    } catch (e) {

                        console.error(
                            "Fejl ved indlæsning af modal billeder:",
                            e
                        );

                    }
                }


                /* Åbn projekt-popup */
                globalModal.classList.add("active");
            });
        });


        /* Luk projekt-popup med X */
        if (globalModalClose) {

            globalModalClose.addEventListener(
                "click",
                function () {

                    globalModal.classList.remove(
                        "active"
                    );

                }
            );
        }


        /* Luk projekt-popup ved klik på overlay */
        window.addEventListener(
            "click",
            function (e) {

                if (e.target === globalModal) {

                    globalModal.classList.remove(
                        "active"
                    );

                }
            }
        );
    }

    /* =====================================================
       FORSTØR BILLEDE I POPUP
       KUN LG / DESKTOP 992px+
       ===================================================== */

    const imageLightbox =
        document.getElementById("imageLightbox");

    const imageLightboxImg =
        document.getElementById("imageLightboxImg");

    const imageLightboxClose =
        document.querySelector(
            ".image-lightbox-close"
        );


    /*
     * lytter på selve gallery-containeren.
     *
     * Det fungerer selvom billederne først
     * bliver oprettet dynamisk ovenfor.
     */
    if (
        globalModalGallery &&
        imageLightbox &&
        imageLightboxImg
    ) {

        globalModalGallery.addEventListener(
            "click",
            function (e) {

                /*
                 * Tjek om brugeren klikkede
                 * direkte på et billede.
                 */
                const clickedImage =
                    e.target.closest("img");


                if (!clickedImage) {
                    return;
                }


                /*
                 * KUN LG OG OP.
                 *
                 * Under 992px sker der ingenting,
                 * så mobil/tablet forbliver som nu.
                 */
                if (window.innerWidth < 992) {
                    return;
                }


                /*
                 * Brug præcis det billede,
                 * der blev klikket på.
                 */
                imageLightboxImg.src =
                    clickedImage.src;

                imageLightboxImg.alt =
                    clickedImage.alt || "";


                /* Åbn forstørret billede */
                imageLightbox.classList.add(
                    "active"
                );

            }
        );
    }

    /* =====================================================
       LUK FORSTØRRET BILLEDE MED X
       ===================================================== */

    if (
        imageLightboxClose &&
        imageLightbox &&
        imageLightboxImg
    ) {

        imageLightboxClose.addEventListener(
            "click",
            function (e) {

                /*
                 * Stop klik fra at fortsætte
                 * til elementerne bagved.
                 */
                e.stopPropagation();

                imageLightbox.classList.remove(
                    "active"
                );

                imageLightboxImg.src = "";

            }
        );
    }

    /* =====================================================
       LUK VED KLIK PÅ MØRK BAGGRUND
       ===================================================== */

    if (
        imageLightbox &&
        imageLightboxImg
    ) {
        imageLightbox.addEventListener(
            "click",
            function (e) {

                /*
                 * Luk kun hvis brugeren klikker
                 * på selve baggrunden.
                 *
                 * Klik på billedet lukker derfor
                 * ikke lightboxen.
                 */
                if (e.target === imageLightbox) {
                    imageLightbox.classList.remove(
                        "active"
                    );
                    imageLightboxImg.src = "";
                }
            }
        );
    }

    /* =====================================================
       LUK FORSTØRRET BILLEDE MED ESC
       ===================================================== */

    document.addEventListener(
        "keydown",
        function (e) {

            if (
                e.key === "Escape" &&
                imageLightbox &&
                imageLightbox.classList.contains(
                    "active"
                )
            ) {

                imageLightbox.classList.remove(
                    "active"
                );
                if (imageLightboxImg) {
                    imageLightboxImg.src = "";
                }
            }
        }
    );

});

function connectScrollIndicator(trackSelector, handleSelector) {
    const track = document.querySelector(trackSelector);
    const handle = document.querySelector(handleSelector);

    if (!track || !handle) return;

    const updateHandle = () => {
        const maxScroll = track.scrollWidth - track.clientWidth;

        if (maxScroll <= 0) {
            handle.style.left = "0%";
            return;
        }

        const scrollProgress = track.scrollLeft / maxScroll;

        const indicator = handle.parentElement;
        const indicatorWidth = indicator.clientWidth;
        const handleWidth = handle.offsetWidth;

        const maxHandleMove = indicatorWidth - handleWidth;

        handle.style.left = `${scrollProgress * maxHandleMove}px`;
    };

    track.addEventListener("scroll", updateHandle);

    window.addEventListener("resize", updateHandle);

    updateHandle();
}


/* Projekt-slider */
connectScrollIndicator(
    ".selected-project-slider",
    ".selected-project-scroll-handle"
);


/* Galleri-slider */
connectScrollIndicator(
    ".selected-mobile-gallery-track",
    ".selected-mobile-gallery-slider .slider-handle"
);