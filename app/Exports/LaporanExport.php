<?php

namespace App\Exports;

use App\Models\Laporan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Laporan::select(
            "nama_teknisi",
            "keterangan_kerusakan",
            "penyebab_kerusakan",
            "tanggal_kerusakan",
            "shift",
            "lokasi_mesin",
            "kategori_mesin",
            "status"
        )->get();
    }

    public function headings(): array
    {
        return [
            'Nama Teknisi',
            'Keterangan Kerusakan',
            'Penyebab Kerusakan',
            'Tanggal Kerusakan',
            'Shift',
            'Lokasi Mesin',
            'Kategori Mesin',
            'Status',
        ];
    }
}
