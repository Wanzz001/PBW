<?php

namespace App\DataTables;

use App\Models\DetailTransaction;
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

class DetailTransactionDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */


    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'detailtransaction.action')
            ->setRowId('id')
            ->addColumn('action', function ($data) {
                return $this->getActionColumn($data);
            });
    }

    /**
     * Get the query source of dataTable.
     */
    protected $transactionId;

    public function setIdTransaksi($transactionId)
    {
        $this->transactionId = $transactionId;
    }
    public function query(DetailTransaction $model): QueryBuilder
    {
        return $model
            ->newQuery()
            ->select(
                'dt.id',
                'dt.tanggalKembali',
                't.tanggalPinjam',
                'dt.status',
                'c.namaKoleksi',
                DB::raw('(CASE WHEN dt.status="1" THEN "Pinjam"
                WHEN dt.status="2" THEN "Kembali"
                WHEN dt.status="3" THEN "Hilang" 
                END) as status'),
            )
            ->from('detail_transactions', 'dt')
            ->join('collections as c', 'c.id', '=', 'collectionId')
            ->join('transactions as t', 't.id', '=', 'transactionId')
            ->where('transactionId', '=', $this->transactionId);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('detailtransactions-table')
            ->columns($this->getColumns());
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('namaKoleksi'),
            Column::make('tanggalPinjam'),
            Column::make('tanggalKembali'),
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
        return 'DetailTransaction_' . date('YmdHis');
    }

    protected function getActionColumn($data): string
    {
        $showUrl = route('detailTransactionKembali', $data->id);
        return "<a class='waves-effect btn btn-success' data-value='$data->id' href='$showUrl'><i class='material-icons'>Edit</a>";
    }
}
