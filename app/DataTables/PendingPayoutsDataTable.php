<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PendingPayoutsDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addIndexColumn()
            ->editColumn('status', function ($payout) {
                return '<span class="badge bg-warning">Unpaid</span>';
            })
            ->rawColumns(['status']);
    }

    public function query(User $model): QueryBuilder
    {
        $query = $model->newQuery()->whereHas('latestUnpaidPayout')->with('latestUnpaidPayout');

        if (request()->filled('start_date')) {
            $query->whereDate('created_at', '>=', request('start_date'));
        }

        if (request()->filled('end_date')) {
            $query->whereDate('created_at', '<=', request('end_date'));
        }

        return $query->orderBy('created_at', 'desc');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('pending-payout-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('csv')
                            ->text('Export')
                            ->className('btn btn-info text-white'),
                    ]);


    }

    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')
                ->title('#')
                ->width(60)
                ->addClass('text-center'),
            Column::make('id')
                ->title('Id')
                ->width(60),
            Column::make('name')
                ->title('Name')
                ->width(150),
            Column::make('account_balance')
                ->title('Amount')
                ->width(120),
            Column::make('account_number')
                ->title('Account No.')
                ->width(150),
            Column::make('bank_ifsc')
                ->title('Bank IFSC')
                ->width(120),
            Column::make('upi_code')
                ->title('UPI Code')
                ->width(120),
            Column::make('status')
                ->title('Status')
                ->width(120),
        ];
    }

    protected function filename(): string
    {
        return 'PendingPayouts_'.date('YmdHis');
    }
}
