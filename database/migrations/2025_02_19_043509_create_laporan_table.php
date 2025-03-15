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
            $table->string('keterangan_kerusakan')->nullable();
            $table->string('penyebab_kerusakan')->nullable();
            $table->date('tanggal_kerusakan');
            $table->enum('shift', ['SHIFT 1', 'SHIFT 2', 'SHIFT BU', 'Long Shift'])->charset('utf8mb4');
            $table->enum('lokasi_mesin', ['410', '280', 'INDIGO']);
            $table->string('kategori_mesin'); // Engkok atek master
            $table->date('tanggal_perbaikan')->nullable();
            $table->string('metode_perbaikan')->nullable();
            $table->string('catatan')->nullable();
            $table->enum('status', ['Belum Mulai', 'Dalam Proses', 'Selesai']);
            $table->string('foto')->nullable();
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
