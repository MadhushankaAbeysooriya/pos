<?php

namespace App\DataTables\master;

use App\Models\master\Item;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ItemDataTable extends DataTable
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
            ->addColumn('is_vat', function($item){
                return ($item->is_vat==1)?'<h5><span class="badge badge-primary">VAT</span></h5>':
                '<h5><span class="badge badge-warning">Non - VAT</span></h5>';
            })
            ->addColumn('action', function ($item) {
                $id = $item->id;
                $btn = '';

                if (Auth::user()->can('master-item-add-alternative-item')) {
                    $btn .= '<a href="' . route('items.add_alternative_view', $id) . '"
                    class="btn btn-xs btn-success" data-toggle="tooltip" title="Add Alternatives">
                    <i class="fas fa-plus"></i> </a> ';
                }

                if (Auth::user()->can('master-item-edit')) {
                    $btn .= '<a href="' . route('items.edit', $id) . '"
                    class="btn btn-xs btn-info" data-toggle="tooltip" title="Edit">
                    <i class="fa fa-pen-alt"></i> </a> ';
                }
                if (Auth::user()->can('master-item-delete')) {
                    $btn .= '<form  action="' . route('items.destroy', $id) . '" method="POST" class="d-inline" >
                            ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                            <button type="submit"  class="btn bg-danger btn-xs  dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700" onclick="return confirm(\'Do you need to delete this\');">
                            <i class="fa fa-trash-alt"></i></button>
                            </form> </div>';
                }

                return $btn;
            })
            ->rawColumns(['action','is_vat']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Item $model): QueryBuilder
    {
        return $model->newQuery()->with(['itemcategory','measurement','rationsubcategory']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('item-table')
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
            Column::make('name')->data('name')->title('Name'),
            Column::make('itemcategory.name')->data('itemcategory.name')->title('Category'),
            Column::make('measurement.name')->data('measurement.name')->title('Measurement'),
            Column::make('rationsubcategory.name')->data('rationsubcategory.name')->title('Ration Category'),
            Column::make('is_vat')->data('is_vat')->title('VAT'),
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
        return 'Item_' . date('YmdHis');
    }
}
