<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">

    <title>Landing &mdash; {{ config('app.name', 'Laravel') }}</title>

    {{-- * Bootstrap core CSS  * --}}
    {{-- <link rel="stylesheet" href="{{ asset('arfa/vendor/bootstrap/css/bootstrap.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}"> --}}
    {{-- use bootstrap vite npm --}}
    {{-- @vite(['resources/js/app.js']) --}}
    @vite(['resources/js/app.css'])

    {{-- TemplateMo 570 Chain App Dev https://templatemo.com/tm-570-chain-app-dev --}}

    {{-- * Additional CSS Files * --}}
    <link rel="stylesheet" href="{{ asset('arfa/vendor/themify-icons/themify-icons.css') }}">
    {{-- *! Vendor !* --}}
    {{-- <link rel="stylesheet" href="{{ asset('frontend/vendor/jquery/plugin/owl-carousel/owl-carousel.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('frontend/vendor/wow-animate/wow-animate.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/templatemo-chain-app-dev.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/custom-landing-sipinstan.css') }}">
    <style>
        svg:hover {
            fill: red;
        }
    </style>
</head>

<body>

    {{-- ***** Preloader Start ***** --}}
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    {{-- ***** Preloader End ***** --}}

    {{-- ***** Header Area Start ***** --}}
    {{-- ? header di animate slideInDown  --}}
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        {{-- ***** Logo Start ***** --}}
                        <a href="#" class="logo" style="width: 40px;">
                            {{-- <img src="{{ asset('frontend/assets/images/logo.png') }}" alt="Chain App Dev"> --}}
                            <img src="{{ asset('arfa/assets/images/logo sipinstan/SipInstan Box.png') }}"
                                alt="Chain App Dev">
                            {{-- public/arfa/assets/images/logo sipinstan/SipInstan Box.ico --}}
                        </a>
                        {{-- ***** Logo End ***** --}}
                        {{-- ***** Menu Start ***** --}}
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="#services">Services</a></li>
                            <li class="scroll-to-section"><a href="#about">About</a></li>
                            <li class="scroll-to-section"><a href="#clients">Clients</a></li>
                            <li class="scroll-to-section"><a href="#pricing">Pricing</a></li>
                            <li class="scroll-to-section"><a href="#newsletter">Newsletter</a></li>
                            {{-- 
                            <li>
                                <div class="gradient-button">
                                    <a id="modal_trigger" href="#modal">
                                        <i class="fa fa-sign-in-alt"></i>
                                        Sign In Now
                                    </a>
                                </div>
                            </li>
                            --}}
                            @if (auth()->check())
                                <li>
                                    {{-- button navigation dashboard --}}
                                    <div class="gradient-button">
                                        <a id="" href="{{ route('dashboard') }}">
                                            <i class="ti-world"></i>
                                            Apps
                                        </a>
                                    </div>
                                </li>
                            @else
                                <li>
                                    {{-- button trigger modal bootstrap --}}
                                    <div class="gradient-button">
                                        <a id="" data-bs-toggle="modal" href="#"
                                            data-bs-target="#modal__login">
                                            <i class="ti-user"></i>
                                            Sign In
                                        </a>
                                    </div>
                                </li>
                            @endif
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        {{-- ***** Menu End ***** --}}
                    </nav>
                </div>
            </div>
        </div>
    </header>
    {{-- ***** Header Area End ***** --}}

    <div id="modal" class="popupContainer" style="display:none;">
        <div class="popupHeader">
            <span class="header_title">Login</span>
            <span class="modal_close"><i class="ti-close"></i></span>
        </div>

        <section class="popupBody">
            {{-- Social Login --}}
            <div class="social_login">
                <div class="">
                    <a href="#" class="social_box fb">
                        <span class="icon"><i class="fab fa-facebook"></i></span>
                        <span class="icon_title">Connect with Facebook</span>
                    </a>

                    <a href="#" class="social_box google">
                        <span class="icon"><i class="fab fa-google-plus"></i></span>
                        <span class="icon_title">Connect with Google</span>
                    </a>
                </div>

                <div class="centeredText">
                    <span>Or use your Email address</span>
                </div>

                <div class="action_btns">
                    <div class="one_half"><a href="#" id="login_form" class="btn">Login</a></div>
                    <div class="one_half last"><a href="#" id="register_form" class="btn">Sign up</a></div>
                </div>
            </div>

            {{-- Username & Password Login form --}}
            <div class="user_login">
                <form>
                    <label>Email / Username</label>
                    <input type="text" />
                    <br />

                    <label>Password</label>
                    <input type="password" />
                    <br />

                    <div class="checkbox">
                        <input id="remember" type="checkbox" />
                        <label for="remember">Remember me on this computer</label>
                    </div>

                    <div class="action_btns">
                        <div class="one_half"><a href="#" class="btn back_btn"><i
                                    class="fa fa-angle-double-left"></i> Back</a></div>
                        <div class="one_half last"><a href="#" class="btn btn_red">Login</a></div>
                    </div>
                </form>

                <a href="#" class="forgot_password">Forgot password?</a>
            </div>

            {{-- Register Form --}}
            <div class="user_register">
                <form>
                    <label>Full Name</label>
                    <input type="text" />
                    <br />

                    <label>Email Address</label>
                    <input type="email" />
                    <br />

                    <label>Password</label>
                    <input type="password" />
                    <br />

                    <div class="checkbox">
                        <input id="send_updates" type="checkbox" />
                        <label for="send_updates">Send me occasional email updates</label>
                    </div>

                    <div class="action_btns">
                        <div class="one_half"><a href="#" class="btn back_btn">
                                <i class="fa fa-angle-double-left"></i>
                                Back
                            </a>
                        </div>
                        <div class="one_half last"><a href="#" class="btn btn_red">Register</a></div>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <div id="top" class="main-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 align-self-center animate__animated" data-animation="animate__fadeInLeft"
                            style="z-index: 5;">
                            <div class="left-content show-up header-text">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h2>Get The Latest App From App Stores</h2>

                                        @php
                                            $www = '<p>halo <em>paga</em></p>';
                                            
                                        @endphp
                                        {!! $www !!}
                                        <p>Chain App Dev is an app landing page HTML5 template based on Bootstrap v5.1.3
                                            CSS layout provided by TemplateMo, a great website to download free CSS
                                            templates.</p>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="white-button first-button scroll-to-section">
                                            <a href="#contact">Free Quote <i class="fab fa-apple"></i></a>
                                        </div>
                                        <div class="white-button scroll-to-section">
                                            <a href="#contact">Free Quote <i class="fab fa-google-play"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 animate__animated" data-animation="animate__fadeInRight"
                            style="z-index: 5;">
                            <div class="right-image">
                                <img src="{{ asset('frontend/assets/images/slider-dec.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="services" class="services section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="section-heading animate__animated" data-animation="animate__fadeInDown">
                        <h4>Amazing <em>Services &amp; Features</em> for you</h4>
                        <img src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">
                        <p>If you need the greatest collection of HTML templates for your business, please visit <a
                                rel="nofollow" href="https://www.toocss.com/" target="_blank">TooCSS</a> Blog. If you
                            need to have a contact form PHP script, go to <a href="https://templatemo.com/contact"
                                target="_parent">our contact page</a> for more information.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="service-item first-service">
                        <div class="icon"></div>
                        <h4>App Maintenance</h4>
                        <p>You are not allowed to redistribute this template ZIP file on any other website.</p>
                        <div class="text-button">
                            <a href="#">Read More <i class="ti-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="service-item second-service">
                        <div class="icon"></div>
                        <h4>Rocket Speed of App</h4>
                        <p>You are allowed to use the Chain App Dev HTML template. Feel free to modify or edit this
                            layout.</p>
                        <div class="text-button">
                            <a href="#">Read More <i class="ti-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="service-item third-service">
                        <div class="icon"></div>
                        <h4>Multi Workflow Idea</h4>
                        <p>If this template is beneficial for your work, please support us <a rel="nofollow"
                                href="https://paypal.me/templatemo" target="_blank">a little via PayPal</a>. Thank
                            you.</p>
                        <div class="text-button">
                            <a href="#">Read More <i class="ti-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="service-item fourth-service">
                        <div class="icon"></div>
                        <h4>24/7 Help &amp; Support</h4>
                        <p>Lorem ipsum dolor consectetur adipiscing elit sedder williamsburg photo booth quinoa and
                            fashion axe.</p>
                        <div class="text-button">
                            <a href="#">Read More <i class="ti-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="about" class="about-us section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="section-heading">
                        <h4 class="animate__animated" data-animation="animate__fadeInLeft">About <em>What We Do</em>
                            &amp; Who We Are</h4>
                        <img src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">
                        <p class="animate__animated" data-animation="animate__fadeInRight">Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit, sed do eismod tempor incididunt ut
                            labore et dolore magna.</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="box-item">
                                <h4><a href="#">Maintance Problems</a></h4>
                                <p>Lorem Ipsum Text</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="box-item">
                                <h4><a href="#">24/7 Support &amp; Help</a></h4>
                                <p>Lorem Ipsum Text</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="box-item">
                                <h4><a href="#">Fixing Issues About</a></h4>
                                <p>Lorem Ipsum Text</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="box-item">
                                <h4><a href="#">Co. Development</a></h4>
                                <p>Lorem Ipsum Text</p>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eismod tempor idunte ut
                                labore et dolore adipiscing magna.</p>
                            <div class="gradient-button">
                                <a href="#">Start 14-Day Free Trial</a>
                            </div>
                            <span>*No Credit Card Required</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-image">
                        <img src="{{ asset('frontend/assets/images/about-right-dec.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="clients" class="the-clients">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="section-heading">
                        <h4 class="animate__animated" data-animation="animate__fadeInRight">Check What <em>The Clients
                                Say</em> About Our App Dev</h4>
                        <img src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">
                        <p class="animate__animated" data-animation="animate__fadeInLeft">Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit, sed do eismod tempor incididunt ut
                            labore et dolore magna.</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="naccs">
                        <div class="grid">
                            <div class="row">
                                <div class="col-lg-7 align-self-center">
                                    <div class="menu">
                                        <div class="first-thumb active">
                                            <div class="thumb">
                                                <div class="row">
                                                    <div class="col-lg-4 col-sm-4 col-12">
                                                        <h4>David Martino Co</h4>
                                                        <span class="date">30 November 2021</span>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-4 d-none d-sm-block">
                                                        <span class="category">Financial Apps</span>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-4 col-12">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <span class="rating">4.8</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="thumb">
                                                <div class="row">
                                                    <div class="col-lg-4 col-sm-4 col-12">
                                                        <h4>Jake Harris Nyo</h4>
                                                        <span class="date">29 November 2021</span>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-4 d-none d-sm-block">
                                                        <span class="category">Digital Business</span>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-4 col-12">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <span class="rating">4.5</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="thumb">
                                                <div class="row">
                                                    <div class="col-lg-4 col-sm-4 col-12">
                                                        <h4>May Catherina</h4>
                                                        <span class="date">27 November 2021</span>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-4 d-none d-sm-block">
                                                        <span class="category">Business &amp; Economics</span>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-4 col-12">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <span class="rating">4.7</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="thumb">
                                                <div class="row">
                                                    <div class="col-lg-4 col-sm-4 col-12">
                                                        <h4>Random User</h4>
                                                        <span class="date">24 November 2021</span>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-4 d-none d-sm-block">
                                                        <span class="category">New App Ecosystem</span>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-4 col-12">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <span class="rating">3.9</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="last-thumb">
                                            <div class="thumb">
                                                <div class="row">
                                                    <div class="col-lg-4 col-sm-4 col-12">
                                                        <h4>Mark Amber Do</h4>
                                                        <span class="date">21 November 2021</span>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-4 d-none d-sm-block">
                                                        <span class="category">Web Development</span>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-4 col-12">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <span class="rating">4.3</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <ul class="nacc">
                                        <li class="active">
                                            <div>
                                                <div class="thumb">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="client-content">
                                                                <img src="{{ asset('frontend/assets/images/quote.png') }}"
                                                                    alt="">
                                                                <p>“Lorem ipsum dolor sit amet, consectetur adpiscing
                                                                    elit, sed do eismod tempor idunte ut labore et
                                                                    dolore magna aliqua darwin kengan
                                                                    lorem ipsum dolor sit amet, consectetur picing elit
                                                                    massive big blasta.”</p>
                                                            </div>
                                                            <div class="down-content">
                                                                <img src="{{ asset('arfa/assets/images/avatar2.png') }}"
                                                                    alt="">
                                                                <div class="right-content">
                                                                    <h4>David Martino</h4>
                                                                    <span>CEO of David Company</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <div class="thumb">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="client-content">
                                                                <img src="{{ asset('frontend/assets/images/quote.png') }}"
                                                                    alt="">
                                                                <p>“CTO, Lorem ipsum dolor sit amet, consectetur
                                                                    adpiscing elit, sed do eismod tempor idunte ut
                                                                    labore et dolore magna aliqua darwin kengan
                                                                    lorem ipsum dolor sit amet, consectetur picing elit
                                                                    massive big blasta.”</p>
                                                            </div>
                                                            <div class="down-content">
                                                                <img src="{{ asset('arfa/assets/images/avatar2.png') }}"
                                                                    alt="">
                                                                <div class="right-content">
                                                                    <h4>Jake H. Nyo</h4>
                                                                    <span>CTO of Digital Company</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <div class="thumb">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="client-content">
                                                                <img src="{{ asset('frontend/assets/images/quote.png') }}"
                                                                    alt="">
                                                                <p>“May, Lorem ipsum dolor sit amet, consectetur
                                                                    adpiscing elit, sed do eismod tempor idunte ut
                                                                    labore et dolore magna aliqua darwin kengan
                                                                    lorem ipsum dolor sit amet, consectetur picing elit
                                                                    massive big blasta.”</p>
                                                            </div>
                                                            <div class="down-content">
                                                                <img src="{{ asset('arfa/assets/images/avatar2.png') }}"
                                                                    alt="">
                                                                <div class="right-content">
                                                                    <h4>May C.</h4>
                                                                    <span>Founder of Catherina Co.</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <div class="thumb">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="client-content">
                                                                <img src="{{ asset('frontend/assets/images/quote.png') }}"
                                                                    alt="">
                                                                <p>“Lorem ipsum dolor sit amet, consectetur adpiscing
                                                                    elit, sed do eismod tempor idunte ut labore et
                                                                    dolore magna aliqua darwin kengan
                                                                    lorem ipsum dolor sit amet, consectetur picing elit
                                                                    massive big blasta.”</p>
                                                            </div>
                                                            <div class="down-content">
                                                                <img src="{{ asset('arfa/assets/images/avatar2.png') }}"
                                                                    alt="">
                                                                <div class="right-content">
                                                                    <h4>Random Staff</h4>
                                                                    <span>Manager, Digital Company</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <div class="thumb">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="client-content">
                                                                <img src="{{ asset('frontend/assets/images/quote.png') }}"
                                                                    alt="">
                                                                <p>“Mark, Lorem ipsum dolor sit amet, consectetur
                                                                    adpiscing elit, sed do eismod tempor idunte ut
                                                                    labore et dolore magna aliqua darwin kengan
                                                                    lorem ipsum dolor sit amet, consectetur picing elit
                                                                    massive big blasta.”</p>
                                                            </div>
                                                            <div class="down-content">
                                                                <img src="{{ asset('arfa/assets/images/avatar2.png') }}"
                                                                    alt="">
                                                                <div class="right-content">
                                                                    <h4>Mark Am</h4>
                                                                    <span>CTO, Amber Do Company</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="pricing" class="pricing-tables">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="section-heading animate__animated" data-animation="animate__slideInDown">
                        <h4>We Have The Best Pre-Order <em>Prices</em> You Can Get</h4>
                        <img src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eismod tempor incididunt ut
                            labore et dolore magna.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="pricing-item-regular">
                        <span class="price">$12</span>
                        <h4>Standard Plan App</h4>
                        <div class="icon">
                            <img src="{{ asset('frontend/assets/images/pricing-table-01.png') }}" alt="">
                        </div>
                        <ul>
                            <li>Lorem Ipsum Dolores</li>
                            <li>20 TB of Storage</li>
                            <li class="non-function">Life-time Support</li>
                            <li class="non-function">Premium Add-Ons</li>
                            <li class="non-function">Fastest Network</li>
                            <li class="non-function">More Options</li>
                        </ul>
                        <div class="border-button">
                            <a href="#">Purchase This Plan Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="pricing-item-pro">
                        <span class="price">$25</span>
                        <h4>Business Plan App</h4>
                        <div class="icon">
                            <img src="{{ asset('frontend/assets/images/pricing-table-01.png') }}" alt="">
                        </div>
                        <ul>
                            <li>Lorem Ipsum Dolores</li>
                            <li>50 TB of Storage</li>
                            <li>Life-time Support</li>
                            <li>Premium Add-Ons</li>
                            <li class="non-function">Fastest Network</li>
                            <li class="non-function">More Options</li>
                        </ul>
                        <div class="border-button">
                            <a href="#">Purchase This Plan Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="pricing-item-regular">
                        <span class="price">$66</span>
                        <h4>Premium Plan App</h4>
                        <div class="icon">
                            <img src="{{ asset('frontend/assets/images/pricing-table-01.png') }}" alt="">
                        </div>
                        <ul>
                            <li>Lorem Ipsum Dolores</li>
                            <li>120 TB of Storage</li>
                            <li>Life-time Support</li>
                            <li>Premium Add-Ons</li>
                            <li>Fastest Network</li>
                            <li>More Options</li>
                        </ul>
                        <div class="border-button">
                            <a href="#">Purchase This Plan Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer id="newsletter">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="section-heading animate__animated" data-animation="animate__slideInUp">
                        <h4>Join our mailing list to receive the news &amp; latest trends</h4>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-3">
                    <form id="search" action="#" method="GET">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <fieldset>
                                    <input type="address" name="address" class="email"
                                        placeholder="Email Address..." autocomplete="on" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <fieldset>
                                    <button type="submit" class="main-button">Subscribe Now <i
                                            class="fa fa-angle-right"></i></button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer-widget">
                        <h4>Contact Us</h4>
                        <p>Rio de Janeiro - RJ, 22795-008, Brazil</p>
                        <p><a href="#">010-020-0340</a></p>
                        <p><a href="#">info@company.co</a></p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="footer-widget">
                        <h4>About Us</h4>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Testimonials</a></li>
                            <li><a href="#">Pricing</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Testimonials</a></li>
                            <li><a href="#">Pricing</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="footer-widget">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><a href="#">Free Apps</a></li>
                            <li><a href="#">App Engine</a></li>
                            <li><a href="#">Programming</a></li>
                            <li><a href="#">Development</a></li>
                            <li><a href="#">App News</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">App Dev Team</a></li>
                            <li><a href="#">Digital Web</a></li>
                            <li><a href="#">Normal Apps</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="footer-widget">
                        <h4>About Our Company</h4>
                        <div class="logo">
                            {{-- <img src="{{ asset('frontend/assets/images/white-logo.png') }}" alt=""> --}}
                            {{-- <img src="{{ asset('arfa/assets/images/logo sipinstan/SipInstan Outline.svg') }}"
                                alt=""> --}}
                            <x-application-logo-sipinstan-no-border width="75px" height="75px" />
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore.</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="copyright-text">
                        <p>Copyright © 2022 Chain App Dev Company. All Rights Reserved.
                            <br>Design: <a href="https://templatemo.com/" target="_blank"
                                title="css templates">TemplateMo</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    {{-- ***** Modal Login Start ***** --}}
    <div class="modal fade" id="modal__login" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                {{-- 
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> 
                --}}
                {{-- border rounded-4 p-3 bg-white shadow --}}
                {{-- d-flex justify-content-center align-items-center min-vh-100 --}}
                <div class="modal-body">
                    <div class="container">
                        <div class="modal__box_area row">

                            {{-- left box --}}
                            <div
                                class="modal__left_box col-md-6 
                                {{-- bg-danger bg-opacity-25  --}}
                                rounded-4 d-flex justify-content-center align-items-center flex-column">
                                <div class="featured-image mb-3">
                                    <img src="{{ asset('frontend/assets/images/secure-login-crop.png') }}"
                                        alt="" srcset="" class="img-fluid" style="">
                                </div>
                                <p class="text-white font-monospace"
                                    style="font-size: 12px; font-weight: 700; line-height: 1">
                                    Magni voluptate delectus ipsam.</p>
                                <small class="text-white text-wrap text-center">Lorem, ipsum dolor sit amet consectetur
                                    adipisicing elit.
                                </small>
                            </div>

                            {{-- right box --}}
                            {{-- bg-warning bg-opacity-25" --}}
                            <div class="modal__right_box col-md-6">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="row align-items-center">
                                        <div class="header-text mb-4">
                                            <h2>Hello, Again</h2>
                                            <p class="fs-6">We are happy to have you back.</p>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="text" name="email" id="email"
                                                class="form-control form-control-sm bg-light fs-6"
                                                placeholder="Email address">
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="password" name="password" id="password"
                                                class="form-control form-control-sm bg-light fs-6"
                                                placeholder="Password">
                                        </div>
                                        <div class="input-group mb-5 d-flex justify-content-between">
                                            <div class="form-check">
                                                <input type="checkbox" name="remember" id="login__input_check"
                                                    class="form-check-input">
                                                <label for="login__input_check"
                                                    class="form-check-label text-secondary"><em>Remember
                                                        Me</em></label>
                                            </div>
                                            <div class="login__forgot"><a href="#">Forgot Password ?</a></div>
                                        </div>
                                        @error('email')
                                            <div id="failed-message-email"
                                                class="alert alert-danger alert-dismissible fade show" data-delay="4s"
                                                data-animation="sipinstan__fadeOut" role="alert">
                                                <strong>Failed!</strong>&nbsp;{{ $message }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                        @enderror
                                        <div class="input-group mb-3">
                                            <button type="submit"
                                                class="btn btn-sm btn-primary w-100 fs-6 bg-opacity-50">
                                                Login
                                            </button>
                                        </div>
                                        <div class="input-group mb-3">
                                            <button class="btn btn-sm btn-light w-100 fs-6">
                                                <img src="https://fonts.gstatic.com/s/i/productlogos/googleg/v6/24px.svg"
                                                    alt="logo google" srcset="" style="width: 20px;"
                                                    class="me-2">
                                                <small>Sign In with Google</small>
                                            </button>
                                        </div>
                                        <div class="row">
                                            <small>Don't have account? <a href="#"> Sign Up</a></small>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}

            </div>
        </div>
    </div>
    {{-- ***** Modal Login End ***** --}}

    {{-- Scripts --}}

    {{-- <script src="{{ asset('arfa/vendor/jquery/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('arfa/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>

    {{-- <script src="{{ asset('frontend/vendor/jquery/plugin/owl-carousel/owl-carousel.js') }}"></script> --}}
    {{-- <script src="{{ asset('frontend/vendor/jquery/plugin/js/images-loaded.js') }}"></script> --}}
    {{-- <script src="{{ asset('frontend/vendor/jquery/plugin/js/lean-modal.js') }}"></script> --}}

    {{-- <script src="{{ asset('frontend/vendor/wow-animate/wow-animate.js') }}"></script> --}}

    {{-- <script src="{{ asset('frontend/assets/js/custom.js') }}"></script> --}}
    <script src="{{ asset('frontend/assets/js/custom-landing-sipinstan.js') }}"></script>
    <script>
        /** {{-- this varible will use on custom-landing-sipinstan.js, get error php and save to varivle javascript --}} */
        var globalErrorLaravel =
            `@error('email') {{ $message }} @enderror`;
    </script>
</body>

</html>
