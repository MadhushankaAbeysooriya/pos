<?php

namespace App\DataTables\master;

use App\Models\master\Menu;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class MenuDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($rationTime) {
                $id = $rationTime->id;
                $btn = '';

                    $btn .= '<a href="'.route('menu_items.create',$id).'"
                    class="btn btn-xs btn-success" data-toggle="tooltip" title="Add">
                    <i class="fa fa-plus"></i> </a> ';

                if (Auth::user()->can('master-menu-edit') ) {
                    $btn .= '<a href="' . route('menus.edit', $id) . '"
                    class="btn btn-xs btn-info" data-toggle="tooltip" title="Edit">
                    <i class="fa fa-pen-alt"></i> </a> ';
                }

                 if (Auth::user()->can('master-menu-delete') ) {
                     $btn .= '<form  action="' . route('menus.destroy', $id) . '" method="POST" class="d-inline" >
                            ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                            <button type="submit"  class="btn bg-danger btn-xs  dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700" onclick="return confirm(\'Do you need to delete this\');">
                            <i class="fa fa-trash-alt"></i></button>
                            </form> </div>';
                 }

                return $btn;
            })
        ->rawColumns(['action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Menu $model): QueryBuilder
    {
        return $model
        // ->select('menus.*',
        //  'ration_dates.name as rationdate')
        ->newQuery()
        ->with('rationdate','rationtype','rationtime');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('menu-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('add'),
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('#')->searchable(false)->orderColumn(false)->width(40),
            Column::make('name')->data('name')->title('Menu Name'),
            Column::make('rationdate.name')->data('rationdate.name')->title('Ration Date'),
            Column::make('rationtype.name')->data('rationtype.name')->title('Ration Type'),
            Column::make('rationtime.name')->data('rationtime.name')->title('Ration Time'),

            Column::make('year')->title('Year'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(100)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Menu_' . date('YmdHis');
    }
}
