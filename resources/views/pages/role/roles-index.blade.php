@extends('layouts.master')

@push('css_library_page')
    <link href="{{ asset('arfa/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('arfa/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" />
@endpush

@section('content')
    <div class="main-content">
        <div class="title mb-4">
            <i class="ti-book"></i>
            Konfigurasi
        </div>
        {{-- <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="tolong" data-bs-original-title="Edit"
            class="btn mb-2 btn-sm btn-primary"><i class="ti-plus"></i>
        </button> --}}
        <div class="content-wrapper">
            <div class="row same-height">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Roles</h5>
                        </div>
                        <div class="card-body">
                            {{-- <canvas id="myChart" height="642" width="1388"></canvas> --}}
                            {{-- auth()->user()->can('create permission') --}}
                            @if (request()->user()->can('create permission'))
                                <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data"
                                    data-bs-original-title="Tambah Data" class="btn mb-4 btn-sm btn-primary btn-add">
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
        {{-- modal start --}}
        <div id="modal-action" class="modal fade" tabindex="-1" aria-labelledby="largeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                {{-- role-form --}}
            </div>
        </div>
        {{-- modal end --}}
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
    <script src="{{ asset('arfa/vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('arfa/assets/js/pages/datatables.min.js') }}"></script>
    <script src="{{ asset('arfa/assets/js/pages/element-ui.min.js') }}"></script>
    <script src="{{ asset('arfa/assets/js/pages/element-ui-serverside.js') }}"></script>
@endpush

@push('js_library_page')
    {{ $dataTable->scripts() }}
@endpush

@push('js_page')
    <script>
        // initial modal
        const modalAction = new bootstrap.Modal($('#modal-action'))

        // handle button add
        $('.btn-add').on('click', function() {
            // ajax
            $.ajax({
                type: "GET",
                url: `{{ url('konfigurasi/roles/create') }}`,
                // data: "data",
                // dataType: "dataType",
                success: function(resHtlm) {
                    // set content modal from response
                    $('#modal-action').find('.modal-dialog').html(resHtlm)
                    // show modified modal
                    modalAction.show()
                    // prepare for execution update
                    handleActionSubmit()
                },
                error: function(err) {
                    console.log('[Log On] >> [roles-index.blade] -> [err] : ', err);
                }
            });
        })

        // handle button edit
        $('#role-table').on('click', '.btn-action', function() {
            let data = $(this).data()
            let id = data.id
            let typeaction = data.typeaction

            //
            if (typeaction == 'delete') {
                // swall confirm
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#027afe',
                    cancelButtonColor: '#ea5455',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // jika confirm yes, jalankan ajax
                        $.ajax({
                            type: "DELETE",
                            url: `{{ url('konfigurasi/roles') }}/${id}`,
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            },
                            success: function(res) {
                                // response berhasil
                                window.LaravelDataTables["role-table"].ajax.reload()
                                if (res.status == 'success') {
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    )
                                }
                            },
                            error: function(err) {
                                // console.log('Pesan erron: ,' err)
                            }
                        });


                    }
                })
                /**
                 * jika typeaction == delete maka akan di return (program tidak tidak akan menjalankan code dibawahnya)
                 * jika tidak (jika typeaction == update), maka akan menjalankan aja get data for edit
                 */
                return
            }

            // ajax get data for edit
            $.ajax({
                type: "GET",
                url: `{{ url('konfigurasi/roles') }}/${id}/edit`,
                // data: "data",
                // dataType: "dataType",
                success: function(resHtlm) {
                    // set content modal from response
                    $('#modal-action').find('.modal-dialog').html(resHtlm)
                    // show modified modal
                    modalAction.show()
                    // prepare for execution update
                    handleActionSubmit()
                }
            });
        })

        // initial handle button submit (dinamic route, 1. create 2. edit) in modal
        function handleActionSubmit() {
            $('#form-action').on('submit', function(e) {
                e.preventDefault()
                const _form = this
                // grab data in form modal
                const formData = new FormData(_form)

                /**
                 * get url/route in form (dynamic route sesuai dengan request sebelumnyan)
                 * jika request sebelumnya ada "create", maka submit ini akan mengarah ke route "store"
                 * jika request sebelumnya ada "edit", maka submit ini akan mengarah ke route "update"
                 */
                const url = this.getAttribute('action')

                // ajax update data
                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                    processData: false,
                    contentType: false,
                    // dataType: "dataType",
                    success: function(resHtlm) {
                        // show modified modal
                        modalAction.hide()
                        // reaload datatable
                        window.LaravelDataTables["role-table"].ajax.reload()
                    },
                    error: function(resErr) {
                        // get list field error from json response
                        let listFieldError = resErr.responseJSON?.errors
                        // reset form
                        $(_form).find('.text-danger.text-small').remove()
                        $(_form).find('.form-control').removeClass("is-invalid")
                        // $(_form).find('.form-control').addClass("is-valid")
                        if (listFieldError) {
                            // looping key object listFieldError
                            for (const [key, value] of Object.entries(listFieldError)) {
                                //   find field element form with object key
                                $(`[name=${key}]`)
                                    .addClass('is-invalid')
                                    .parent()
                                    .append(`<span class="text-danger text-small">${value}</span>`)
                            }
                        }

                    }
                });
            })
        }
        // $('#role-table').ready(function() {});
    </script>
@endpush
