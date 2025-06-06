<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('custom_action', fn(User $user) =>
                '<div class="d-flex gap-1">
                    <button id="updateStatus"
                            class="btn btn-sm ' . ($user->status == 'active' ? 'btn-success' : 'btn-danger') . ' updateStatus"
                            data-user-id="' . $user->id . '"
                            data-user-status="' . $user->status . '">'
                    . ($user->status == 'active' ? 'Active' : 'Deactivate') .
                    '</button>
                    <a href="' . route('scan-logs.user', $user->id) . '" class="btn btn-info btn-sm scan-log">
                        Scan Log
                    </a>
                    <a href="' . route('payouts') . '" class="btn btn-secondary btn-sm transactions">
                        Transactions
                    </a>
                </div>'
            )
            ->addColumn('action', fn(User $user) =>
                '<div class="d-flex justify-content-center gap-2">
                    <a href="' . route('users.edit', $user->id) . '" class="text-warning mx-1">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="javascript:void(0);" id="deleteBtn" class="text-danger" data-id="' . $user->id . '" data-url="' . route('users.destroy', $user->id) . '">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </div>'
            )
            ->rawColumns(['custom_action', 'action'])
            ->setRowId('id');
    }

    public function query(User $model): QueryBuilder
    {
        return $model->orderBy('created_at', 'desc')->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle();
    }

    public function getColumns(): array
    {
        return [
            Column::make('id')
                ->title('ID')
                ->width(60), // good for small numbers
            Column::make('user_mobile')
                ->title('Mobile')
                ->width(180),
            Column::make('name')
                ->title('Name')
                ->width(150),
            Column::make('state')
                ->title('State')
                ->width(100),
            Column::make('register_date')
                ->title('Reg. Date')
                ->width(200),
            Column::make('account_balance')
                ->title('Balance')
                ->width(120),
            Column::computed('custom_action')
                ->title('')
                ->exportable(false)
                ->printable(false)
                ->width(300)
                ->addClass('text-center'),
            Column::computed('action')
                ->title('')
                ->exportable(false)
                ->printable(false)
                ->width(180)
                ->addClass('text-center action-button'),
        ];
    }

    protected function filename(): string
    {
        return 'Users_'.date('YmdHis');
    }
}
