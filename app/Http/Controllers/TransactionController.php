<?php

namespace App\Http\Controllers;

use App\DataTables\TransactionDataTable;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TransactionDataTable $dataTable)
    {
        return $dataTable->render('transaksi.daftarTransaksi');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::get();
        $vehicles = Vehicle::get();
        return view('transaksi.peminjaman', compact('vehicles', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idPeminjam' => ['required', 'integer'],
            'idKendaraan' => ['required', 'integer'],
            'startDate' => ['required', 'date'],
            'endDate' => ['required', 'date'],
        ]);

        $start = new \DateTime($request->startDate);
        $end = new \DateTime($request->endDate);
        $interval = $start->diff($end);
        $numberOfDays = $interval->days;

        $vehicle = Vehicle::find($request->idKendaraan);
        $dailyPrice = $vehicle->dailyPrice;

        $totalPrice = $dailyPrice * $numberOfDays;

        $transaction = new Transaction;

        $transaction->userId = $request->idPeminjam;
        $transaction->vehicleId = $request->idKendaraan;
        $transaction->startDate = $request->startDate;
        $transaction->endDate = $request->endDate;
        $transaction->price = $totalPrice;
        $transaction->status = 1;

        $transaction->save();

        return redirect()->route('transaksi.index');
    }


    public function edit(string $id)
    {
        $transaksi = DB::table('transaction as t')
            ->select(
                't.id as id',
                'u.name as peminjam',
                'v.name as kendaraan',
                't.startDate as start',
                't.endDate as end',
                't.price as price',
                't.status as status',
            )
            ->join('users as u', 'u.id', '=', 't.userId')
            ->join('vehicles as v', 'v.id', '=', 't.vehicleId')
            ->where('t.id', '=', $id)
            ->first();

        return view('transaksi.pengembalian', compact('transaksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        DB::table('transaction')
            ->where('id', '=', $request->idTransaksi)
            ->update([
                'status' => $request->status
            ]);
        return redirect()->route('transaksi.index');
    }
}
