$(document).ready(function () {
    (function () {
        elementUIServerside.buttonCustomJQuery();

        const oldUrl = window.location.href;
        const url = oldUrl.split('#')[0]; //get url without hash

        // initial modal
        const modalAction = new bootstrap.Modal($('#modal-action'));

        // data pegawai
        let dataPegawai = []; // can be set from function loadDataPegawai()
        const dataJabatanPenugasan = [
            { id: '1', nama: 'Penanggung Jawab' },
            { id: '2', nama: 'Pengawas' },
            { id: '3', nama: 'Ketua Tim' },
            { id: '4', nama: 'Anggota' },
        ];

        const myModalEl = document.getElementById('modal-action');
        // tracking modal on hide
        myModalEl.addEventListener('hidden.bs.modal', function (event) {
            // console.log('modal hilang');
            // set url has to null
            window.location.hash = '';
            reloadTable();
        });

        function initialDatePicker() {
            $('.date')
                .datepicker({
                    // setDate: new Date(), // '19-08-2023',
                    todayBtn: true,
                    autoclose: true,
                    todayHighlight: true,
                    format: 'dd-mm-yyyy',
                })
                .on('changeDate', function (e) {
                    // console.log(e.target.value);
                });
        }

        // datatable
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

        // generate random string with datenow
        function generateRandomString() {
            return Math.floor(Math.random() * Date.now()).toString(36);
        }

        // format from dd-mm-yyyy to yyyy-mm-dd
        function dateFormatIndoToGlobal(htmlForm, stringTarget) {
            /** change format from dd-mm-yyyy to yyyy-mm-dd
             * example :
             * let formTarget = document.getElementById('form-spt-edit');
             * dateFormatIndoToGlobal(formTarget, 'input#tanggalmulaispt')
             */
            try {
                let tanggal = $(htmlForm)
                    .find(stringTarget)
                    .datepicker('option', 'dateFormat', 'dd-mm-yyyy');

                let tanggalArray = tanggal.val().split('-');
                let date = tanggalArray[0];
                let month = tanggalArray[1];
                let year = tanggalArray[2];

                tanggal = moment(`${year}-${month}-${date}`).format('YYYY-MM-DD');
                return tanggal;
            } catch (error) {
                console.log('error', error);
                return 'Invalid Date';
            }
        }

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
                    let modRes = $('#modal-action').find('.modal-dialog').html(resHtlm);

                    if (typeaction == 'edit_spt') {
                        // get tanggalMulaiSpt
                        let tanggalMulaiSpt = modRes.find('input#tanggalmulaispt').val();
                        // get tanggalSelesaiSpt
                        let tanggalSelesaiSpt = modRes.find('input#tanggalselesaispt').val();
                        // formatdate tanggalMulaiSpt yyyy-mm-dd to dd-mm-yyyy
                        modRes
                            .find('input#tanggalmulaispt')
                            .val(
                                tanggalMulaiSpt ? moment(tanggalMulaiSpt).format('DD-MM-YYYY') : ''
                            );
                        // formatdate tanggalSelesaiSpt yyyy-mm-dd to dd-mm-yyyy
                        modRes
                            .find('input#tanggalselesaispt')
                            .val(
                                tanggalSelesaiSpt
                                    ? moment(tanggalSelesaiSpt).format('DD-MM-YYYY')
                                    : ''
                            );
                    } else if (typeaction == 'edit_pka') {
                        // get tanggalMulaiPka
                        let tanggalMulaiPka = modRes.find('input#tanggalmulaipka').val();
                        // get tanggalSelesaiPka
                        let tanggalSelesaiPka = modRes.find('input#tanggalselesaipka').val();
                        // formatdate tanggalMulaiPka yyyy-mm-dd to dd-mm-yyyy
                        modRes
                            .find('input#tanggalmulaipka')
                            .val(
                                tanggalMulaiPka ? moment(tanggalMulaiPka).format('DD-MM-YYYY') : ''
                            );
                        // formatdate tanggalSelesaiPka yyyy-mm-dd to dd-mm-yyyy
                        modRes
                            .find('input#tanggalselesaipka')
                            .val(
                                tanggalSelesaiPka
                                    ? moment(tanggalSelesaiPka).format('DD-MM-YYYY')
                                    : ''
                            );
                    }
                    // show modified modal
                    modalAction.show();
                    // initial datePicker
                    initialDatePicker();
                    // prepare for execution save
                    if (typeaction == 'edit_spt') {
                        handleUpdateSpt();
                        handleDasarTugas();
                        handleAnggota();
                    } else if (typeaction == 'edit_pka') {
                    }
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
            // console.log('sectionSmartWizard : ', sectionSmartWizard);
            // let f_action = $('#form-action');
            // console.log('f_action : ', f_action);
        }

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

        function reloadTable() {
            let iteration = 1;
            iteration += 1;
            // console.log('iteration reloadTable: ', iteration);
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

        function onUpdate(targetForm, formData, elmButton) {
            const formTarget = targetForm;
            const urlForm = formTarget.getAttribute('action');
            elmButton.button('loading');

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
                    modalAction.hide();
                },
                error: function (resErr) {
                    // get list field error from json response
                    let listFieldError = resErr.responseJSON?.errors;
                    // reset form
                    elmButton.button('reset');
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
            }).done(function (data) {
                elmButton.button('reset');
            });
        }

        function handleUpdateSpt() {
            $('#update-spt').on('click', function (e) {
                let formTarget = document.getElementById('form-spt-edit');
                let formData = new FormData(formTarget);
                let elmButton = $(this);
                // send ajax
                onUpdate(formTarget, formData, elmButton);
            });
        }

        function loadDataPegawai() {
            const urlForm = `${window.location.origin}/master/pegawai/loadData`;
            // console.log('urlForm : ', urlForm);
            $.ajax({
                type: 'GET',
                url: urlForm,
                // data: "data",
                // dataType: "dataType",
                success: function (resData) {
                    dataPegawai = resData.data;
                },
                error: function (err) {
                    console.log('[Log On] >> [roles-index.blade] -> [err] : ', err);
                    dataPegawai = [];
                },
            });
        }

        loadDataPegawai();

        // handle === DASAR TUGAS === <<<START>>> in form edit spt
        function handleDasarTugas() {
            const sptId = $('#form-spt-edit').data('sptid');

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

        // handle === Anggota === <<<START>>> in form edit spt
        function handleAnggota() {
            const sptId = $('#form-spt-edit').data('sptid');
            const templateRowAnggota = document.getElementById('template_tabel_anggota_format_row'); // html element

            const templateButtonAddAnggota = document.getElementById(
                'template_tabel_anggota_button_add'
            ); // html element

            // form Add
            const templateFormAddAnggota = document.getElementById(
                'template_tabel_anggota_form_add'
            ); // html element
            const templateFormAddAnggotaInput = document.getElementById(
                'template_tabel_anggota_form_add_input'
            ); // html element

            // form Edit
            const templateFormEditAnggota = document.getElementById(
                'template_tabel_anggota_form_edit'
            ); // html element
            const templateFormEditAnggotaInput = document.getElementById(
                'template_tabel_anggota_form_edit_input'
            ); // html element

            // console.log('respon ajax data pegawai : ', dataPegawai);

            // handle row form edit
            $('#tabel_anggota').on('click', '.table-actions > a', function () {
                let elmButton = $(this);
                let dataSet = elmButton.data();
                elmTooltip.remove();

                // "Ubah" || Hapus, kalo pake javascprint data.['data-bs-original-title']
                if (dataSet.bsOriginalTitle == 'Ubah') {
                    let trModeEdit = elmButton.closest('tbody').find('tr.input-row');
                    // close
                    trModeEdit.find('button[data-aksi="batalUpdateAnggota"]').trigger('click');

                    handleFormActionEditAnggota(elmButton);
                } else if (dataSet.bsOriginalTitle == 'Hapus') {
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
                            // ajax delete
                            deleteAnggota(this.dataset['idanggota'], elmButton);
                        } else {
                        }
                    });
                }
            });

            function combobox(allowClear = false) {
                $('.cmb_select2').css('width', '100%');
                $('.cmb_select2').select2({
                    placeholder: 'Pilih salah satu',
                    allowClear: allowClear,
                    theme: 'bootstrap-5',
                    dropdownParent: $('#modal-action'),
                });
            }

            function createSelectOptionCombox(data) {
                var map = data.map(function (elem, index) {
                    return '<option value="' + elem.id + '">' + elem.nama + '</option>';
                });
                return map.join('');
            }

            function createFormEditUsingTemplate(dataSetButtonSelected) {
                // initial form Edit ready to manipulate, will be added in the top table
                let templateFormEditAnggotaContent =
                    templateFormEditAnggota.content.cloneNode(true);

                // ========= Form Edit from template Manipulate =========
                let formEdit = templateFormEditAnggotaContent.querySelector('form');
                let attributeIdFormAdd = formEdit.getAttribute('id');
                formEdit.dataset['idform'] = dataSetButtonSelected['idtargetform'];

                // search form Edit with id form in document html
                const table = document.querySelector('table#tabel_anggota');
                let formEditOnDocHTML = table.querySelector(
                    `table#tabel_anggota > form#${attributeIdFormAdd}`
                );
                // check form Edit is initial on document ?
                if (!formEditOnDocHTML) {
                    // if not initial, add element form Edit in table document html
                    table.prepend(templateFormEditAnggotaContent);
                } else {
                    // if initial, just replace new dataset idform
                    formEditOnDocHTML.dataset['idform'] = dataSetButtonSelected['idtargetform'];
                }
                // ========= Form Edit from template Manipulate =========

                // w x z p w x z p w x z p w x z p w x z p w x z p w x z p w x z p w x z p w x z p w x z p w x z p w x z p w x z p w x z p w x z p

                // initial form Edit input ready to manipulate, will be added in the item row in the table (tbody)
                let templateFormEditAnggotaInputContent =
                    templateFormEditAnggotaInput.content.cloneNode(true);

                // ========= Form Edit input from template Manipulate =========
                let buttonOnUpdate = templateFormEditAnggotaInputContent.querySelector(
                    'button[data-aksi="updateAnggota"]'
                );
                let buttonCancelUpdate = templateFormEditAnggotaInputContent.querySelector(
                    'button[data-aksi="batalUpdateAnggota"]'
                );

                buttonOnUpdate.dataset['idtargetform'] = dataSetButtonSelected['idtargetform'];
                buttonCancelUpdate.dataset['idtargetform'] = dataSetButtonSelected['idtargetform'];

                $(templateFormEditAnggotaInputContent)
                    .find('select[name="pegawai_id"]')
                    .html('<option></option>' + createSelectOptionCombox(dataPegawai))
                    .val(dataSetButtonSelected['idpegawai'])
                    .trigger('change');

                $(templateFormEditAnggotaInputContent)
                    .find('select[name="jabatan_penugasan"]')
                    .html('<option></option>' + createSelectOptionCombox(dataJabatanPenugasan))
                    .val(dataSetButtonSelected['jabatanpenugasan'])
                    .trigger('change');

                $(templateFormEditAnggotaInputContent)
                    .find('input[name="lama_tugas"]')
                    .val(dataSetButtonSelected['lamatugas']);

                $(templateFormEditAnggotaInputContent)
                    .find('input[name="anggota_id"]')
                    .val(dataSetButtonSelected['idanggota']);
                // ========= Form Edit input from template Manipulate =========

                return templateFormEditAnggotaInputContent;
            }

            function createTableLoading() {
                const templateTableLoading = document.getElementById('template_tabel_loading'); // html element
                let templateTableLoadingContent = templateTableLoading.content.cloneNode(true);
                let trLoading = $(templateTableLoadingContent).find('.tr-loading');
                let tableLoading = $(templateTableLoadingContent).find('.table-loading-overlay');

                return {
                    trLoading,
                    tableLoading,
                };
            }

            function handleFormActionEditAnggota(elmButton) {
                let dataSetButtonSelected = elmButton.data();
                let rowSelected = elmButton.parents('tr');
                let kontenAsli = rowSelected.html();

                let htmlFormEdit = createFormEditUsingTemplate(dataSetButtonSelected);
                //replace rowSelected dengan template form update
                rowSelected.html(htmlFormEdit);

                // trigger select2
                combobox();

                if (!rowSelected.hasClass('input-row')) {
                    rowSelected.attr('class', 'input-row');
                }

                // simpan html rowSelected kedalam div dengan class .konten_asli, ini nanti akan di gunakan saat batalUpdate
                rowSelected.find('.konten_asli').html(kontenAsli);

                handleFormActionUpdateAnggota(dataSetButtonSelected['idtargetform']);
            }

            // handel form update (simpan/update || batal update)
            function handleFormActionUpdateAnggota(targetIdForm) {
                const btnUpdate = 'button[data-aksi="updateAnggota"]';
                const btnBatalUpdate = 'button[data-aksi="batalUpdateAnggota"]';

                $(btnUpdate).on('click', function () {
                    // let tr_input_row = this.parentElement.parentElement; // tr.input-row
                    // let elmHasName = tr_input_row.querySelectorAll('td.input-td [name]');
                    // const a = 'td.input-td [name]';
                    // let elmHasNameAttr = this.parentElement.parentElement.querySelectorAll(a);
                    //  for (let elm of elmHasNameAttr) {
                    //      console.log(`${elm.name} : ${elm.value}`);
                    //  }

                    // using jquery
                    let elmButton = $(this);
                    let elmForm = elmButton
                        .closest('table')
                        .find(`form[data-idform="${targetIdForm}"]`)[0];
                    let formData = new FormData(elmForm);

                    let elmHasNameAttr = $(this).parents('tr').find('[name]');

                    elmHasNameAttr.each(function (index, el) {
                        formData.append(el.name, el.value);
                    });
                    // for (const pair of formData.entries()) {
                    //     console.log(`${pair[0]}, ${pair[1]}`);
                    // }
                    updateAnggota(formData, targetIdForm, elmButton);
                });

                $(btnBatalUpdate).on('click', function () {
                    $(this).closest('table').find(`form[data-idform="${targetIdForm}"]`).remove();
                    let rowSelectedOnBatalUpdate = $(this).parents('tr.input-row');
                    if (rowSelectedOnBatalUpdate.hasClass('input-row')) {
                        rowSelectedOnBatalUpdate.removeAttr('class');
                    }
                    let kontenAsli = rowSelectedOnBatalUpdate.find('.konten_asli').html();
                    rowSelectedOnBatalUpdate.html(kontenAsli);

                    elmTooltip.store();
                });
            }

            // handle form add (simpan || batal)
            function handleFormActionAddAnggota(targetIdForm) {
                const rowAksi = $('#row_aksi_add_anggota');
                const btnBatalSimpan = $('button[data-aksi="batalTambahAnggota"]');
                const btnSimpan = $('button[data-aksi="simpanTambahAnggota"]');

                $(btnBatalSimpan).on('click', function () {
                    $(rowAksi).show();
                    $(this).closest('table').find(`form[data-idform="${targetIdForm}"]`).remove();
                    $(this).parents('tr').remove();
                });

                $(btnSimpan).on('click', function () {
                    let elmButton = $(this);
                    let elmForm = elmButton
                        .closest('table')
                        .find(`form[data-idform="${targetIdForm}"]`)[0];

                    let formData = new FormData(elmForm);

                    let elmRowTable = $(this).parents('tr');
                    let elmHasNameAttr = elmRowTable.find('[name]');

                    elmHasNameAttr.each(function (index, el) {
                        formData.append(el.name, el.value);
                    });

                    storeAnggota(formData, targetIdForm, elmRowTable, elmButton);
                });
            }

            // handle form add
            function handleButtonAddAnggota() {
                const rowAksiAnggota = $('#row_aksi_add_anggota');

                $(rowAksiAnggota).on('click', 'button', function () {
                    let table = $(this).closest('table');
                    let tableBody = table.find('tbody');
                    let rowCount = tableBody.find('tr:last').index() + 2;
                    let randomIdForm = generateRandomString();

                    // initial form add ready to manipulate, will be added in the top table
                    const templateFormAddAnggotaContent =
                        templateFormAddAnggota.content.cloneNode(true);

                    // initial form add input ready to manipulate, will be added in the item row in the table (tbody)
                    const templateFormAddAnggotaInputContent =
                        templateFormAddAnggotaInput.content.cloneNode(true);

                    // ========= Form Add from template Manipulate =========
                    let formAdd = templateFormAddAnggotaContent.querySelector('form');
                    let attributeIdFormAdd = formAdd.getAttribute('id');
                    formAdd.dataset['idform'] = randomIdForm;

                    // search form add with id form in document html
                    let formAddOnDocumentHTML = table[0].querySelector(
                        `table#tabel_anggota > form#${attributeIdFormAdd}`
                    );
                    // check form add is initial on document ?
                    if (!formAddOnDocumentHTML) {
                        // if not initial, add element form add in table document html
                        table.prepend(templateFormAddAnggotaContent);
                    } else {
                        // if initial, just replace new dataset idform
                        formAddOnDocumentHTML.dataset['idform'] = randomIdForm;
                    }
                    // ========= Form Add from template Manipulate =========

                    // ========= Form Add input from template Manipulate =========
                    templateFormAddAnggotaInputContent.querySelector('tr').dataset['row'] =
                        rowCount;
                    $(templateFormAddAnggotaInputContent)
                        .find('select#pegawai_id')
                        .html('<option></option>' + createSelectOptionCombox(dataPegawai));
                    $(templateFormAddAnggotaInputContent)
                        .find('select#jabatan_penugasan')
                        .html('<option></option>' + createSelectOptionCombox(dataJabatanPenugasan));
                    // set input hidden value = sptId
                    $(templateFormAddAnggotaInputContent)
                        .find('input[name="sptid_byanggota"]')
                        .val(sptId);
                    // ========= Form Add input from template Manipulate =========

                    // show form add anggota at row table
                    tableBody.append(templateFormAddAnggotaInputContent);
                    // this button add hide
                    $(rowAksiAnggota).hide();
                    // load ui select 2
                    combobox();
                    // initial handle form add (simpan || batal)
                    handleFormActionAddAnggota(randomIdForm);
                });
            }

            // ajax anggota
            function loadDataAnggota() {
                const urlForm = `${url}/spt/${sptId}/anggota/anggota_by_spt`;
                const _MINHEIGHTLOADING = 175;
                const tableAnggota = $('#tabel_anggota');
                const tBody = tableAnggota.find('tbody');
                let tableLoadingOnDocument = tableAnggota.find('.table-loading-overlay');

                if (tBody.height() == 0) {
                    tBody.append(createTableLoading().trLoading);
                }

                if (tableLoadingOnDocument.length == 0) {
                    let tabLoad = createTableLoading().tableLoading;
                    tableAnggota.css('position', 'relative');
                    tabLoad.css(
                        'min-height',
                        tableAnggota.height() > 0 ? '100%' : _MINHEIGHTLOADING
                    );
                    tableAnggota.append(tabLoad);
                } else {
                    tableAnggota
                        .find('.table-loading-overlay')
                        .css('min-height', tableAnggota.height() > 0 ? '100%' : _MINHEIGHTLOADING);
                    tableAnggota.find('.table-loading-overlay').show();
                }
                // ===================================================================================
                $.ajax({
                    type: 'GET',
                    url: urlForm,
                    // data: "data",
                    // dataType: "dataType",
                    success: function (resData) {
                        let arrAnggota = resData.data;
                        // console.log('loadDataAnggota : ', arrAnggota);
                        let templateButtonAddAnggotaContent =
                            templateButtonAddAnggota.content.cloneNode(true);

                        let arrAnggotaPopulate = arrAnggota.map(function (item, index) {
                            // console.log('lopp row', index);
                            let templateRowAnggotaContent =
                                templateRowAnggota.content.cloneNode(true);

                            let randomIdtargetform = generateRandomString();

                            // $(templateRowAnggotaContent).find('tr').data('row', index);
                            templateRowAnggotaContent.querySelector('tr').dataset['row'] =
                                index + 1;

                            // set text nama
                            $(templateRowAnggotaContent).find('td:eq(0)').text(item?.pegawai?.nama);

                            // set text jabatan
                            let found = dataJabatanPenugasan.find(
                                (itemJabatan) => itemJabatan.id == item.jabatan_penugasan
                            );
                            $(templateRowAnggotaContent).find('td:eq(1)').text(found.nama);

                            // set text lama tugas
                            $(templateRowAnggotaContent).find('td:eq(2)').text(item.lama_tugas);

                            // set button Ubah dataset id & name using vanila javascipt
                            let btnUbah = templateRowAnggotaContent.querySelector(
                                'a[data-bs-original-title="Ubah"]'
                            );
                            btnUbah.dataset['idanggota'] = item.id;
                            btnUbah.dataset['idpegawai'] = item.pegawai_id;
                            btnUbah.dataset['jabatanpenugasan'] = item.jabatan_penugasan;
                            btnUbah.dataset['lamatugas'] = item.lama_tugas;
                            btnUbah.dataset['idtargetform'] = randomIdtargetform;
                            // btnUbah.dataset['name'] = item.dasar_tugas; // jangan dikasih ini, bikin berat html

                            // set button Hapus dataset id & name using vanila javascipt
                            let btnHapus = templateRowAnggotaContent.querySelector(
                                'a[data-bs-original-title="Hapus"]'
                            );
                            btnHapus.dataset['idanggota'] = item.id;
                            btnHapus.dataset['idpegawai'] = item.pegawai_id;
                            btnHapus.dataset['jabatanpenugasan'] = item.jabatan_penugasan;
                            btnHapus.dataset['lamatugas'] = item.lama_tugas;
                            btnHapus.dataset['idtargetform'] = randomIdtargetform;
                            // btnHapus.dataset['name'] = item.dasar_tugas; // jangan dikasih ini, bikin berat html

                            return templateRowAnggotaContent;
                        });

                        tableAnggota.find('.table-loading-overlay').fadeOut(400, function () {
                            // kosongkan tabel body
                            $('#tabel_anggota tbody').html('');
                            // table inject data row from template and from database
                            $('#tabel_anggota tbody').prepend(arrAnggotaPopulate);
                            // kosongkan tabel tfoot
                            $('#tabel_anggota tfoot').html('');
                            // table inject button add from template
                            $('#tabel_anggota tfoot').append(templateButtonAddAnggotaContent);
                            // combobox();
                            handleButtonAddAnggota();

                            elmTooltip.store();
                        });
                    },
                    error: function (err) {
                        console.log('[Log On] >> [roles-index.blade] -> [err] : ', err);
                    },
                });
            }
            // execute load data
            loadDataAnggota();

            // ajax store anggota
            function storeAnggota(formData, targetIdForm, elmRowTable, elmButton) {
                //  dokumen/pkaspt/spt/dasartugas/create
                // const formTarget = document.getElementById('anggota_form_add');
                // const formData = new FormData(formTarget);
                // for (const pair of formData.entries()) {
                //     console.log(`${pair[0]}: ${pair[1]}`);
                // }
                // console.log('form data on store anggota : ', formData);
                elmButton.button('loading');
                const urlForm = `${url}/spt/anggota`;
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

                        // remove temporary form
                        document.querySelector(`form[data-idform="${targetIdForm}"]`).remove();

                        // disini load data anggota
                        loadDataAnggota();
                    },
                    error: function (resErr) {
                        // get list field error from json response
                        let listFieldError = resErr.responseJSON?.errors;
                        // reset form
                        elmButton.button('reset');
                        $(elmRowTable).find('.text-danger.text-small').remove();
                        $(elmRowTable).find('.form-control').removeClass('is-invalid');
                        // $(formTarget).find('.form-control').addClass("is-valid")
                        if (listFieldError) {
                            // looping key object listFieldError
                            for (const [key, value] of Object.entries(listFieldError)) {
                                //   find field element form with object key
                                elmRowTable
                                    .find(`[name=${key}]`)
                                    .addClass('is-invalid')
                                    .parent()
                                    .append(`<span class="text-danger text-small">${value}</span>`);
                            }
                        }
                    },
                }).done(function (data) {
                    elmButton.button('reset');
                });
            }

            function updateAnggota(formData, targetIdForm, elmButton) {
                const rowSelected = $(`button[data-idtargetform=${targetIdForm}]`).parents('tr')[0];
                const formTarget = rowSelected.querySelector('tr.input-row');
                const id = formData.get('anggota_id');
                // const formData = formData;
                const urlForm = `${url}/spt/anggota/${id}`;
                elmButton.button('loading');
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
                        // disini load data anggota
                        loadDataAnggota();
                    },
                    error: function (resErr) {
                        // get list field error from json response
                        let listFieldError = resErr.responseJSON?.errors;
                        // reset form
                        elmButton.button('reset');
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
                }).done(function (data) {
                    elmButton.button('reset');
                });
            }

            function deleteAnggota(id, elmButton) {
                const urlForm = `${url}/spt/anggota/${id}`;
                elmButton.button('loading');
                $.ajax({
                    type: 'DELETE',
                    url: urlForm,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function (response) {
                        // response berhasil
                        loadDataAnggota();
                        if (response.status == 'success') {
                            modules_toastr.notif('Info', response.message, 'success');
                        }
                    },
                    error: function (err) {
                        // console.log('Pesan erron: ,' err)
                        elmButton.button('reset');
                    },
                }).done(function (data) {
                    elmButton.button('reset');
                });
            }
        }
        // handle === Anggota === <<<START>>> in form edit spt

        // ========== end function
    })();
    // ========== end ready function
});

