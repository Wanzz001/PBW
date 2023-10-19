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
        Schema::create('detail_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transactionId');
            $table->foreign('transactionId')->references('id')->on('transactions');
            $table->unsignedBigInteger('collectionId');
            $table->foreign('collectionId')->references('id')->on('collections');
            $table->date('tanggalKembali');
            $table->tinyInteger('status');
            $table->text('keterangan');
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
