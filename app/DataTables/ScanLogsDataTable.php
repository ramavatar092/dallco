<?php

namespace App\DataTables;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ScanLogssDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', fn(ScanLog $scanLog) =>
                '<div class="d-flex justify-content-center gap-2">
                    <a href="javascript:void(0);" id="deleteBtn" class="text-danger" data-id="' . $scanLog->id . '" data-url="' . route('scan-logs.destroy', $scanLog->id) . '">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </div>'
            )
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    public function query(ScanLog $model): QueryBuilder
    {
        $query = $model->newQuery()->orderBy('created_at', 'desc');

        // Filter by coupon_id if provided
        if ($couponId = request()->get('coupon_id')) {
            $query->where('coupon_id', $couponId);
        }

        // Filter by user_id if provided
        if ($userId = request()->get('user_id')) {
            $query->where('user_id', $userId);
        }

        return $query;
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('scan-log-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle();
    }

    public function getColumns(): array
    {
        return [
            Column::make('id')
                ->title('ID')
                ->width(50),
            Column::make('user_id')
                ->title('User ID')
                ->width(100),
            Column::make('coupon_id')
                ->title('Coupon ID')
                ->width(100),
            Column::make('scan_amount')
                ->title('Scan Amount')
                ->width(100),
            Column::make('created_at')
                ->title('Scanned At')
                ->width(150),
            Column::computed('action')
                ->title('Actions')
                ->exportable(false)
                ->printable(false)
                ->width(80)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'ScanLogs_'.date('YmdHis');
    }
}
