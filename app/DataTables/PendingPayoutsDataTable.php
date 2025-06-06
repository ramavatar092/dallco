<?php

namespace App\DataTables;

use App\Models\Payout;
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
            ->editColumn('name', function ($payout) {
                return optional($payout->user)->name ?? '—';
            })
            ->editColumn('account_number', function ($payout) {
                return optional($payout->user)->account_number ?? '—';
            })
            ->editColumn('bank_ifsc', function ($payout) {
                return optional($payout->user)->bank_ifsc ?? '—';
            })
            ->editColumn('upi_code', function ($payout) {
                return optional($payout->user)->upi_code ?? '—';
            })
            ->editColumn('status', function ($payout) {
                return '<span class="badge bg-warning">' . ucwords($payout->status) . '</span>';
            })
            ->filterColumn('name', function ($query, $keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('account_number', function ($query, $keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('account_number', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('bank_ifsc', function ($query, $keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('bank_ifsc', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('upi_code', function ($query, $keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('upi_code', 'like', "%{$keyword}%");
                });
            })
            ->rawColumns(['status']);
    }

    public function query(Payout $model): QueryBuilder
    {
        $query = $model->newQuery()->with('user')->where('status', 'unpaid');

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
            Column::make('amount')
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
