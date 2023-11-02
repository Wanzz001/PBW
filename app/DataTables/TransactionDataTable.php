<?php

namespace App\DataTables;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TransactionDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'transaction.action')
            ->setRowId('id')
            ->addColumn('action', function ($data) {
                return $this->getActionColumn($data);
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Transaction $model): QueryBuilder
    {
        return $model
            ->newQuery()
            ->select(
                't.id as id',
                'u.name as peminjam',
                'v.name as kendaraan',
                't.startDate as start',
                't.endDate as end',
                't.price as price',
                't.status',
                DB::raw('
                (CASE
                WHEN t.status="1" THEN "Pinjam"
                WHEN t.status="2" THEN "Kembali"
                WHEN t.status="3" THEN "Hilang"
                END) AS status
                '),
                )
                ->from('transaction','t')
                ->join('users as u', 'u.id', '=', 't.userId')
                ->join('vehicles as v', 'v.id', '=', 't.vehicleId');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('transaction-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('peminjam'),
            Column::make('kendaraan'),
            Column::make('start') -> title('Tanggal Pinjam'),
            Column::make('end') -> title('Tanggal Selesai'),
            Column::make('price') -> title('Harga'),
            Column::make('status'),
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

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Transaction_' . date('YmdHis');
    }

    protected function getActionColumn($data): string
    {
        $showUrl = route('transaksi.edit', $data->id);
        return "<a class='waves-effect btn btn-success' data-value='$data->id' href='$showUrl'><i class='material-icons'>Edit</a>";
    }
}
