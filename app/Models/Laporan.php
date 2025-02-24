<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';
    protected $fillable = [
        'nama_teknisi',
        'keterangan_kerusakan',
        'penyebab_kerusakan',
        'tanggal_kerusakan',
        'shift',
        'lokasi_mesin',
        'kategori_mesin',
        'metode_perbaikan',
        'tanggal_perbaikan',
        'catatan',
        'status'
    ];
}
