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
            ->editColumn('name', function ($message) {
                return optional($message->user)->name ?? '—';
            })
            ->filterColumn('name', function ($query, $keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
            });
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

        return $query->orderBy('date', 'desc');
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
            Column::make('id')->title('ID')->width(60),
            Column::make('name')->title('User Name')->orderable(false)->searchable(true),
            Column::make('date')->title('Date')->width(100),
            Column::make('title')->title('Title')->width(200),
            Column::make('description')->title('Description')->width(300),
        ];
    }

    protected function filename(): string
    {
        return 'Messages_' . date('YmdHis');
    }
}
