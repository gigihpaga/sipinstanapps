@extends('layouts.master')

@push('css_library_page')
    <link href="{{ asset('arfa/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" /> --}}
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" /> --}}

    <link href="{{ asset('arfa/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('arfa/vendor/izitoast/css/iziToast.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('arfa/vendor/izitoast/css/iziToast.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="main-content">
        <div class="title mb-4">
            <i class="ti-book"></i>
            Dokumen
        </div>
        {{-- <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="tolong" data-bs-original-title="Edit"
            class="btn mb-2 btn-sm btn-primary"><i class="ti-plus"></i>
        </button> --}}
        <div class="content-wrapper">
            <div class="row same-height">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">PKA dan SPT</h5>
                        </div>
                        <div class="card-body">
                            <button type="button" data-bs-toggle="modal" data-bs-placement="top" title="Tambah Data"
                                data-bs-target="#modal-action" data-bs-original-title="Tambah Data"
                                class="btn btn-sm btn-primary btn-add">
                                <i class="ti-plus"></i>
                                Tambah Data
                            </button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">Tabel</h6>
                        </div>
                        <div class="card-body">
                            {{--  --}}
                            <div class="dt-responsive">
                                <table id="tabel" class="table table-stripped table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>action</th>
                                            <th>No.</th>
                                            <th>pemohon spt</th>
                                            <th>sifat tugas</th>
                                            <th>PKA</th>
                                            <th>nomor pengajuan</th>
                                            <th>status buat</th>
                                            <th>tanggal mulai</th>
                                            <th>tanggal selesai</th>
                                            <th>Status SPT</th>
                                            <th>keterangan tugas</th>
                                            <th>note</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            {{--  --}}
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
            </div>
        </div>
        {{-- modal start --}}
        <div id="modal-action" class="modal fade" tabindex="-1" aria-labelledby="modal-action-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                {{-- modal-form --}}
                <div class="modal-content">
                    {{-- <form id="form-action" action="{{ $action }}" method="POST"> --}}
                    <form id="form-action" action="" method="POST">
                        {{-- @csrf
                        @method($method) --}}
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-action-label">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="pkano" class="form-label">Nomor PKA</label>
                                        {{-- <input type="text" value="{{ $role->name }}" placeholder="Role name" --}}
                                        <input type="text" value="" placeholder="Nomor PKA" name="pka_no"
                                            class="form-control" id="pkano" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="namaOpd" class="form-label">Nama OPD</label>
                                        {{-- <input type="text" value="{{ $role->guard_name }}" placeholder="Guard name" --}}
                                        <input type="text" value="" placeholder="Nama OPD" name="nama_opd"
                                            class="form-control" id="namaOpd" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="start_date" class="form-label">Tanggal PKA</label>
                                    <div class="input-group mb-3 input-daterange datepicker date"
                                        data-date-format="dd-mm-yyyy">
                                        <input class="form-control" required="" type="text" id="start_date"
                                            name="start_date" value="" readonly="">
                                        <span
                                            class="bg-primary text-light px-3 justify-content-center align-items-center d-flex">sampai</span>
                                        <input class="form-control" required="" type="text" id="end_date"
                                            name="end_date" value="" readonly="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Sasaran</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="start_date" class="form-label">Date Picker Range</label>
                                        <div class="input-group mb-3 input-daterange datepicker date"
                                            data-date-format="dd-mm-yyyy">
                                            <input class="form-control" required="" type="text" id="start_date"
                                                name="start_date" value="" readonly="">
                                            <span
                                                class="bg-primary text-light px-3 justify-content-center align-items-center d-flex">to</span>
                                            <input class="form-control" required="" type="text" id="end_date"
                                                name="end_date" value="" readonly="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="formFileSm" class="form-label">Small file input example</label>
                                    <input class="form-control" id="formFileSm" type="file">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
                                {{-- data-bs-placement="top" title="{{ $titleButton }}" --}} data-bs-placement="top" title="" {{-- data-bs-original-title="{{ $titleButton }}"> --}}
                                data-bs-original-title="">
                                <i class="ti-save"></i>
                            </button>
                        </div>
                    </form>
                </div>
                {{-- modal-form --}}
            </div>
        </div>
        {{-- modal end --}}
    </div>
@endsection

@push('js_library_page')
    <script src="{{ asset('arfa/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('arfa/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('arfa/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('arfa/vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('arfa/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    {{-- {{-- <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script> --}}
    {{-- <script defer src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> --}}
    {{-- <script defer src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script> --}}
    <script src="https://cdn.datatables.net/plug-ins/1.10.16/dataRender/ellipsis.js"></script>
    <script src="{{ asset('arfa/vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('arfa/vendor/izitoast/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('arfa/assets/js/pages/datatables.min.js') }}"></script>
    <script src="{{ asset('arfa/assets/js/pages/element-ui.min.js') }}"></script>
    <script src="{{ asset('arfa/assets/js/pages/element-ui-serverside.js') }}"></script>
    <script src="{{ asset('arfa/assets/js/pages/modules_toastr.js') }}"></script>
@endpush

@push('js_library_page')
    {{-- {{ $dataTable->scripts() }} --}}
@endpush

@push('js_page')
    <script src="{{ asset('arfa/assets/js/moduleapps/pkasptTrans.js') }}"></script>
@endpush
