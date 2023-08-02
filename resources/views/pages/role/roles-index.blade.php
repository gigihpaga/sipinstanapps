@extends('layouts.master')

@push('css_library_page')
    <link href="{{ asset('arfa/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('arfa/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" />
@endpush

@section('content')
    <div class="main-content">
        <div class="title">
            Konfigurasi
        </div>
        <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="tolong" data-bs-original-title="Edit"
            class="btn mb-2 btn-sm btn-primary"><i class="ti-plus"></i>
        </button>
        <div class="content-wrapper">
            <div class="row same-height">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Roles</h4>
                        </div>
                        <div class="card-body">
                            {{-- <canvas id="myChart" height="642" width="1388"></canvas> --}}
                            {{-- auth()->user()->can('create permission') --}}
                            @if (request()->user()->can('create permission'))
                                <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data"
                                    data-bs-original-title="Tambah Data" class="btn mb-4 btn-sm btn-primary">
                                    <i class="ti-plus"></i>
                                    Tambah Data
                                </button>
                            @endif
                            {{ $dataTable->table() }}
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js_library_page')
    {{-- <script src="{{ asset('arfa/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('arfa/assets/js/pages/index.min.js') }}"></script> --}}
    <script src="{{ asset('arfa/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('arfa/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('arfa/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('arfa/vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('arfa/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('arfa/assets/js/pages/datatables.min.js') }}"></script>
    <script src="{{ asset('arfa/assets/js/pages/element-ui.min.js') }}"></script>
@endpush

@push('js_library_page')
    {{ $dataTable->scripts() }}
@endpush
