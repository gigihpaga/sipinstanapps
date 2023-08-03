<?php

namespace App\DataTables;

use App\Models\Role;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RoleDataTable extends DataTable
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
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('d-m-Y H:i');
            }) // format data tanggal
            ->editColumn('updated_at', function ($row) {
                return $row->updated_at->format('d-m-Y H:i');
            }) // format data tanggal
            ->addColumn('action', function ($row) {
                $action = '';
                if (Gate::allows('update permission')) {
                    $action = '<button type="button" data-id=' . $row->id . ' data-typeaction="edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-bs-original-title="Edit" class="btn btn-action mb-1 btn-sm btn-primary mx-1"><i class="ti-pencil-alt"></i></button>';
                }
                if (Gate::allows('delete permission')) {
                    $action .= '<button type="button" data-id=' . $row->id . ' data-typeaction="delete" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-bs-original-title="Delete" class="btn btn-action mb-1 btn-sm btn-outline-danger mx-1"><i class="ti-trash"></i></button>';
                }
                $wrapper = '<div class="d-flex justify-content-evenly">' . $action . '</div>';
                return $wrapper;
            })
            // ->setRowId('id')
        ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model): QueryBuilder
    {
        return $model->newQuery();
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
                // 'language' => ['processing' => '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>']
                // 'drawCallback' => 'function(oSettings) {$(\'[data-toggle="tooltip"]\').tooltip();}',
                // 'drawCallback' => 'function() { alert("Table Draw Callback") }',
                // 'drawCallback' => '$(function () {$(\'[data-toggle="tooltip"]\').tooltip()})',
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
        ;
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
            Column::make('DT_RowIndex')->title('No')->searchable(false)->orderable(false), // untuk no
            Column::make('name'),
            Column::make('guard_name'),
            // Column::make('add your columns'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(90)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Role_' . date('YmdHis');
    }
}
