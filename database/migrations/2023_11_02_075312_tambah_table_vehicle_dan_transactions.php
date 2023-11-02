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

        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->tinyInteger('status') -> nullable();
        });
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->unsignedBigInteger('typeId');
            $table->foreign('typeId')->references('id')->on('types');
            $table->string('license',10);
            $table->integer('dailyPrice');
            $table->tinyInteger('status') -> nullable();
        });
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('id')->on('users');
            $table->unsignedBigInteger('vehicleId');
            $table->foreign('vehicleId')->references('id')->on('vehicles');
            $table->date('startDate');
            $table->date('endDate');
            $table->integer('price');
            $table->tinyInteger('status') -> nullable();
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
