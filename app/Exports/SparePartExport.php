<?php

namespace App\Exports;

use App\Models\SparePart;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SparePartExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return SparePart::select(
            "nama_sparepart",
            "kategori",
            "stok",
            "update_stok",
            "lokasi_penyimpanan",
            "status",
            "catatan"
        )->get();
    }

    public function headings(): array
    {
        return [
            'Nama Sparepart',
            'Kategori',
            'Stok',
            'Update Stok',
            'Lokasi Penyimpanan',
            'Status',
            'Catatan',
        ];
    }
}
