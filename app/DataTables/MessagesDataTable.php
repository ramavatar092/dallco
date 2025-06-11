<?php

namespace App\DataTables;

use App\Models\Message;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MessagesDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addIndexColumn()
            ->editColumn('name', function ($message) {
                return optional($message->user)->name ?? '—';
            })
            ->editColumn('description', function ($message) {
                $short = \Str::limit(strip_tags($message->description), 50, '...');
                return $short;
            })
            ->filterColumn('name', function ($query, $keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
            })
            ->addColumn('action', fn(Message $message) =>
                '<div class="d-flex justify-content-center gap-2">
                    <a href="' . route('messages.edit', $message->id) . '" class="text-warning mx-1">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="javascript:void(0);" id="deleteBtn" class="text-danger" data-id="' . $message->id . '" data-url="' . route('messages.destroy', $message->id) . '">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </div>'
            )
            ->rawColumns(['description', 'action']);
    }

    public function query(Message $model): QueryBuilder
    {
        $query = $model->newQuery()->with(['user']);

        if (!empty($this->userId)) {
            $query->where('user_id', $this->userId);
        }

        if (request()->filled('start_date')) {
            $query->whereDate('date', '>=', request('start_date'));
        }

        if (request()->filled('end_date')) {
            $query->whereDate('date', '<=', request('end_date'));
        }

        return $query->orderBy('created_at', 'desc');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('messages-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(2)
                    ->selectStyleSingle();
    }

    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')->title('#')->width(30),
            Column::make('id')->title('User ID')->width(100),
            Column::make('name')->title('User Name')->width(150)->orderable(false),
            Column::make('date')->title('Date')->width(100),
            Column::make('title')->title('Title')->width(150),
            Column::make('description')->title('Description')->width(300),
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
        return 'Messages_' . date('YmdHis');
    }
}
