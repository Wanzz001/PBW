<?php

namespace App\Http\Controllers;

use App\DataTables\DetailTransactionDataTable;
use App\DataTables\TransactionDataTable;
use App\Models\Collection;
use App\Models\DetailTransaction;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

// Nama: Wandi Ridwansyah
// NIM: 6706220080
// Kelas: 46-03

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TransactionDataTable $dataTable)
    {
        return $dataTable->render('transaction.daftarTransaksi');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::get();
        $collections = Collection::where('jumlahKoleksi', '>', 0)->get();
        return view('transaction.transaksiTambah', compact('collections', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idPeminjam' => ['required', 'integer'],
            'idKoleksi1' => ['required', 'integer'],
            'idKoleksi2' => ['required', 'integer'],
        ]);

        $transaction = new Transaction;

        $transaction->userIdPeminjam = $request->idPeminjam;
        $transaction->userIdPetugas = auth()->user()->id;
        $transaction->tanggalPinjam = Carbon::now()->toDateString();
        $transaction->save();
        $lastTransactionId = $transaction->id;

        DetailTransaction::create([
            'transactionId' => $lastTransactionId,
            'collectionId' => $request->idKoleksi1,
            'status' => 1
        ]);
        DB::table('collections')->where('id', $request->idKoleksi1)->decrement('jumlahKoleksi');

        if ($request->idKoleksi2 > 0) {
            DetailTransaction::create([
                'transactionId' => $lastTransactionId,
                'collectionId' => $request->idKoleksi2,
                'status' => 1
            ]);
            DB::table('collections')->where('id', $request->idKoleksi2)->decrement('jumlahKoleksi');
        }
        return redirect()->route('transaction.index');
    }

    /**
     * Display the specified resource.
     */

    public function getTransactionData(Transaction $transaction)
    {
        $transactionData = DB::table('transactions')
            ->select(
                'transactions.id as id',
                'u1.fullname as fullnamePeminjam',
                'u2.fullname as fullnamePetugas',
                'tanggalPinjam',
                'tanggalSelesai'
            )
            ->join('users as u1', 'transactions.userIdPeminjam', '=', 'u1.id')
            ->join('users as u2', 'transactions.userIdPetugas', '=', 'u2.id')
            ->where('transactions.id', $transaction->id)
            ->first();

        return $transactionData;
    }

    public function show(Transaction $transaction, DetailTransactionDataTable $dataTable)
    {
        $transactionData = $this->getTransactionData($transaction);

        $dataTable->setIdTransaksi($transaction->id);

        return $dataTable->render('transaction.transaksiView', compact('transactionData'));
    }


    public function getDetailTransactionData(Transaction $transaction)
    {
        $detailTransactionData = DB::table('transactions')
            ->select(
                'transactions.id as id',
                'u1.fullname as fullnamePeminjam',
                'u2.fullname as fullnamePetugas',
                'tanggalPinjam',
                'tanggalSelesai'
            )
            ->join('users as u1', 'transactions.userIdPeminjam', '=', 'u1.id')
            ->join('users as u2', 'transactions.userIdPetugas', '=', 'u2.id')
            ->where('transactions.id', $transaction->id)
            ->first();

        return $detailTransactionData;
    }
}
