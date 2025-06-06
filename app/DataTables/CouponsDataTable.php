<?php

namespace App\DataTables;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CouponsDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('custom_action', function(Coupon $coupon) {
                $buttons = '<div class="d-flex gap-1">';

                if ($coupon->coupon_status !== 'cancelled') {
                    $buttons .= '<button id="updateStatus" class="btn btn-danger btn-sm" data-coupon-id="' . $coupon->id . '">Cancel</button>';
                }

                $buttons .= '<a href="' . route('scan-logs.coupon', $coupon->id) . '" class="btn btn-info btn-sm scan-log">
                        Scan Log
                    </a>';
                $buttons .= '</div>';

                return $buttons;
            })

            ->addColumn('action', fn(Coupon $coupon) =>
                '<div class="d-flex justify-content-center gap-2">
                    <a href="' . route('coupons.edit', $coupon->id) . '" class="text-warning mx-1">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="javascript:void(0);" id="deleteBtn" class="text-danger" data-id="' . $coupon->id . '" data-url="' . route('coupons.destroy', $coupon->id) . '">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </div>'
            )
            ->rawColumns(['custom_action', 'action'])
            ->setRowId('id');
    }

    public function query(Coupon $model): QueryBuilder
    {
        return $model->orderBy('created_at', 'desc')->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('coupons-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                [
                    'text' => 'Import Coupon',
                    'className' => 'btn btn-success text-white',
                    'action' => 'function (e, dt, node, config) {
                        $("#importModal").modal("show");
                    }'
                ],
                [
                    'text' => 'Bulk Cancel Coupons',
                    'className' => 'btn btn-warning text-white',
                    'action' => 'function (e, dt, node, config) {
                        $("#cancelCouponsModal").modal("show");
                    }'
                ]
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('id')
                ->title('ID')
                ->width(20), // good for small numbers
            Column::make('coupon_code')
                ->title('Coupon Code')
                ->width(300),
            Column::make('coupon_date')
                ->title('Added Date')
                ->width(300),
            Column::make('coupon_expiry')
                ->title('Expiry Date')
                ->width(300),
            Column::make('coupon_value')
                ->title('Amount')
                ->width(200),
            Column::make('coupon_status')
                ->title('Status')
                ->width(100),
            Column::computed('custom_action')
                ->title('')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center'),
            Column::computed('action')
                ->title('')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center action-button'),
        ];
    }

    protected function filename(): string
    {
        return 'Coupons_'.date('YmdHis');
    }
}
