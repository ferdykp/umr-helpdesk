<?php

namespace App\Exports;

use App\Models\Laporan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class LaporanExport implements FromCollection, WithHeadings, WithMapping, WithDrawings, WithEvents
{
    private $laporan;

    public function __construct()
    {
        $this->laporan = Laporan::all();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->laporan;
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
            'Metode Perbaikan',
            'Tanggal Perbaikan',
            'Foto', // Kolom untuk gambar
            'Catatan',
            'Status'
        ];
    }

    public function map($laporan): array
    {
        return [
            $laporan->nama_teknisi,
            $laporan->keterangan_kerusakan,
            $laporan->penyebab_kerusakan,
            $laporan->tanggal_kerusakan,
            $laporan->shift,
            $laporan->lokasi_mesin,
            $laporan->kategori_mesin,
            $laporan->metode_perbaikan,
            $laporan->tanggal_perbaikan,
            $laporan->foto ? 'Foto tersedia' : 'Tidak ada foto',
            $laporan->catatan,
            $laporan->status
        ];
    }

    public function drawings()
    {
        $drawings = [];

        foreach ($this->laporan as $index => $laporan) {
            if ($laporan->foto) {
                $drawing = new Drawing();
                $drawing->setName('Foto Kerusakan');
                $drawing->setDescription('Foto Kerusakan');
                $drawing->setPath(storage_path('app/public/' . $laporan->foto)); // Path gambar dari storage
                $drawing->setHeight(50); // Tinggi gambar
                $drawing->setCoordinates('J' . ($index + 2)); // Letakkan di kolom Foto (J)
                $drawings[] = $drawing;
            }
        }

        return $drawings;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Atur lebar kolom
                $sheet->getColumnDimension('A')->setWidth(20); // Nama Teknisi
                $sheet->getColumnDimension('B')->setWidth(30); // Keterangan Kerusakan
                $sheet->getColumnDimension('C')->setWidth(30); // Penyebab Kerusakan
                $sheet->getColumnDimension('D')->setWidth(15); // Tanggal Kerusakan
                $sheet->getColumnDimension('E')->setWidth(12); // Shift
                $sheet->getColumnDimension('F')->setWidth(12); // Lokasi Mesin
                $sheet->getColumnDimension('G')->setWidth(15); // Kategori Mesin
                $sheet->getColumnDimension('H')->setWidth(25); // Metode Perbaikan
                $sheet->getColumnDimension('I')->setWidth(15); // Tanggal Perbaikan
                $sheet->getColumnDimension('J')->setWidth(20); // Foto
                $sheet->getColumnDimension('K')->setWidth(30); // Catatan
                $sheet->getColumnDimension('L')->setWidth(15); // Status

                // Atur tinggi baris agar gambar tidak terpotong
                foreach ($this->laporan as $index => $laporan) {
                    if ($laporan->foto) {
                        $sheet->getRowDimension($index + 2)->setRowHeight(50); // Tinggi baris untuk gambar
                    }
                }
            },
        ];
    }
}
