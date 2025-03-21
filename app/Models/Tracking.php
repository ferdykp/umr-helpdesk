<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    protected $table = 'trackings';

    protected $fillable = [
        'tanggal_update',
        'nama_sparepart',
        'status',
        'jumlah_barang',
        'satuan',
        'kategori_barang',
        'vendor_teknisi',
        'pic',
        'catatan',
    ];
}
