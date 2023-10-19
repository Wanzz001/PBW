<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\DataTables\CollectionsDataTable;
use Illuminate\Support\Facades\DB;
// Nama: Wandi Ridwansyah
// NIM: 6706220080
// Kelas: 46-03
class CollectionController extends Controller
{
    public function index(CollectionsDataTable $dataTable)
    {
        return $dataTable->render('koleksi.daftarKoleksi');
    }

    public function create()
    {
        return view('koleksi.registrasi');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaKoleksi' => ['required', 'string', 'max:100'],
            'jenisKoleksi' => ['required', 'integer', 'in:1,2,3'],
            'jumlahKoleksi' => ['required', 'integer']
        ]);

        Collection::create([
            'namaKoleksi' => $request->namaKoleksi,
            'jenisKoleksi' => $request->jenisKoleksi,
            'jumlahKoleksi' => $request->jumlahKoleksi
        ]);
        return redirect()->route('collection.index');
    }


    // Nama: Wandi Ridwansyah
    // NIM: 6706220080
    // Kelas: 46-03
    
    public function show(Collection $collection)
    {
        return view('koleksi.infoKoleksi', compact('collection'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'namaKoleksi' => ['required', 'string', 'max:100'],
            'jenisKoleksi' => ['required', 'integer', 'in:1,2,3'],
            'jumlahKoleksi' => ['required', 'integer']
        ]);

        DB::table('collections')
            ->where('id', $request->id)
            ->update([
                'namaKoleksi' => $request->namaKoleksi,
                'jenisKoleksi' => $request->jenisKoleksi,
                'jumlahKoleksi' => $request->jumlahKoleksi
            ]);

        return redirect()->route('collection.index');
    }
}
