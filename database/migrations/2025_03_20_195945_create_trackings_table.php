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
        Schema::create('trackings', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_update');
            $table->string('nama_sparepart');
            $table->string('status');
            $table->integer('jumlah_barang');
            $table->string('satuan');
            $table->string('kategori_barang');
            $table->string('vendor_teknisi')->nullable();
            $table->string('pic')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trackings');
    }
};
