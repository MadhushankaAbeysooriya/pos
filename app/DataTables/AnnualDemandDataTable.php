<?php

namespace App\DataTables;

use App\Models\AnnualDemand;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class AnnualDemandDataTable extends DataTable
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
            ->addColumn('action', function ($annualDemand) {
                $id = $annualDemand->id;
                $btn = '';

                if (Auth::user()->can('annual-demand-edit') ) {
                    $btn .= '<a href="' . route('annual_demands.edit', $id) . '"
                    class="btn btn-xs btn-info" data-toggle="tooltip" title="Edit">
                    <i class="fa fa-pen-alt"></i> </a> ';
                }
                if (Auth::user()->can('annual-demand-delete') ) {

                    $btn .= '<form  action="' . route('annual_demands.destroy', $id) . '" method="POST" class="d-inline" >
                            ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                            <button type="submit"  class="btn bg-danger btn-xs  dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700" onclick="return confirm(\'Do you need to delete this\');">
                            <i class="fa fa-trash-alt"></i></button>
                            </form> </div>';
                }

                return $btn;
            })
            ->addColumn('qty', function ($annualDemand) {

                $qty = $annualDemand->qty;

                // Check if $annualDemand->item and $annualDemand->item->measurement are not null
                if ($annualDemand->item && $annualDemand->item->measurement) {
                    $measurementName = $annualDemand->item->measurement->name;
                } else {
                    // Set a default value or handle the case where measurement is null
                    $measurementName = ''; // You can change this to your desired default value
                }

                return $qty . ' ' . $measurementName;
            })
            ->rawColumns(['action', 'qty']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(AnnualDemand $model): QueryBuilder
    {
        return $model->newQuery()->with(['item','location','supplier']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('annualdemand-table')
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
            Column::make('year')->data('year')->title('Year'),
            Column::make('item.name')->data('item.name')->title('Item'),
            Column::make('location.name')->data('location.name')->title('Location'),
            Column::make('supplier.name')->data('supplier.name')->title('Supplier'),
            Column::make('qty')->data('qty')->title('Qty'),
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
        return 'AnnualDemand_' . date('YmdHis');
    }
}
