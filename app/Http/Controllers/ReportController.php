<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Container\Attributes\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;
use Illuminate\Support\Facades\Schema;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $laporan = Laporan::all()->paginate(10);
        return view('dashboard.report');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('create-laporan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_teknisi' => 'required',
            'keterangan_kerusakan' => 'required',
            'penyebab_kerusakan' => 'nullable',
            'tanggal_kerusakan' => 'required',
            'shift' => 'required',
            'lokasi_mesin' => 'required',
            'kategori_mesin' => 'required',
            'status' => 'required'
        ]);
        Laporan::create($request->all());
        return redirect()->route('dashboard')->with('success', 'Laporan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $laporan = Laporan::findOrFail($id);
        // return view('show-laporan', compact('laporan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $laporan = Laporan::findOrFail($id);
        // return view('edit-laporan', compact('laporan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_teknisi' => 'required',
            'keterangan_kerusakan' => 'required',
            'penyebab_kerusakan' => 'nullable',
            'tanggal_kerusakan' => 'required',
            'shift' => 'required',
            'lokasi_mesin' => 'required',
            'kategori_mesin' => 'required',
            'status' => 'required'
        ]);
        $laporan = Laporan::findOrFail($id);
        $laporan->update($request->all());
        return redirect()->route('dashboard')->with('success', 'Laporan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();

        return redirect('dashboard')->with('success', 'Laporan berhasil dihapus.');
    }

    public function export()
    {

        // return Excel::download(new LaporanExport, 'laporan.xlsx');
    }

    // public function import(Request $request)
    // {
    //     try {
    //         // Validasi file Excel yang diupload
    //         $request->validate([
    //             'file' => 'required|mimes:xlsx,csv', // Menjamin hanya file Excel yang bisa diupload
    //         ]);

    //         // Import file Excel
    //         Excel::import(new LaporanImport, $request->file('file'));

    //         // Redirect kembali ke dashboard dengan pesan sukses
    //         return redirect()->route('lainnya')->with(['success' => 'Data Lain berhasil diimport!']);
    //     } catch (\Exception $e) {
    //         // Redirect ke halaman error khusus
    //         return view('dashboard.error', ['error_message' => $e->getMessage()]);
    //     }
    // }

    // public function search(Request $request)
    // {
    //     $query = $request->input('search');
    //     $laporan = Laporan::where(function ($q) use ($query) {
    //         foreach (Schema::getColumnListing('laporan') as $column)
    //             $q->orWhere($column, 'LIKE', "%($query)");
    //     })->paginate(10);

    //     return view('dashboad', [
    //         'laporan' => $laporan
    //     ]);
    // }
}
