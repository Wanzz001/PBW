<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Nama: Wandi Ridwansyah
// NIM: 6706220080
// Kelas: 46-03

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $fillable = ['userIdPetugas', 'userIdPeminjam', 'tanggalPinjam', 'tanggalKembali'];

    public function peminjam()
    {
        return $this->belongsTo(User::class, 'userIdPeminjam');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'userIdPetugas');
    }
}
