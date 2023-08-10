<?php

namespace App\DataTables;

use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PegawaiDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn() // untuk no
            ->addColumn('action', function ($row) {
                $action = '';
                if (Gate::allows('update_master/pegawai')) {
                    $action = '<button type="button" data-id=' . $row->id . ' data-typeaction="edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-bs-original-title="Edit" class="btn btn-action mb-1 btn-sm btn-primary mx-1"><i class="ti-pencil-alt"></i></button>';
                }
                if (Gate::allows('delete_master/pegawai')) {
                    $action .= '<button type="button" data-id=' . $row->id . ' data-typeaction="delete" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-bs-original-title="Delete" class="btn btn-action mb-1 btn-sm btn-outline-danger mx-1"><i class="ti-trash"></i></button>';
                }
                $wrapper = '<div class="d-flex justify-content-evenly">' . $action . '</div>';
                return $wrapper;
            })
            // ->setRowId('id')
            ->addColumn('checkbox', function ($row) {
                return '<input class="form-check-input" type="checkbox" id=cb-' . $row->id . ' name=cb-' . $row->id . ' value=' . $row->id . ' class="dt-cb-child">';
            })
            ->rawColumns(['action', 'checkbox']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Pegawai $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pegawai $model): QueryBuilder
    {
        return $model
            ->leftJoin('jabatan', 'jabatan.id', '=', 'pegawai.jabatan_id')
            ->leftJoin('pangkat_golongan', 'pangkat_golongan.id', '=', 'pegawai.pangkat_golongan_id')
            ->leftJoin('kelas_perjadin', 'kelas_perjadin.id', '=', 'pegawai.kelas_perjadin_id')
            ->select([
                'pegawai.*',
                'jabatan.nama as jabatan_nama',
                'pangkat_golongan.nama as pangkat_golongan_nama',
                'kelas_perjadin.kategori as kelas_perjadin_kategori'
            ]);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->parameters([
                'searchDelay' => 1500,
                'scrollX' => true,
                'processing' => true,
                // 'buttons' => ['reload'], // tidak berguna
                'language' => ["processing" => '<div class="spinner-border" style="width: 20px; height: 20px;" role="status"><span class="visually-hidden">Loading...</span></div>'],
                // 'drawCallback' => 'function(oSettings) {$(\'[data-toggle="tooltip"]\').tooltip();}',
                // 'drawCallback' => 'function() { alert("Table Draw Callback") }',
                // 'drawCallback' => '$(function () {$(\'[data-toggle="tooltip"]\').tooltip()})',
            ])
            // https://yajrabox.com/docs/laravel-datatables/master/html-builder-action
            ->columnDefs([
                [
                    'className' => 'dt-nowrap text-capitalize',
                    'targets' => [0, 1, 2, 3, 4, 5, 6, 7]
                ]
            ])
            ->setTableId('role-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            // ->buttons([
            //     Button::make('excel'),
            //     Button::make('csv'),
            //     Button::make('pdf'),
            //     Button::make('print'),
            //     Button::make('reset'),
            //     Button::make('reload')
            // ])
            ->setTableAttribute('class', 'table-hover table-stripped table dataTable no-footer');
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            // Column::make('id'),
            Column::computed('_', '<input class="form-check-input" type="checkbox" id="dt-cb-parent" name="dt-cb-parent" value="">')
                // ->content('<input class="form-check-input" type="checkbox" id="dt-cb-parent" name="dt-cb-parent" value="">')
                ->data('checkbox')
                ->name('checkbox')
                ->exportable(false)
                ->printable(false)
                ->width(15)
                ->addClass('column-checkbox dt-cb-column text-center'),
            Column::make('DT_RowIndex')->title('No')->searchable(false)->orderable(false)
                ->width(20), // untuk no
            Column::make('nip')->content(''),
            Column::make('nama')->content(''),
            Column::make('jabatan_nama')->content('')->searchable(false),
            Column::make('pangkat_golongan_nama')->content('')->searchable(false),
            Column::make('kelas_perjadin_kategori')->content('')->searchable(false),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(90)
                ->addClass('text-center'),
            // ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Pegawai_' . date('YmdHis');
    }
}
