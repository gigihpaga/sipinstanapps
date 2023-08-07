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
                data: 'pemohon_spt',
                name: 'pemohon_spt',
            },
            {
                data: 'sifat_tugas',
                name: 'sifat_tugas',
            },
            {
                data: 'status_buat',
                name: 'status_buat',
            },
            {
                data: 'nomor_pengajuan',
                name: 'nomor_pengajuan',
            },
            {
                data: 'tanggal_mulai',
                name: 'tanggal_mulai',
            },
            {
                data: 'tanggal_selesai',
                name: 'tanggal_selesai',
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
            {
                data: 'created_by',
                name: 'created_by',
            },
        ];
        const url = window.location.href;

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
                {
                    targets: 4, // kolom statusbuat
                    render: function (data, type, row) {
                        if (!row.status_buat) {
                            return '';
                        }

                        if (row.status_buat == 0) {
                            return '<span class="badge bg-warning">Belum selesai</span>';
                        }
                        return '<span class="badge bg-success">Selesai</span>';
                    },
                },
            ],
            order: [[2, 'asc']],
            columns: listColums,
        });

        // // ini utuk uncolapse text
        $('tbody').on('click', 'tr', function () {
            // $(this).children('td:eq(1)').text(table.row(this).data()[1]);
            let fullSentence = Object.values(table.row(this).data())[1]; // 1 adalah full data. dimbil oleh ellipsis
            let debug = table.row(this).data();
            console.log(debug);
            $(this).children('td:eq(2)').text(fullSentence); // 1 ini adalah target value kolom yang akan di replace
            table.cell(this, 2).invalidate('dom');
        });
        //  // ini utuk uncolapse text end

        // ========== end function
    })();
    // ========== end ready function
});

