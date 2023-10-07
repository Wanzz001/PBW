<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Nama: Wandi Ridwansyah
// NIM: 6706220080
// Kelas: 46-03
class Collection extends Model
{
    protected $table = 'collections'; 
    protected $fillable = ['namaKoleksi', 'jenisKoleksi', 'jumlahKoleksi'];
}
