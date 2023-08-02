@extends('layouts.master')
@push('css_library_page')
    <link rel="stylesheet" href="{{ asset('arfa/vendor/chart.js/Chart.min.css') }}">
@endpush
@section('content')
    <div class="main-content">
        <div class="title">
            Konfigurasi
        </div>
        <div class="content-wrapper">
            <div class="row same-height">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Roles</h4>
                        </div>
                        <div class="card-body">
                            {{-- <canvas id="myChart" height="642" width="1388"></canvas> --}}
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js_library_page')
    <script src="{{ asset('arfa/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('arfa/assets/js/pages/index.min.js') }}"></script>
@endpush
