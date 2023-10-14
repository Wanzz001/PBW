<?php

namespace App\DataTables;

use App\Models\Collection;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CollectionsDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('jenisKoleksi', function ($data) {
                switch ($data->jenisKoleksi) {
                    case 1:
                        return 'Buku';
                    case 2:
                        return 'Majalah';
                    case 3:
                        return 'Cakram Digital';
                    default:
                        return 'Tidak Diketahui';
                }
            })
            ->setRowId('id')
            ->addColumn('action', function ($data) {
                return $this->getActionColumn($data);
            });
    }

    public function query(Collection $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('collections-table')
            ->columns($this->getColumns());
    }

    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('namaKoleksi'),
            Column::make('jenisKoleksi'),
            Column::make('jumlahKoleksi'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
                ->title('Action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
                ->orderable(false)
                ->searchable(false),
        ];
    }

    protected function filename(): string
    {
        return 'Collections_' . date('YmdHis');
    }

    protected function getActionColumn($data): string
    {
        $showUrl = route('collection.show', $data->id);
        return "<a class='waves-effect btn btn-success' data-value='$data->id' href='$showUrl'><i class='material-icons'>View</a>";
    }
}
