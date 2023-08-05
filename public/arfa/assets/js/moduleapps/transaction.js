function handleDelete() {
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
                url: `{{ url('konfigurasi/roles') }}/${id}`,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
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
}

const transaction = {
    // init: init(),
    // open modal
    // targetButton = .btn - add;
    // url = {{ url('konfigurasi/roles/create') }}
    // targetForm = #modal-action
    handleAdd: function (targetButton, url, targetForm) {
        $(targetButton).on('click', function () {
            console.log('hallo');
            // ajax
            $.ajax({
                type: 'GET',
                url: url,
                // data: "data",
                // dataType: "dataType",
                success: function (resHtlm) {
                    // set content modal from response
                    $(targetForm).find('.modal-dialog').html(resHtlm);
                    // show modified modal
                    modalAction.show();
                    // prepare for execution update
                    transaction.handleActionSubmit();
                },
                error: function (err) {
                    console.log('[Log On] >> [roles-index.blade] -> [err] : ', err);
                },
            });
        });
    },

    // targetForm = #form-action
    handleActionSubmit: function (targetForm) {
        $(targetForm).on('submit', function (e) {
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
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
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
    },

    // dfas
    handleEdit: function () {
        // ajax get data for edit
        $.ajax({
            type: 'GET',
            url: `{{ url('konfigurasi/roles') }}/${id}/edit`,
            // data: "data",
            // dataType: "dataType",
            success: function (resHtlm) {
                // set content modal from response
                $('#modal-action').find('.modal-dialog').html(resHtlm);
                // show modified modal
                modalAction.show();
                // prepare for execution update
                this.handleActionSubmit();
            },
        });
    },
};

