@extends('layouts.master')

@push('css_library_page')
    <link href="{{ asset('arfa/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" /> --}}
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" /> --}}

    <link href="{{ asset('arfa/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('arfa/vendor/izitoast/css/iziToast.min.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet"
        type="text/css" />
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
                            <button type="button" data-bs-toggle="modal" data-bs-placement="top" title="Buat Pengajuan"
                                data-bs-target="#modal-action" data-bs-original-title="Buat Pengajuan"
                                class="btn btn-sm btn-primary btn-add">
                                <i class="ti-plus"></i>
                                Buat Pengajuan
                            </button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">Daftar Pengajuan SPT</h6>
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
                {{--   modal-dialog-scrollable  --}}
                {{-- <-- modal-lg--> --}}
                {{-- modal-form --}}
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
    <script src="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/js/jquery.smartWizard.min.js" type="text/javascript">
    </script>
@endpush

@push('js_page')
    {{-- <script src="{{ asset('arfa/vendor/custome-modal-multi-stepper/js/script.js') }}"></script> --}}
    <script src="{{ asset('arfa/assets/js/moduleapps/pkasptTrans.js') }}"></script>
@endpush
