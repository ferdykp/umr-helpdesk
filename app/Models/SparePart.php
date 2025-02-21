<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePart extends Model
{
    use HasFactory;

    protected $table = 'sparepart';
    protected $fillable = [
        'nama_sparepart',
        'kategori',
        'stok',
        'update_stok',
        'lokasi_penyimpanan',
        'status',
        'catatan'
    ];
}
