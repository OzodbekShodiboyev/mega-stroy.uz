    // Sliderni sozlash
    var swiper = new Swiper(".mySwiper", {
        loop: true,
        autoplay: { delay: 5000 },
        navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
        pagination: { el: ".swiper-pagination", clickable: true },
    });

    // Counter (Raqamlar hisoblagichi)
    const counters = document.querySelectorAll('.count');
    const speed = 200;

    const runCounters = () => {
        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const inc = target / speed;

                if (count < target) {
                    counter.innerText = Math.ceil(count + inc);
                    setTimeout(updateCount, 15);
                } else {
                    counter.innerText = target;
                }
            };
            updateCount();
        });
    };

    // Scroll bo'lganda counter ishga tushishi
    let started = false;
    window.onscroll = function() {
        const section = document.querySelector('.counters');
        const pos = section.getBoundingClientRect().top;
        if (pos < window.innerHeight && !started) {
            runCounters();
            started = true;
        }
    };
