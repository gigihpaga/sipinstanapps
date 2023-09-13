@extends('layouts.master')

@push('css_library_page')
    <link href="{{ asset('arfa/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" /> --}}
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" /> --}}

    <link href="{{ asset('arfa/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('arfa/vendor/izitoast/css/iziToast.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('arfa/vendor/jquery-smartwizard/css/smart_wizard_all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('arfa/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('arfa/vendor/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('arfa/vendor/select2-bootstrap-5-theme/select2-bootstrap-5-theme.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('arfa/vendor/sweetalert2/sweetalert2.css') }}" rel="stylesheet" />
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
                            <div class="row d-flex justify-evenly">
                                <div class="col">
                                    <h6 class="card-title">Daftar Pengajuan SPT</h6>
                                </div>
                                <div class="col-2">
                                    <x-button-descriptions-status-spt />
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-filter row mb-2">
                                <h2 class="fs-6 mb-1">Filter</h2>
                                <div class="form-group form-control-sm col-md-4 col-sm-4">
                                    <label for="cmb_pemohon_spt" class="form-label">Pemohon SPT</label>
                                    <select class="cmb_filter_dt cmb_select2 form-select form-select-sm"
                                        name="cmb_pemohon_spt">
                                        <option></option>
                                        {{-- render data ajax here --}}
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group form-control-sm col-md-3 col-sm-4">
                                    <label for="cmb_sifat_tugas" class="form-label">Sifat Tugas</label>
                                    <select class="cmb_filter_dt cmb_select2 form-select form-select-sm"
                                        name="cmb_sifat_tugas">
                                        <option></option>
                                        {{-- render data ajax here --}}
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group form-control-sm col-md-3 col-sm-4">
                                    <label for="cmb_last_status_history" class="form-label">Status SPT</label>
                                    <select class="cmb_filter_dt cmb_select2 form-select form-select-sm"
                                        name="cmb_last_status_history">
                                        <option></option>
                                        {{-- render data ajax here --}}
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group form-control-sm col-md-2 col-sm-4">
                                    <div class="row">
                                        <label for="" class="form-label">Atur Kolom</label>
                                        <div id="btn-controll-column" class="btn-group">
                                            <button type="button" role="button" data-bs-toggle="dropdown"
                                                aria-expanded="false"
                                                class="btn btn-sm btn-outline-secondary dropdown-toggle">
                                                Kolom
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <div class="dropdown-item">
                                                        <div class="form-check">
                                                            <input id="" class="form-check-input"
                                                                data-idx-column="" type="checkbox" value="">
                                                            <label for="" class="form-check-label">
                                                                Default checkbox
                                                            </label>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="divider"></div>
                            </div>
                            {{--  --}}
                            <div class="dt-responsive">
                                <table id="tabel" class="table table-stripped table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>No.</th>
                                            <th>pemohon spt</th>
                                            <th>sifat tugas</th>
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
        <div id="modal-action" data-bs-backdrop="static" class="modal fade" tabindex="-1"
            aria-labelledby="modal-action-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
                {{--   modal-dialog-scrollable  --}}
                {{-- <-- modal-lg--> --}}
                {{-- modal-form --}}
                {{-- modal-form --}}
            </div>
        </div>
        {{-- modal end --}}

        {{-- modal pdf start --}}
        <div id="modal-pdf" data-bs-backdrop="static" class="modal fade" tabindex="-1" aria-labelledby="modal-pdf-label"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modal-pdf-label">Lampiran PKA</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="px-3 my-1 ">
                        <h2 id="modal-pdf-filename" class="my-0 font-monospace fw-semibold" style="font-size: 12px">
                            pdf-filename.pdf</h2>
                    </div>
                    <div class="modal-body">
                        <div id="pdf-object-wrapper" data-url-pdf=""></div>
                        {{-- <embed src="http://127.0.0.1:8000/dokumen/pka/pka-20230812-023533.pdf" type=""> --}}
                    </div>
                    <div class="modal-footer justify-content-between">
                        <a id="btn_view_on_new_tab" href="" class="btn btn-sm icon-left btn-outline-secondary"
                            data-bs-toggle="tooltip" title="View on new tab" target="_blank">
                            <i class="ti-desktop"></i>
                            View
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        {{-- modal pdf end --}}

        {{-- template for tabel spt start --}}

        {{-- template for tabel spt (child table) --}}
        <template id="template_tabel_spt_child">
            <div class="details-container px-4 py-0 mb-3">
                <div class="row mb-2">
                    <div class="col-auto" data-child-wrapper="button-spt">
                        <label class="form-label">View and Edit SPT</label>
                    </div>
                    <div class="col-auto" data-child-wrapper="button-pka">
                        <label class="form-label">View and Edit PKA</label>
                    </div>
                    <div class="col-auto" data-child-wrapper="button-lampiran-pka">
                        <label class="form-label">View Lampiran PKA</label>
                    </div>
                    <div class="col-auto" data-child-wrapper="button-update-spt">
                        <label class="form-label">Update Status SPT</label>
                    </div>
                </div>
            </div>
        </template>

        {{-- template for tabel spt (button view pdf) --}}
        <template id="template_tabel_spt_view_button_lampiran_pka">
            <div class="d-flex">
                <a href="{{ route('pkaspt.pka.filepdf', '_REPLACE_ID_PKA') }}?encode=yes" data-id=""
                    data-typeaction="view_lampiran_pka" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="View Lampiran" data-bs-original-title="View Lampiran"
                    class="btn btn-action btn-sm btn-outline-danger icon-left">
                    <i class="ti-zip"></i>
                    PDF
                </a>
            </div>
        </template>

        {{-- template for tabel spt (button update status spt) --}}
        <template id="template_tabel_spt_button_update_status_spt">
            <div class="d-flex">
                <div class="btn-group">
                    <button type="button" data-id-spt=""
                        class="btn btn-action btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false" data-typeaction="update_status_spt">
                        Update Status
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item text-warning" style="font-size: 14px" href="#">
                                <i class="ti-settings"></i>
                                Revision
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" style="font-size: 14px; color:#9a43ff;" href="#">
                                <i class="ti-check-box"></i>
                                Verified
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-danger" style="font-size: 14px" href="#">
                                <i class="ti-na"></i>
                                Rejected
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-success" style="font-size: 14px" href="#">
                                <i class="ti-stamp"></i>
                                Approved
                            </a>
                        <li>
                            <hr class="text-white dropdown-divider">
                        </li>
                    </ul>
                </div>
            </div>
        </template>

        {{-- template for tabel spt end --}}

    </div>
@endsection

@push('js_library_page')
    <script src="{{ asset('arfa/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('arfa/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('arfa/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('arfa/vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('arfa/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('arfa/vendor/moment/moment-with-locales.min.js') }}"></script>
    {{-- {{-- <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script> --}}
    {{-- <script defer src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> --}}
    {{-- <script defer src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script> --}}
    <script src="{{ asset('arfa/vendor/datatables.net-ellipsis/js/ellipsis.js') }}"></script>
    <script src="{{ asset('arfa/vendor/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('arfa/vendor/izitoast/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('arfa/assets/js/pages/datatables.min.js') }}"></script>
    <script src="{{ asset('arfa/assets/js/pages/element-ui.min.js') }}"></script>
    <script src="{{ asset('arfa/assets/js/pages/element-ui-serverside.js') }}"></script>
    <script src="{{ asset('arfa/assets/js/pages/modules_toastr.js') }}"></script>
    <script src="{{ asset('arfa/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
@endpush

@push('js_library_page')
    {{-- {{ $dataTable->scripts() }} --}}
    <script src="{{ asset('arfa/vendor/jquery-smartwizard/js/jquery.smartWizard.min.js') }}"></script>
    <script src="{{ asset('arfa/vendor/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('arfa/vendor/pdfobject/pdfobject.js') }}"></script>
@endpush

@push('js_page')
    {{-- <script src="{{ asset('arfa/vendor/custome-modal-multi-stepper/js/script.js') }}"></script> --}}
    <script src="{{ asset('arfa/assets/js/moduleapps/pkasptTrans.js') }}"></script>
@endpush
