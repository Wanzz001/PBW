<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

// Nama: Wandi Ridwansyah
// NIM: 6706220080
// Kelas: 46-03

class DetailTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function detailTransactionKembalikan($detailTransactionId)
    {
        $detailTransaksi = DB::table('detail_transactions as dt')
            ->select(
                't.id as idTransaksi',
                'dt.id as id',
                'dt.tanggalKembali as tanggalKembali',
                't.tanggalPinjam as tanggalPinjam',
                'dt.status',
                'uPinjam.fullname as namaPeminjam',
                'uTugas.fullname as namaPetugas',
                'c.namaKoleksi as koleksi',
                'c.id as idKoleksi'
            )
            ->join('collections as c', 'c.id', '=', 'collectionId')
            ->join('transactions as t', 't.id', '=', 'dt.transactionId')
            ->join('users as uPinjam', 't.userIdPeminjam', '=', 'uPinjam.id')
            ->join('users as uTugas', 't.userIdPetugas', '=', 'uTugas.id')
            ->where('dt.id', '=', $detailTransactionId)->first();

        return view('detailTransaction.detailTransactionKembalikan', compact('detailTransaksi'));
    }


    public function update(Request $request)
    {
        if ($request->status == 1) {
        } else {
            DB::table('detail_transactions')
                ->where('id', '=', $request->idDetailTransaksi)
                ->update([
                    'status' => $request->status,
                    'tanggalKembali' => Carbon::now()->toDateString()
                ]);

            if ($request->status == 2) {
                DB::table('collections')
                ->where('id', '=', $request->idKoleksi)
                ->increment('jumlahKoleksi');
            }
        }

        $allDetailsCompleted = DB::table('detail_transactions')
            ->where('transactionId', '=', $request->idTransaksi)
            ->where('status', '!=', 2) 
            ->where('status', '!=', 3) 
            ->doesntExist();

        if ($allDetailsCompleted) {
            Transaction::where('id', '=', $request->idTransaksi)
                ->update(['tanggalSelesai' => Carbon::now()->toDateString()]);
        }


        $transaction = Transaction::where('id', '=', $request->idTransaksi)->first();
        return redirect('transaksiView/' . $request->idTransaksi)->with('transaction', $transaction);
    }
}
