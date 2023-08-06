<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard &mdash; Arfa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />
    {{-- <link rel="stylesheet" href="{{ asset('arfa/vendor/font-awesome/font-awesome5.15.2.all.min.css') }}" /> --}}

    <link rel="stylesheet" href="{{ asset('arfa/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('arfa/vendor/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('arfa/vendor/perfect-scrollbar/css/perfect-scrollbar.css') }}">

    <!-- start CSS library for this page only -->
    @stack('css_library_page')
    <!-- end CSS library for this page only -->

    <!-- start CSS for this page only -->
    @stack('css_page')
    <!-- end CSS for this page only -->

    <link rel="stylesheet" href="{{ asset('arfa/assets/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('arfa/assets/css/bootstrap-override.min.css') }}">
    <link rel="stylesheet" id="theme-color" href="{{ asset('arfa/assets/css/dark.min.css') }}">
    <style>
        .main-content,
        .sidebar-content ul>li a {
            font-size: 14px;
        }

        .main-content .title i {
            display: inline-block;
            background: linear-gradient(90deg, #027afe, rgba(70, 137, 238, .7));
            color: #fff;
            padding: 8px;
            border-radius: 4px;
        }

        /*
        * loading datatable
        * document.querySelector('.dataTables_processing').style.display = 'block'
        */
        div .dataTables_processing {
            background-color: #191f30cc !important;
            color: white;
        }

        div .dataTables_processing.card {
            height: 25px !important;
        }

        div.dataTables_processing>div:last-child {
            margin: auto auto !important;
        }
    </style>
</head>

<body>
    <div id="app">
        <div class="shadow-header"></div>
        {{-- header --}}
        @include('layouts.header')
        {{-- nav --}}
        @include('layouts.navbar')
        {{-- main --}}
        @yield('content')
        {{-- setting --}}
        @include('layouts.settings')

        <footer>
            Copyright © 2023 &nbsp
            <a href="https://www.youtube.com/c/mulaidarinull" target="_blank"class="ml-1">Gigih Paga </a>
            <span> . All rights Reserved</span>
        </footer>
        <div class="overlay action-toggle"></div>
    </div>
    <script src="{{ asset('arfa/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('arfa/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <!-- start JS librabry for this page only -->
    @stack('js_library_page')
    <!-- end JS librabry for this page only -->
    <script src="{{ asset('arfa/assets/js/main.min.js') }}"></script>

    <script>
        Main.init()
    </script>

    <!-- start JS for this page only -->
    @stack('js_page')
    <!-- end JS for this page only -->
</body>

</html>
