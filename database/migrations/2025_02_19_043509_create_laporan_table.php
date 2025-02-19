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
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_teknisi');
            $table->string('keterangan_kerusakan');
            $table->string('penyebab_kerusakan');
            $table->dateTime('tanggal_kerusakan');
            $table->enum('shift', ['Shift 1', 'Shift 2', 'Shift BU', 'Long Shift'])->charset('utf8mb4');
            $table->enum('lokasi_mesin', ['410', '280', 'INDIGO']);
            $table->string('kategori_mesin');
            $table->enum('status', ['Belum Mulai', 'Dalam Proses', 'Selesai']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
