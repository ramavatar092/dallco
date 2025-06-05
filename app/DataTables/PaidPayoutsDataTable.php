<?php

namespace App\DataTables;

use App\Models\Payout;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PaidPayoutsDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addIndexColumn()
            ->editColumn('name', function ($payout) {
                return optional($payout->user)->name ?? '—';
            })
            ->editColumn('status', function ($payout) {
                return '<span class="badge bg-success">' . ucwords($payout->status) . '</span>';
            })
            ->rawColumns(['status']);
    }

    public function query(Payout $model): QueryBuilder
    {
        return $model->newQuery()
            ->with('user')
            ->where('status', 'paid')
            ->orderBy('created_at', 'desc');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('paid-payout-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        [
                            'text' => 'Payment Recoard Import',
                            'className' => 'btn btn-info text-white',
                            'action' => 'function (e, dt, node, config) {
                                $("#paymentImportModal").modal("show");
                            }'
                        ],
                    ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')
                ->title('#')
                ->width(30)
                ->addClass('text-center'),
            Column::make('id')
                ->title('Id')
                ->width(30),
            Column::make('name')
                ->title('Name')
                ->width(50),
            Column::make('amount')
                ->title('Amount')
                ->width(100),
            Column::make('transfer_date')
                ->title('Transfer Date')
                ->width(150),
            Column::make('transfer_mode')
                ->title('Transfer Mode')
                ->width(150),
            Column::make('transfer_remarks')
                ->title('Transfer Remarks')
                ->width(200),
            Column::make('status')
                ->title('Status')
                ->width(100),
        ];
    }

    protected function filename(): string
    {
        return 'PaidPayouts_'.date('YmdHis');
    }
}
