<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;

// Nama: Wandi Ridwansyah
// NIM: 6706220080
// Kelas: 46-03
class CollectionController extends Controller
{
    public function index()
    {
        $collections = Collection::all(); 
        return view('koleksi.daftarKoleksi', compact('collections'));
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

    public function show(Collection $collection)
    {
        return view('koleksi.infoKoleksi', compact('collection'));
    }
}
