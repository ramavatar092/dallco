<?php

namespace App\DataTables;

use App\Models\User;
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
            ->addIndexColumn(); 
    }

    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()
            ->where('account_balance', '>', 250)
            ->where('status',  'paid')
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
                    ->selectStyleSingle();
    }

    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')
                ->title('#')
                ->width(60)
                ->addClass('text-center'),
                Column::make('name')
                ->title('Name')
                ->width(150),
            Column::make('user_mobile')
                ->title('Mobile')
                ->width(180),
            Column::make('account_balance')
                ->title('Amount')
                ->width(120),
                Column::make('upi_code')
                ->title('UPI Code')
                ->width(120),
                Column::make('bank_ifsc')
                ->title('Bank IFSC')
                ->width(120),
                Column::make('account_number')
                ->title('Account No.')
                ->width(120),
        ];
    }

    protected function filename(): string
    {
        return 'PaidPayouts_'.date('YmdHis');
    }
}
