let lastScrollTop = 0;
        const header = document.getElementById("header");

        window.addEventListener("scroll", function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            if (scrollTop > lastScrollTop) {
                // Scroll para baixo, esconde o header
                header.classList.add("header-hidden");
            } else {
                // Scroll para cima, mostra o header
                header.classList.remove("header-hidden");
            }
            lastScrollTop = scrollTop;
        });