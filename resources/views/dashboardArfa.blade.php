@extends('layouts.master')
@push('css_library_page')
    <link rel="stylesheet" href="{{ asset('arfa/vendor/chart.js/Chart.min.css') }}">
@endpush
@section('content')
    <div class="main-content">
        <div class="title">
            Dashboard
        </div>
    </div>
@endsection
@push('js_library_page')
    <script src="{{ asset('arfa/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('arfa/assets/js/pages/index.min.js') }}"></script>
@endpush
