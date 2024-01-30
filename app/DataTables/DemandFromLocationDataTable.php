<?php

namespace App\DataTables;

use App\Models\DemandFromLocation;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DemandFromLocationDataTable extends DataTable
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
            ->addColumn('request_date', function ($demandFormLocation) {

                $dateObject = new \DateTime($demandFormLocation->request_date);
                $request_datee = ($dateObject->format('Y-m-d'));
                return $request_datee;
            })
            ->addColumn('status', function ($demandFormLocation) {

                $rowstatus = $demandFormLocation->status;

                switch ($rowstatus) {
                    case 1:
                        $badge = '<span class="badge bg-info text-dark">Processing</span>';
                        break;
                    case 2:
                        $badge = '<span class="badge bg-success">Approved</span>';
                        break;
                    default:
                        $badge = '<span class="badge bg-warning">Pending</span>';
                }
                return $badge;
            })
            ->addColumn('action', function ($demandFormLocation) {
                $id = $demandFormLocation->id;
                $btn = '';

                if (Auth::user()->can('demand-from-location-edit')) {
                    $btn .= '<a href="' . route('demand_from_locations.edit', $id) . '"
                    class="btn btn-xs btn-info" data-toggle="tooltip" title="Edit">
                    <i class="fa fa-pen-alt"></i> </a> ';
                }

                if (Auth::user()->can('demand-from-location-create-reciept')) {
                    $btn .= '<a href="' . route('receipt_from_locations.create', $id) . '"
                    class="btn btn-xs btn-warning" data-toggle="tooltip" title="Create Receipt">
                    <i class="fa fa-receipt"></i> </a> ';
                }

                $btn .= '<a href="' . route('demand_from_locations.add_items_view', $id) . '"
                    class="btn btn-xs btn-success" data-toggle="tooltip" title="Add Items">
                    <i class="fa fa-plus"></i> </a> ';

                if (Auth::user()->can('demand-from-location-delete') ) {
                    $btn .= '<form  action="' . route('demand_from_locations.destroy', $id) . '" method="POST" class="d-inline" >
                            ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                            <button type="submit"  class="btn bg-danger btn-xs  dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700" onclick="return confirm(\'Do you need to delete this\');">
                            <i class="fa fa-trash-alt"></i></button>
                            </form> </div>';
                }

                return $btn;
            })
            ->rawColumns(['action','status']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(DemandFromLocation $model): QueryBuilder
    {
        return $model->newQuery()->with(['item','location','supplier']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('demandfromlocation-table')
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
                        Button::make('reset'),
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
            Column::make('supplier.name')->data('supplier.name')->title('Supplier'),
            Column::make('location.name')->data('location.name')->title('Location'),
            Column::make('request_date')->data('request_date')->title('Request Date'),
            Column::computed('status'),
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
        return 'DemandFromLocation_' . date('YmdHis');
    }
}
