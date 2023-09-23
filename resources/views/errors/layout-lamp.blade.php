<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('arfa/assets/css/style-error-page-lamp.css') }}">

    <title>@yield('title') &mdash; {{ config('app.name', 'Laravel') }}</title>
</head>

<body class="dark-mode">
    <main>
        <!-- header -->
        <header class="top-header">
            <div class="top-header__wrapper">
                <div class="btn-switch">
                    <div class="btn-switch__icon-container">
                        <i class="btn-switch__icon-toggle-theme"></i>
                    </div>
                </div>
            </div>
        </header>
        <!-- header end -->

        <!--dust particel-->
        <div>
            <div class="starsec"></div>
            <div class="starthird"></div>
            <div class="starfourth"></div>
            <div class="starfifth"></div>
        </div>
        <!--Dust particle end--->

        <div class="lamp__wrap">
            <div class="lamp">
                <div class="cable"></div>
                <div class="cover"></div>
                <div class="in-cover">
                    <div class="bulb"></div>
                </div>
                <div class="light"></div>
            </div>
        </div>
        <!-- END Lamp -->

        <section class="error">
            <!-- Content -->
            <div class="error__content">
                <div class="error__message">
                    <h2 class="message__code">@yield('code')</h2>
                    <h1 class="message__title">@yield('message')</h1>

                    <p class="message__text">
                        We're sorry, the page you were looking for isn't found here. The link
                        you followed may either be broken or no longer exists. Please try again, or take a look at
                        our.
                    </p>

                </div>
                {{-- 
                <div class="error__nav e-nav">
                    <div style="display: flex; justify-content: center; align-items: center;">
                        <div class="btn-switch-pill">
                            <div class="btn-switch-pill__indicator">
                                <div class="btn-switch-pill__icon-container">
                                    <i class="btn-switch-pill__icon-toggle-theme"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                --}}
                <div class="error__nav e-nav">
                    <a href="/" class="e-nav__link"></a>
                </div>
            </div>
            <!-- END Content -->
        </section>
    </main>
</body>

<script>
    (function() {
        addEventListener("DOMContentLoaded", (event) => {
            const body = document.querySelector('body');
            const btnTogglePill = body.querySelector('.btn-switch-pill');
            const btnToggle = body.querySelector('.btn-switch');

            // to sace the dark mode use the objec "local storage"
            // function that stores the value true if the dark mode is activated or false if it's not
            function store(value) {
                let obj = {
                    darkMode: value
                }
                localStorage.setItem('themeSettingsErroPages', JSON.stringify(obj));
            }
            // funtion that indicates if the "darkMode" properti exist. it loads the page as we had left it
            (function load() {
                const themeSettings = localStorage.getItem('themeSettingsErroPages');
                let isDarkMode = themeSettings ? JSON.parse(themeSettings)?.darkMode : false;
                // force mode when the body set to dark mode
                if (body.classList.contains('dark-mode')) {
                    isDarkMode = true;
                }
                isDarkMode ? body.classList.add('dark-mode') : body.classList.remove('dark-mode');
                store(isDarkMode);
            })()

            btnTogglePill ? btnTogglePill.onclick = (e) => {
                let stateDarkMode = body.classList.toggle('dark-mode');
                store(stateDarkMode);
            } : false;

            btnToggle.onclick = (e) => {
                let stateDarkMode = body.classList.toggle('dark-mode');
                store(stateDarkMode);
            }
        })
    })()
</script>

</html>
