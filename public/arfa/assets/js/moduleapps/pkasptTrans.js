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
        $('tbody').on('click', 'tr', function () {
            // $(this).children('td:eq(1)').text(table.row(this).data()[1]);
            let fullSentence = Object.values(table.row(this).data())[1]; // 1 adalah full data. dimbil oleh ellipsis
            let debug = table.row(this).data();
            console.log(debug);
            $(this).children('td:eq(2)').text(fullSentence); // 1 ini adalah target value kolom yang akan di replace
            table.cell(this, 2).invalidate('dom');
        });
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
                autoAdjustHeight: true, // Automatically adjust content height
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
                    handleSave();
                },
                error: function (err) {
                    console.log('[Log On] >> [roles-index.blade] -> [err] : ', err);
                },
            });
        });

        // handle button save on form action
        function handleSave() {
            $('#next-btn-modal').on('click', function (e) {
                $('#smartwizard').smartWizard('next');
            });
        }

        // ========== end function
    })();
    // ========== end ready function
});

