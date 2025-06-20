<?php

namespace App\DataTables;

use App\Models\ScanLog;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon;

class UserScanLogsDataTable extends DataTable
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->editColumn('user_mobile', function ($scanLog) {
                return optional($scanLog->user)->user_mobile ?? '—';
            })
            ->editColumn('coupon_code', function ($scanLog) {
                return optional($scanLog->coupon)->coupon_code ?? '-';
            })
           ->editColumn('created_at', function ($scanLog) {
                return $scanLog->created_at->format('d-m-Y');
            })
            ->editColumn('scan_amount', function ($scanLog) {
                return 'Rs. '. $scanLog->scan_amount;
            })
            ->filterColumn('user_mobile', function ($query, $keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('user_mobile', $keyword);
                });
            });
    }

    public function query(ScanLog $model): QueryBuilder
    {
        $query = $model->newQuery()->with(['user', 'coupon']);

        if (!empty($this->userId)) {
            $query->where('user_id', $this->userId);
        }

        if (request()->filled('start_date')) {
            $query->whereDate('scan_logs.created_at', '>=', request('start_date'));
        }

        if (request()->filled('end_date')) {
            $query->whereDate('scan_logs.created_at', '<=', request('end_date'));
        }

        return $query->orderBy('scan_logs.created_at', 'desc');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('scan-log-table')
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
                ->width(50),
            Column::make('coupon.coupon_code')
                ->title('Coupon Code')
                ->width(150),
            Column::make('scan_amount')
                ->title('Coupon Value')
                ->width(150),
            Column::make('user_mobile')
                ->title('User')
                ->width(150),
            Column::make('created_at')
                ->title('Date')
                ->width(150),
        ];
    }

    protected function filename(): string
    {
        return 'ScanLogs_' . date('YmdHis');
    }
}
