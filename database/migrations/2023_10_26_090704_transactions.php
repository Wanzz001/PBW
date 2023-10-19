<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userIdPetugas');
            $table->foreign('userIdPetugas')->references('id')->on('users');
            $table->unsignedBigInteger('userIdPeminjam');
            $table->foreign('userIdPeminjam')->references('id')->on('users');
            $table->date('tanggalPinjam');
            $table->date('tanggalSelesai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
