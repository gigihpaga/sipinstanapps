(function () {
    function hitungTinggiElement() {
        const divElement = document.querySelector('#newsletter');
        const elemHeight = divElement.offsetHeight;
        console.log({ 'ini tinggi newlater': elemHeight });

        let header_tinggi = document.querySelector('header').offsetHeight,
            top_tinggi = document.querySelector('#top').offsetHeight,
            services_tinggi = document.querySelector('#services').offsetHeight,
            about_tinggi = document.querySelector('#about').offsetHeight,
            clients_tinggi = document.querySelector('#clients').offsetHeight,
            newsletter_tinggi = document.querySelector('#newsletter').offsetHeight;

        const total = {
            header_tinggi,
            top_tinggi,
            services_tinggi,
            about_tinggi,
            clients_tinggi,
            newsletter_tinggi,
        };
        console.table(total);
    }

    // [Loader] event when document html fully downloaded and parsed
    window.addEventListener(
        'load',
        function (event) {
            this.document.getElementById('js-preloader')?.classList.add('loaded');
        },
        {
            once: true,
        }
    );

    document.addEventListener('DOMContentLoaded', function () {
        // ==== SELECTOR ====
        const elmSections = [
            document.querySelector('#top'),
            document.querySelector('#services'),
            document.querySelector('#about'),
            document.querySelector('#pricing'),
            document.querySelector('#clients'),
            document.querySelector('#newsletter'),
        ];
        const elmNav = document.querySelectorAll('ul.nav li.scroll-to-section a');
        const elmHeader = document.querySelector('header.header-area.header-sticky');

        // create element div, for helper tracking header will display fixed || block
        const scrollWatcher = document.createElement('div');
        scrollWatcher.setAttribute('data-scroll-watcher', '');
        elmHeader.after(scrollWatcher);

        // set active header navbar menu relate with element section === viewport
        function setActiveNav(id) {
            elmNav.forEach((elm) => {
                elm.classList.remove('active');
                if (elm.getAttribute('href').replace('#', '') == id) {
                    elm.classList.add('active');
                }
            });
        }

        /** event listener on scroll */
        // document.onscroll = (e) => {
        //     let positionScrollDoc = e.target.documentElement.scrollTop;
        //     let positionScrollWindow = window.pageYOffset;
        //     const heightElm = document.querySelector('header').offsetHeight;
        // };

        // initial Intersection Observer for header
        const observerHeader = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    const elemHeight = entry.target.offsetHeight;
                    let scrollPositionX = document.documentElement.scrollTop;
                    if (entry.isIntersecting == false) {
                        elmHeader.classList.add('background-header');
                    } else {
                        elmHeader.classList.remove('background-header');
                    }
                });
            },
            { threshold: 1, rootMargin: '200px' }
        );

        // initial Intersection Observer for scroll section
        const observerScroll = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    let elmAnimated = entry.target.querySelectorAll('.animate__animated');
                    if (entry.isIntersecting && entry.intersectionRatio >= 0.45) {
                        setActiveNav(entry.target.getAttribute('id'));
                        elmAnimated.forEach((elm) => {
                            let typeAnimasi = elm.getAttribute('data-animation');
                            let hasilTogel = elm.classList.toggle(typeAnimasi);
                        });
                    } else {
                        elmAnimated.forEach((elm) => {
                            let typeAnimasi = elm.getAttribute('data-animation');
                            elm.classList.remove(typeAnimasi);
                        });
                    }
                });
                //
            },
            {
                threshold: 0.45,
                // rootMargin: '0px',
            }
        );

        // assign element scrollWatcher to intersection observer
        observerHeader.observe(scrollWatcher);

        // assign element elmSections to intersection observer
        // observer.observe(service);
        elmSections.forEach((element) => {
            observerScroll.observe(element);
        });

        // toggle menu burger show || hide
        document.querySelector('.menu-trigger').addEventListener('click', function (e) {
            let stateTogle = this.classList.toggle('active');
            let nav = document.querySelector('.header-area .nav');
            if (stateTogle) {
                nav.style.display = 'block';
            } else {
                nav.style.display = 'none';
            }
        });

        // modalLogin
        const myModalLogin = new bootstrap.Modal('#modal__login', {});
        myModalLogin._element.addEventListener('shown.bs.modal', function (e) {
            // set focus input email when modal open
            e.target.querySelector('input[name="email"]').focus();
        });

        // variable globalErrorLaravel is define in file frontend-index.blade.php
        if (globalErrorLaravel.length > 0) {
            myModalLogin.show();
            document.querySelector('input[name="email"]').classList.add('is-invalid');
            // element flash message
            let msg = document.querySelector('#failed-message-email');
            // assign data-delay to varible css using file.css to object
            document.documentElement.style.setProperty(
                '--delay-failed-message-email',
                msg.getAttribute('data-delay')
            );
            // assign data-delay to varible css using inline style on html
            // msg.style = `--delay-failed-message-email: ${msg.getAttribute('data-delay')};`;

            // add class animation
            msg.classList.add(msg.getAttribute('data-animation'));
        }
        // myModalLogin.show();
        // ==================== DOMContentLoaded end ====================
    });
    // ================================= Anonymous block end =================================
})();
