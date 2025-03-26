<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth; // Make sure to use this import
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
        $laporan = Laporan::paginate(10);
        return view('report.index', compact('laporan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('report.create');
    }

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
            'waktu_perbaikan' => 'nullable',
            'metode_perbaikan' => 'nullable',
            'catatan' => 'nullable',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Tambahkan validasi gambar
            'status' => 'required'
        ]);

        $laporan = new Laporan($request->except('foto'));

        // Simpan file foto jika ada
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('laporan_foto', 'public');
            $laporan->foto = $fotoPath;
        }

        $laporan->save();

        return redirect()->route('report')->with('success', 'Laporan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $laporan = Laporan::findOrFail($id);

        return view('report.detail', compact('laporan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('report')->with('error', 'Anda tidak memiliki akses untuk mengedit laporan.');
        };
        $laporan = Laporan::findOrFail($id);
        return view('report.edit', compact('laporan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('report')->with('error', 'Anda tidak memiliki akses untuk mengubah laporan.');
        };
        $request->validate([
            'nama_teknisi' => 'required',
            'keterangan_kerusakan' => 'required',
            'penyebab_kerusakan' => 'nullable',
            'tanggal_kerusakan' => 'required',
            'shift' => 'required',
            'lokasi_mesin' => 'required',
            'kategori_mesin' => 'required',
            'catatan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Tambahkan validasi gambar
            'status' => 'required'
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->fill($request->except('foto'));

        // Simpan file foto jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($laporan->foto) {
                \Storage::delete('public/' . $laporan->foto);
            }

            $fotoPath = $request->file('foto')->store('laporan_foto', 'public');
            $laporan->foto = $fotoPath;
        }

        $laporan->save();

        return redirect()->route('report')->with('success', 'Laporan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('report')->with('error', 'Anda tidak memiliki akses untuk menghapus laporan.');
        };
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();

        return redirect('report')->with('success', 'Laporan berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('report')->with('error', 'Anda tidak memiliki akses untuk menghapus laporan.');
        };
        try {
            $ids = $request->input('ids', []);
            if (empty($ids)) {
                return response()->json(['success' => false, 'message' => 'Tidak ada data yang dipilih.']);
            }

            Laporan::whereIn('id', $ids)->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function export()
    {
        return Excel::download(new LaporanExport, 'laporan.xlsx');
    }

    public function search(Request $request)
    {
        try {
            $query = $request->input('search');
            $shift = $request->input('shift');
            $location = $request->input('location');
            $machine = $request->input('machine');

            $laporan = Laporan::query();

            if (!empty($query)) {
                $laporan->where(function($q) use ($query) {
                    foreach (Schema::getColumnListing('laporan') as $column) {
                        $q->orWhere($column, 'LIKE', "%$query%");
                    }
                });
            }

            if (!empty($shift)) {
                $laporan->where('shift', $shift);
            }

            if (!empty($location)) {
                $laporan->where('lokasi_mesin', $location);
            }

            if (!empty($machine)) {
                $laporan->where('kategori_mesin', $machine);
            }

            $laporan = $laporan->paginate(10);

            // Make sure we're using the correct variable name to match your view
            $data = $laporan;
            $html = view('report.table', compact('data'))->render();

            return response()->json(['html' => $html]);

        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Search error: ' . $e->getMessage());

            // Return empty results instead of an error
            $data = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10);
            $html = view('report.table', compact('data'))->render();

            return response()->json(['html' => $html]);
        }
    }
}
