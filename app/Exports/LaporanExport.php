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
            "keterangan_kerusakan",
            "penyebab_kerusakan",
            "tanggal_kerusakan",
            "shift",
            "nama_teknisi",
            "lokasi_mesin",
            "kategori_mesin",
            "tanggal_kerusakan",
            "waktu_perbaikan",
            "status",
            "metode_perbaikan",
            "catatan"
        )->get();
    }

    public function headings(): array
    {
        return [
            'Keterangan Kerusakan',
            'Penyebab Kerusakan',
            'Tanggal Kerusakan',
            'Shift',
            'Nama Teknisi',
            'Lokasi Mesin',
            'Kategori Mesin',
            'Tanggal Kerusakan',
            'Waktu Perbaikan',
            'Status',
            'Metode Perbaikan',
            'Catatan'
        ];
    }
}
