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

        // ===========>>>>>>>>> ini utuk uncolapse text
        // $('tbody').on('click', 'tr', function () {
        //     // $(this).children('td:eq(1)').text(table.row(this).data()[1]);
        //     let fullSentence = Object.values(table.row(this).data())[1]; // 1 adalah full data. dimbil oleh ellipsis
        //     let debug = table.row(this).data();
        //     console.log(debug);
        //     $(this).children('td:eq(2)').text(fullSentence); // 1 ini adalah target value kolom yang akan di replace
        //     table.cell(this, 2).invalidate('dom');
        // });
        // ===========>>>>>>>>> ini utuk uncolapse text end

        // initial modal
        const modalAction = new bootstrap.Modal($('#modal-action'));

        // ====== button in datatable ======
        $('#tabel').on('click', '.btn-action', function () {
            let data = $(this).data();
            let id = data.id;
            let typeaction = data.typeaction;
            let formUrl = null;

            if (typeaction == 'edit_spt') {
                formUrl = `${url}/spt/${id}/edit`;
            } else if (typeaction == 'edit_pka') {
                formUrl = `${url}/pka/${id}/edit`;
            }

            $.ajax({
                type: 'GET',
                url: formUrl,
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
                    // modalActionOnHide();
                    // prepare for execution save
                    handleSubmit();
                    initialDatePicker();
                    handleDasarTugas();
                },
                error: function (err) {
                    console.log('[Log On] >> [roles-index.blade] -> [err] : ', err);
                },
            });
        });
        // ====== button in datatable ======

        // Smart Wizard
        function smartWizard() {
            // http://techlaboratory.net/projects/demo/jquery-smart-wizard/v6/bootstrap-modal#step-4
            // Step show event
            $('#smartwizard').on(
                'showStep',
                function (e, anchorObject, stepIndex, stepDirection, stepPosition) {
                    // Get step info from Smart Wizard
                    let stepInfo = $('#smartwizard').smartWizard('getStepInfo');
                    let myCurrent = stepInfo.currentStep + 1;
                    $('#sw-current-step').text(myCurrent + 1);
                    $('#sw-total-step').text(stepInfo.totalSteps);
                }
            );

            const sectionSmartWizard = $('#smartwizard');
            sectionSmartWizard.smartWizard({
                selected: 0,
                // autoAdjustHeight: false,
                theme: 'square', // basic, arrows, square, round, dots
                autoAdjustHeight: false, // Automatically adjust content height
                enableUrlHash: false,
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
        // function modalActionOnHide() {
        var myModalEl = document.getElementById('modal-action');
        myModalEl.addEventListener('hidden.bs.modal', function (event) {
            // console.log('modal hilang');
            // set url has to null
            window.location.hash = '';
            reloadTable();
        });
        // }

        // handle button add
        $('.btn-add').on('click', function () {
            console.log('click');
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
                    // modalActionOnHide();
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
                let formTarget = null;
                let formData = null;
                let stepInfo = $('#smartwizard').smartWizard('getStepInfo');
                //

                console.log('step : ', stepInfo);
                if (stepInfo.currentStep == 0) {
                    // masih di step PKA, jadi save ke controller ====PKA====
                    formTarget = document.getElementById('form-pka');
                } else {
                    formTarget = document.getElementById('form-spt');
                    // stepInfo == 1 berarti sudah di step SPT, jadi save ke controller ====SPT====
                }

                // let formSerialize = formTarget.serialize();
                // formData = formTarget.serialize();

                // let formTargetHtml = document.querySelector('');
                const urlForm = formTarget.getAttribute('action');
                formData = new FormData(formTarget);
                onSubmit(formTarget, formData, urlForm, stepInfo);
            });
        }
        // smartWizard forward
        function handleShowNextStep() {
            $('#smartwizard').smartWizard('next');
        }

        function initialDatePicker() {
            $('.date')
                .datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    format: 'dd-mm-yyyy',
                })
                .on('changeDate', function (e) {
                    // console.log(e.target.value);
                });
        }

        function reloadTable() {
            let iteration = 1;
            iteration += 1;
            console.log('iteration reloadTable: ', iteration);
            if (iteration > 1) {
                var t = $('#tabel').DataTable();
                t.ajax.reload();
            }
        }

        // ========================================
        // ajax
        function onSubmit(formTarget, formData, urlForm, stepInfo) {
            $.ajax({
                type: 'POST',
                url: urlForm,
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                processData: false,
                contentType: false,
                // dataType: "dataType",
                success: function (response) {
                    if (stepInfo.currentStep == 0) {
                        let sptId = response?.data[0]?.spt?.id;
                        // replace data togle button simpan dari "Simpan, lanjut ke SPT" menjadi "Simpan SPT"
                        $('#next-btn-modal').attr('data-bs-original-title', 'Simpan SPT');
                        // set hidden textbox in step 2 (form spt)
                        $('#form-spt').attr('action', `${url}/spt/${sptId}`);
                        // $('#form-spt').find('#pka_id').attr('value', sptId);

                        handleShowNextStep();
                        $('#nomorPengajuan').trigger('focus');
                    } else {
                        // show modified modal
                        modalAction.hide();
                        // reaload datatable
                        // window.LaravelDataTables['role-table'].ajax.reload();
                    }
                    modules_toastr.notif('Info', response.message, 'success');
                    // handleShowNextStep();
                },
                error: function (resErr) {
                    modalAction.handleUpdate();
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
            });
        }

        // handle === DASAR TUGAS === <<<START>>> in form edit spt
        function handleDasarTugas() {
            const sptId = $('#form-spt-edit').find('input[name="pka_id"]').val();

            const templateForm = document.getElementById('template_tabel_dasar_pengajuan_form'); // html element
            const templateFormEdit = document.getElementById(
                'template_tabel_dasar_pengajuan_form_edit'
            ); // html element
            const templateRow = document.getElementById(
                'template_tabel_dasar_pengajuan_format_row'
            ); // html element
            const templateButtonAdd = document.getElementById(
                'template_tabel_dasar_pengajuan_button_add'
            ); // html element

            // handle row form edit
            $('#tabel_dasar_pengajuan').on('click', '.table-actions>a', function () {
                let data = $(this).data();
                let id = data.id;
                let typeaction = data.bsOriginalTitle; // "Ubah" || Hapus, kalo pake javascprint data.['data-bs-original-title']

                console.log('data : ', $(this));
                // console.log('typeAction : ', typeaction);

                if (typeaction == 'Ubah') {
                    let row = $(this).parents('tr');
                    let kontenAsli = row.html();
                    let kontenValueText = row.find('td:eq(0)').text();

                    let templateFormEditContent = templateFormEdit.content.cloneNode(true);

                    // set textValue table to textbox
                    templateFormEditContent.querySelector('input#dasar_tugas').value =
                        kontenValueText;

                    // set textValue table to textbox
                    templateFormEditContent.querySelector(
                        'input[name="dasar_tugas_spt_id"]'
                    ).value = id;

                    //replace row dengan template form update
                    row.html(templateFormEditContent);

                    // simpan html row kedalam div dengan class .konten_asli, ini nanti akan di gunakan saat batalUpdate
                    row.find('.konten_asli').html(kontenAsli);

                    handleFormActionUpdate();
                } else if (typeaction == 'Hapus') {
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
                            //    ajax delete
                            deleteDasarTugas(this.dataset['id']);
                        }
                    });
                }
            });

            // handle form add
            function handleButtonAdd() {
                const rowAksi = $('#row_aksi_add');

                $(rowAksi).on('click', 'button', function () {
                    const templateFormContent = templateForm.content.cloneNode(true);

                    $(templateFormContent).find('input[name="dasar_tugas_spt_id"]').val(sptId);
                    $('#tabel_dasar_pengajuan tbody').append(templateFormContent);
                    handleFormAction();

                    $(rowAksi).hide();
                });
            }

            // handle form add (simpan || batal)
            function handleFormAction() {
                const rowAksi = $('#row_aksi_add');
                const btnBatal = $('button[data-aksi="bataltambah"]');
                const btnSimpan = $('button[data-aksi="simpanDasarPengajuan"]');

                $(btnBatal).on('click', function () {
                    $(rowAksi).show();
                    $(this).parents('tr').remove();
                });

                $(btnSimpan).on('click', function () {
                    console.log(url);
                    storeDasarTugas();
                });
            }

            // handel form update (simpan/update || batal update)
            function handleFormActionUpdate() {
                const btnUpdate = 'button[data-aksi="ubahDasarPengajuan"]';
                const btnBatalUpdate = 'button[data-aksi="batalupdate"]';

                $('.dasar_pengajuan_form_edit').on('click', btnUpdate, function () {
                    updateDasarTugas(this);
                });

                $('.dasar_pengajuan_form_edit').on('click', btnBatalUpdate, function () {
                    let rowSelected = $(this).parents('tr');
                    let kontenAsli = rowSelected.find('.konten_asli').html();
                    rowSelected.html(kontenAsli);
                });
            }

            // ajax pengajuan dasar
            function loadDataDasarTugas() {
                // const urlForm = `${url}/spt/dasartugas/${sptId}`;
                const urlForm = `${url}/spt/dasartugas/${sptId}/dasartugas_by_spt`;
                $.ajax({
                    type: 'GET',
                    url: urlForm,
                    // data: "data",
                    // dataType: "dataType",
                    success: function (resData) {
                        let arrDasarTugas = resData.data;
                        let templateButtonAddContten = templateButtonAdd.content.cloneNode(true);

                        let arrDasarTugasPopulate = arrDasarTugas.map(function (item, index) {
                            let templateRowContent = templateRow.content.cloneNode(true);
                            // set text
                            $(templateRowContent).find('td:eq(0)').text(item.dasar_tugas);

                            // set button Ubah dataset id & name using vanila javascipt
                            let btnUbah = templateRowContent.querySelector(
                                'a[data-bs-original-title="Ubah"]'
                            );
                            btnUbah.dataset['id'] = item.id;
                            // btnUbah.dataset['name'] = item.dasar_tugas; // jangan dikasih ini, bikin berat html

                            // set button Hapus dataset id & name using vanila javascipt
                            let btnHapus = templateRowContent.querySelector(
                                'a[data-bs-original-title="Hapus"]'
                            );
                            btnHapus.dataset['id'] = item.id;
                            // btnHapus.dataset['name'] = item.dasar_tugas; // jangan dikasih ini, bikin berat html

                            return templateRowContent;
                        });

                        // kosongkan tabel
                        $('#tabel_dasar_pengajuan tbody').html('');
                        // table inject button add from template
                        $('#tabel_dasar_pengajuan tbody').append(templateButtonAddContten);
                        // table inject data row from template and from database
                        $('#tabel_dasar_pengajuan tbody').prepend(arrDasarTugasPopulate);

                        handleButtonAdd();
                    },
                    error: function (err) {
                        console.log('[Log On] >> [roles-index.blade] -> [err] : ', err);
                    },
                });
            }

            // execute load data
            loadDataDasarTugas();

            function storeDasarTugas() {
                //  dokumen/pkaspt/spt/dasartugas/create
                const formTarget = document.getElementById('dasar_pengajuan_form');
                const formData = new FormData(formTarget);
                console.log('form data on store dasar tugas : ', formData);
                const urlForm = `${url}/spt/dasartugas`;
                $.ajax({
                    type: 'POST',
                    url: urlForm,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    processData: false,
                    contentType: false,
                    // dataType: "dataType",
                    success: function (response) {
                        modules_toastr.notif('Info', response.message, 'success');
                        // disini load data dasar tugas
                        loadDataDasarTugas();
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
                });
            }

            function updateDasarTugas(elmButtonUpdate) {
                const rowSelected = $(elmButtonUpdate).parents('tr')[0];
                const formTarget = rowSelected.querySelector('form.dasar_pengajuan_form_edit'); // using jquery
                const id = formTarget.querySelector('input[name="dasar_tugas_spt_id"]').value;

                const formData = new FormData(formTarget);
                const urlForm = `${url}/spt/dasartugas/${id}`;
                $.ajax({
                    type: 'POST',
                    url: urlForm,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    processData: false,
                    contentType: false,
                    // dataType: "dataType",
                    success: function (response) {
                        modules_toastr.notif('Info', response.message, 'success');
                        // disini load data dasar tugas
                        loadDataDasarTugas();
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
                });
            }

            function deleteDasarTugas(id) {
                // jika confirm yes, jalankan ajax
                $.ajax({
                    type: 'DELETE',
                    url: `${url}/spt/dasartugas/${id}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function (response) {
                        // response berhasil
                        loadDataDasarTugas();
                        if (response.status == 'success') {
                            modules_toastr.notif('Info', response.message, 'success');
                        }
                    },
                    error: function (err) {
                        // console.log('Pesan erron: ,' err)
                    },
                });
            }
        }
        // handle === DASAR TUGAS === <<<END>>> in form edit spt

        // ========== end function
    })();
    // ========== end ready function
});

