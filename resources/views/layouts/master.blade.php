<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard &mdash; SIP INSTAN</title>
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

        .bi::before {
            content: "";
            display: inline-block;
            /* background-image: url('data:image/svg+xml,%3Csvg%20preserveAspectRatio%3D%22none%22%20viewBox%3D%220%200%2016%2016%22%20fill%3D%22currentColor%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cpath%20fill-rule%3D%22evenodd%22%20d%3D%22M.5%209.9a.5.5%200%200%201%20.5.5v2.5a1%201%200%200%200%201%201h12a1%201%200%200%200%201-1v-2.5a.5.5%200%200%201%201%200v2.5a2%202%200%200%201-2%202H2a2%202%200%200%201-2-2v-2.5a.5.5%200%200%201%20.5-.5z%22%20%2F%3E%3Cpath%20fill-rule%3D%22evenodd%22%20d%3D%22M7.646%2011.854a.5.5%200%200%200%20.708%200l3-3a.5.5%200%200%200-.708-.708L8.5%2010.293V1.5a.5.5%200%200%200-1%200v8.793L5.354%208.146a.5.5%200%201%200-.708.708l3%203z%22%20%2F%3E%3C%2Fsvg%3E'); */
            background-image: url('https://www.svgrepo.com/show/66745/pdf.svg');
            /* background-image: @html_link_asset('arfa/assets/images/icons-pdf.png')

        ;
        */ background-repeat: no-repeat;
        width: 2rem;
        height: 2rem;
        }

        .table tbody td .table-actions {
            /* text-align: right; */
            text-align: center;
        }

        .table tbody td .table-actions a {
            color: #bcc1c6;
            display: inline-block;
            margin-left: 8px;
            font-size: 16px;
        }

        hr {
            margin: 1rem 0;
            color: inherit;
            background-color: currentColor;
            border: 0;
            opacity: 0.75;
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
            <a href="https://inspektorat.magetan.go.id/" target="_blank"class="ml-1">Riki Handoko dkk</a>
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
