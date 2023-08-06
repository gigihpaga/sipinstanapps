$(document).ready(function () {
    var feature = (function () {
        const url = window.location.href;
        let csrf = $('meta[name="csrf-token"]').attr('content');
        //
        // initial modal
        const modalAction = new bootstrap.Modal($('#modal-action'));

        // handle button add
        $('.btn-add').on('click', function () {
            // ajax
            $.ajax({
                type: 'GET',
                url: `${url}/create`,
                // data: "data",
                // dataType: "dataType",
                success: function (resHtlm) {
                    // set content modal from response
                    $('#modal-action').find('.modal-dialog').html(resHtlm);
                    // show modified modal
                    modalAction.show();
                    // prepare for execution update
                    handleActionSubmit();
                },
                error: function (err) {
                    console.log('[Log On] >> [roles-index.blade] -> [err] : ', err);
                },
            });
        });

        // handle button edit
        $('#role-table').on('click', '.btn-action', function () {
            let data = $(this).data();
            let id = data.id;
            let typeaction = data.typeaction;

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
                    confirmButtonText: 'Yes, delete it!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // jika confirm yes, jalankan ajax
                        $.ajax({
                            type: 'DELETE',
                            url: `${url}/${id}`,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function (response) {
                                // response berhasil
                                window.LaravelDataTables['role-table'].ajax.reload();
                                if (response.status == 'success') {
                                    modules_toastr.notif('Info', response.message, 'success');
                                }
                            },
                            error: function (err) {
                                // console.log('Pesan erron: ,' err)
                            },
                        });
                    }
                });
                /**
                 * jika typeaction == delete maka akan di return (program tidak tidak akan menjalankan code dibawahnya)
                 * jika tidak (jika typeaction == update), maka akan menjalankan aja get data for edit
                 */
                return;
            }

            // ajax get data for edit
            $.ajax({
                type: 'GET',
                url: `${url}/${id}/edit`,
                // data: "data",
                // dataType: "dataType",
                success: function (resHtlm) {
                    // set content modal from response
                    $('#modal-action').find('.modal-dialog').html(resHtlm);
                    // show modified modal
                    modalAction.show();
                    // prepare for execution update
                    handleActionSubmit();
                },
            });
        });

        // initial handle button submit (dinamic route, 1. create 2. edit) in modal
        function handleActionSubmit() {
            $('#form-action').on('submit', function (e) {
                e.preventDefault();
                const _form = this;
                // grab data in form modal
                const formData = new FormData(_form);

                /**
                 * get url/route in form (dynamic route sesuai dengan request sebelumnyan)
                 * jika request sebelumnya ada "create", maka submit ini akan mengarah ke route "store"
                 * jika request sebelumnya ada "edit", maka submit ini akan mengarah ke route "update"
                 */
                const url = this.getAttribute('action');

                // ajax update data
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    processData: false,
                    contentType: false,
                    // dataType: "dataType",
                    success: function (response) {
                        // show modified modal
                        modalAction.hide();
                        // reaload datatable
                        window.LaravelDataTables['role-table'].ajax.reload();
                        modules_toastr.notif('Info', response.message, 'success');
                    },
                    error: function (resErr) {
                        // get list field error from json response
                        let listFieldError = resErr.responseJSON?.errors;
                        // reset form
                        $(_form).find('.text-danger.text-small').remove();
                        $(_form).find('.form-control').removeClass('is-invalid');
                        // $(_form).find('.form-control').addClass("is-valid")
                        if (listFieldError) {
                            // looping key object listFieldError
                            for (const [key, value] of Object.entries(listFieldError)) {
                                //   find field element form with object key
                                $(`[name=${key}]`)
                                    .addClass('is-invalid')
                                    .parent()
                                    .append(`<span class="text-danger text-small">${value}</span>`);
                            }
                        }
                    },
                });
            });
        }
        //
    })();
});

// $('#role-table').ready(function() {});

