<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDetailsExport extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id');
    }

    public function query(User $model): QueryBuilder
    {
        $startDate = $this->request()->get('start_date');
        $endDate = $this->request()->get('end_date');

        $query = $model->newQuery()->orderBy('created_at', 'desc');

        if (!empty($startDate)) {
            $query->whereDate('created_at', '>=', $startDate);
        }

        if (!empty($endDate)) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        return $query;
    }
    

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->dom('Bfrtip')
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
            Column::make('city')
                ->title('City')
                ->width(100),
            Column::make('register_date')
                ->title('Joined On')
                ->width(200),
            Column::make('total_earnings')
                ->title('Total Earnings')
                ->width(120),
            Column::make('total_payout')
                ->title('Total Payout')
                ->width(120),
            Column::make('remarks')
                ->title('Remarks')
                ->width(120),
        ];
    }

    protected function filename(): string
    {
        return 'Users_'.date('YmdHis');
    }
}
