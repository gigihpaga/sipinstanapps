$(document).ready(function () {
    (function () {
        const listColums = [
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
            },
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false,
            },
            {
                // data: 'pemohon_spt',
                // name: 'pemohon_spt',
                data: 'user.name',
                name: 'user.name',
                defaultContent: '',
            },
            {
                data: 'sifat_tugas',
                name: 'sifat_tugas',
            },
            {
                data: 'pka',
                name: 'pka',
                orderable: false,
                searchable: false,
            },
            {
                data: 'nomor_pengajuan',
                name: 'nomor_pengajuan',
            },
            {
                data: 'status_buat',
                name: 'status_buat',
            },
            {
                data: 'tanggal_mulai',
                name: 'tanggal_mulai',
            },
            {
                data: 'tanggal_selesai',
                name: 'tanggal_selesai',
            },
            {
                data: 'last_status_history.status',
                name: 'last_status_history.status',
                defaultContent: 'tidak ada',
            },
            // {
            //     data: 'keperluan_tugas',
            //     name: 'keperluan_tugas',
            // },
            {
                data: 'keterangan_tugas',
                name: 'keterangan_tugas',
            },
            {
                data: 'note',
                name: 'note',
            },
        ];
        const renderPillLastStatusSpt = {
            targets: -3, // kolom status spt (2 dari kiri)
            render: function (data, type, row) {
                let lastStatusSpt = row?.last_status_history?.status;
                let displayPil = '';
                if (!lastStatusSpt || lastStatusSpt === null) {
                    return '';
                }
                // (1: created, 2: revision 3: updated 4: verified 5: rejected 6: approved)
                switch (lastStatusSpt) {
                    case '1':
                        displayPil =
                            '<span class="badge rounded-pill bg-light text-dark">created</span>';
                        break;
                    case '2':
                        displayPil =
                            '<span class="badge rounded-pill bg-warning text-dark">revision</span>';
                        break;
                    case '3':
                        displayPil =
                            '<span class="badge rounded-pill bg-info text-dark">updated</span>';
                        break;
                    case '4':
                        displayPil =
                            '<span style="background-color:#9a43ff;" class="badge rounded-pill ">verified</span>';
                        break;
                    case '5':
                        displayPil = '<span class="badge rounded-pill bg-danger">rejected</span>';
                        break;
                    case '6':
                        displayPil = '<span class="badge rounded-pill bg-success">approved</span>';
                        break;
                    default:
                    // code block
                }

                return displayPil;
            },
        };
        const renderPillStatusBuat = {
            targets: 6, // kolom statusbuat (6 dari kanan)
            render: function (data, type, row) {
                if (!row.status_buat) {
                    return '';
                }

                if (row.status_buat == 0) {
                    return '<span style="background-color:#fed9ff;" class="badge rounded-pill text-dark"><i style="color:#ea5455;" class="ti-pencil-alt2"></i>&nbspBelum selesai</span>';
                }
                return '<span style="background-color:#d8ffdc;" class="badge rounded-pill text-dark"><i style="color:#28c76f;" class="ti-check-box"></i>&nbspSelesai</span>';
            },
        };
        const oldUrl = window.location.href;
        const url = oldUrl.split('#')[0]; //get url without hash

        var table = $('#tabel').DataTable({
            scrollCollapse: true,
            processing: true,
            serverSide: true,
            scrollX: true,
            // autoWidth: true,
            language: {
                processing:
                    '<div class="spinner-border" style="width: 20px; height: 20px;" role="status"><span class="visually-hidden">Loading...</span></div>',
            },
            ajax: {
                // url: "{{ route('pkaspt.loadData') }}",
                url: `${url}/loadData`,
                type: 'GET',
            },
            columnDefs: [
                //
                {
                    targets: 2,
                    render: function (data, type, row) {
                        if (type === 'display') {
                            renderedData = $.fn.dataTable.render.ellipsis(15)(data, type, row);
                            return renderedData;
                        }
                        return data;
                    },
                },
                { className: 'dt-nowrap text-capitalize', targets: [2, 3, 5, 7, 8, 9, -2, -1] },
                // pill status buat spt
                renderPillStatusBuat,
                // pill status spt approval
                renderPillLastStatusSpt,
            ],
            order: [[2, 'asc']],
            columns: listColums,
        });

        // ini utuk uncolapse text
        // $('tbody').on('click', 'tr', function () {
        //     // $(this).children('td:eq(1)').text(table.row(this).data()[1]);
        //     let fullSentence = Object.values(table.row(this).data())[1]; // 1 adalah full data. dimbil oleh ellipsis
        //     let debug = table.row(this).data();
        //     console.log('debug :', debug);
        //     $(this).children('td:eq(2)').text(fullSentence); // 1 ini adalah target value kolom yang akan di replace
        //     table.cell(this, 2).invalidate('dom');
        // });
        // ini utuk uncolapse text end

        // initial modal
        const modalAction = new bootstrap.Modal($('#modal-action'));

        // Smart Wizard
        function smartWizard() {
            const sectionSmartWizard = $('#smartwizard');
            sectionSmartWizard.smartWizard({
                selected: 0,
                // autoAdjustHeight: false,
                theme: 'square', // basic, arrows, square, round, dots
                autoAdjustHeight: false, // Automatically adjust content height
                transition: {
                    animation: 'none',
                },
                toolbar: {
                    showNextButton: false, // show/hide a Next button
                    showPreviousButton: false, // show/hide a Previous button
                    position: 'none', // none/ top/ both bottom
                },
                anchor: {
                    enableNavigation: true, // Enable/Disable anchor navigation
                    enableNavigationAlways: false, // Activates all anchors clickable always
                    enableDoneState: true, // Add done state on visited steps
                    markPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                    unDoneOnBackNavigation: false, // While navigate back, done state will be cleared
                    enableDoneStateNavigation: true, // Enable/Disable the done state navigation
                },
                disabledSteps: [], // Array Steps disabled
                errorSteps: [], // Highlight step with errors
                hiddenSteps: [],
            });
            console.log(sectionSmartWizard);
            let f = $('#form-action');
            console.log(f);
        }

        // tracking modal on hide
        function modalActionOnHide() {
            var myModalEl = document.getElementById('modal-action');
            myModalEl.addEventListener('hidden.bs.modal', function (event) {
                // console.log('modal hilang');
                // set url has to null
                window.location.hash = '';
            });
        }

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

                    // smart wizard
                    smartWizard();
                    // initial modalActionOnHide
                    modalActionOnHide();
                    // prepare for execution save
                    handleSubmit();
                    initialDatePicker();
                },
                error: function (err) {
                    console.log('[Log On] >> [roles-index.blade] -> [err] : ', err);
                },
            });
        });

        // handle button save on form action
        function handleSubmit() {
            $('#next-btn-modal').on('click', function (e) {
                e.preventDefault();
                // let formTarget = null;
                // let formData = null;
                // let urlForm = null;
                let stepInfo = $('#smartwizard').smartWizard('getStepInfo');
                //

                console.log('step : ', stepInfo);
                if (stepInfo.currentStep == 0) {
                    // stepInfo == 1 berarti sudah di step PKA, jadi save ke controller ====PKA====
                    let formTargetPka = document.getElementById('form-pka');
                    let formDataPka = new FormData(formTargetPka);
                    let urlFormPka = formTargetPka.getAttribute('action');
                    onSubmit(formTargetPka, formDataPka, urlFormPka, stepInfo);
                    for (const pair of formDataPka.entries()) {
                        console.log(`${pair[0]}: ${pair[1]}`);
                    }
                } else {
                    // stepInfo == 1 berarti sudah di step SPT, jadi save ke controller ====SPT====
                    let formTargetSpt = document.getElementById('form-spt');
                    let formDataSpt = new FormData(formTargetSpt);
                    let urlFormSpt = formTargetSpt.getAttribute('action');
                    onSubmitSpt(formTargetSpt, formDataSpt, urlFormSpt);
                    for (const pair of formDataSpt.entries()) {
                        console.log(`${pair[0]}: ${pair[1]}`);
                    }
                }
                // let formSerialize = formTarget.serialize();
                // formData = formTarget.serialize();
                // let formTargetHtml = document.querySelector('');

                // formTarget = null;
                // formData = null;
                // urlForm = null;
            });
        }

        // $('#modal-action').on('click', '#next-btn-modal', function () {
        //     console.log('s');
        // });

        // smartWizard forward
        function handleShowNextStep() {
            $('#smartwizard').smartWizard('next');
        }

        function initialDatePicker() {
            $(function () {
                $('.date')
                    .datepicker('setvalue', new Date())
                    .datepicker({
                        autoclose: true,
                        todayHighlight: true,
                        format: 'dd-mm-yyyy',
                    })
                    .on('changeDate', function (e) {
                        // console.log(e.target.value);
                    });
            });
        }

        function onSubmit(formTarget, formData, urlForm, stepInfo) {
            $.ajax({
                type: stepInfo.currentStep == 0 ? 'POST' : 'PATCH',
                url: urlForm,
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                processData: false,
                contentType: false,
                dataType: 'JSON',
                success: function (response) {
                    if (stepInfo.currentStep == 0) {
                        let sptId = response?.data[0]?.spt?.id;
                        // replace data togle button simpan dari "Simpan, lanjut ke SPT" menjadi "Simpan SPT"
                        $('#next-btn-modal').attr('data-bs-original-title', 'Simpan SPT');
                        // set hidden textbox in step 2 (form spt)
                        $('#form-spt').attr('action', `${url}/spt/${sptId}`);
                        $('#form-spt').find('#pka_id').attr('value', sptId);

                        handleShowNextStep();
                    } else if (stepInfo.currentStep == 1) {
                        // show modified modal
                        modalAction.hide();
                        // reaload datatable
                        // window.LaravelDataTables['role-table'].ajax.reload();
                        reloadTable();
                    }
                    modules_toastr.notif('Info', response.message, 'success');
                },
                error: function (resErr) {
                    // get list field error from json response
                    let listFieldError = resErr.responseJSON?.errors;
                    // reset form
                    $(formTarget).find('.text-danger.text-small').remove();
                    $(formTarget).find('.form-control').removeClass('is-invalid');
                    // $(formTarget).find('.form-control').addClass("is-valid")
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
            })
                .done(function (data) {
                    alert(JSON.stringify(data));
                })
                .fail(function (jqXHR, textStatus) {
                    console.log(jqXHR);
                    console.log(textStatus);
                });
        }
        function onSubmitSpt(formTarget, formData, urlForm) {
            $.ajax({
                type: 'PUT',
                url: urlForm,
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                processData: false,
                contentType: false,
                success: function (response) {
                    reloadTable();
                    modalAction.hide();
                    modules_toastr.notif('Info', response.message, 'success');
                },
                error: function (resErr) {
                    // get list field error from json response
                    let listFieldError = resErr.responseJSON?.errors;
                    // reset form
                    $(formTarget).find('.text-danger.text-small').remove();
                    $(formTarget).find('.form-control').removeClass('is-invalid');
                    // $(formTarget).find('.form-control').addClass("is-valid")
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
            })
                .done(function (data) {
                    alert(JSON.stringify(data));
                })
                .fail(function (jqXHR, textStatus) {
                    console.log(jqXHR);
                    console.log(textStatus);
                });
        }

        function reloadTable() {
            var t = $('#tabel').DataTable();
            t.ajax.reload();
        }

        // ===handle button on data table =======================================================
        // handle button edit
        $('#tabel').on('click', '.btn-action', function () {
            let data = $(this).data();
            let id = data.id;
            let typeaction = data.typeaction;
            //
            if (typeaction == 'edit-spt') {
                console.log('btn-edit');
                // ajax get data for edit
                $.ajax({
                    type: 'GET',
                    url: `${url}/spt/${id}/edit`,
                    // data: "data",
                    // dataType: "dataType",
                    success: function (resHtlm) {
                        // set content modal from response
                        $('#modal-action').find('.modal-dialog').html(resHtlm);
                        // show modified modal
                        modalAction.show();
                        // prepare for execution update
                        $('#save-spt').on('click', function (e) {
                            // let formTargetSpt = document.getElementById('form-spt');
                            // let formTargetSpt = $('#form-spt-edit');
                            // formTargetSpt.submit();
                            let formTarget = $('#form-spt-edit');
                            onFormSptSubmit(formTarget);
                            // onFormSptSubmit();
                            // console.log('ini satu', formTargetSpt);
                            // let formDataSpt = new FormData(formTargetSpt);
                            // let urlFormSpt = formTargetSpt.getAttribute('action');
                            // onSubmitSpt(formTargetSpt, formDataSpt, urlFormSpt);
                        });
                    },
                    error: function (resErr) {
                        // get list field error from json response
                        let listFieldError = resErr.responseJSON?.errors;
                        // reset form
                        $('#form-spt').find('.text-danger.text-small').remove();
                        $('#form-spt').find('.form-control').removeClass('is-invalid');
                        // $(formTarget).find('.form-control').addClass("is-valid")
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
            }
        });
        // ===handle button on data table =======================================================

        // ===on form submit++++++++++++++++++++++++++++++++++++
        function onFormSptSubmit(formTarget) {
            // const _form = formTargetSpt;
            // // grab data in form modal
            // const formData = new FormData(_form[0]);
            // console.log(formData);
            // for (const pair of formData.entries()) {
            //     console.log(`${pair[0]}: ${pair[1]}`);
            // }

            /**
             * get url/route in form (dynamic route sesuai dengan request sebelumnyan)
             * jika request sebelumnya ada "create", maka submit ini akan mengarah ke route "store"
             * jika request sebelumnya ada "edit", maka submit ini akan mengarah ke route "update"
             */
            // const url = _form.attr('action');
            // const url = $('#form-spt-edit').attr('action');
            // console.log($('#form-spt-edit').serialize());

            const _form = formTarget[0];
            const formData = new FormData(_form);
            const url = _form.getAttribute('action');

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
                    $('#form-spt-edit').find('.text-danger.text-small').remove();
                    $('#form-spt-edit').find('.form-control').removeClass('is-invalid');
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
        }

        // ===on form submit++++++++++++++++++++++++++++++++++++

        // ========== end function
    })();
    // ========== end ready function
});

