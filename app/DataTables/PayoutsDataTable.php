<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PayoutsDataTable extends DataTable
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
            ->where('account_balance', '>=', 250)
            ->orderBy('created_at', 'desc');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('payouts-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('csv')
                            ->text('Payout CSV')
                            ->className('btn btn-info text-white'),

                        [
                            'text' => 'Process Payout',
                            'className' => 'btn btn-success text-white process-payout',
                            'action' => "function(e, dt, node, config) {
                                e.preventDefault();

                                // Extract user IDs from row data
                                var userIds = dt.rows().data().toArray().map(function(row) {
                                    return row.id; // 'id' is the user_id
                                });

                                $.ajax({
                                    url: '" . route('payouts.update') . "',
                                    method: 'POST',
                                    data: {
                                        _token: '" . csrf_token() . "',
                                        user_ids: userIds
                                    },
                                    success: function(response) {
                                        dt.ajax.reload();

                                        // Trigger CSV export after payout processing
                                        dt.button('csv:name').trigger();
                                    },
                                    error: function(xhr, status, error) {
                                        alert('Error processing payout: ' + xhr.responseText);
                                    }
                                });
                            }"
                        ],
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
                ->width(150),
        ];
    }

    protected function filename(): string
    {
        return 'Payouts_'.date('YmdHis');
    }
}
