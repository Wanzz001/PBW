<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Nama: Wandi Ridwansyah
// NIM: 6706220080
// Kelas: 46-03

class DetailTransaction extends Model
{
    protected $table = 'detail_transactions'; 
    protected $fillable = ['transactionId', 'collectionId', 'tanggalKembali', 'status','keterangan'];

}
