<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tracking;

class TrackingController extends Controller
{
    public function index()
    {
        $trackings = Tracking::paginate(10);
        return view('tracking.index', compact('trackings'));
    }
    public function create()
    {
        return view('tracking.create');
    }
    public function store(Request $request)
    {
        $request->validate([
        'nama_sparepart' => 'required|string|max:255',
        'tanggal_update' => 'nullable|date',
        'jumlah_barang' => 'nullable|integer',
        'kategori_barang' => 'nullable|string',
        'status' => 'required|string',
        'satuan' => 'required|string', // Tambahkan ini
        'vendor_teknisi' => 'nullable|string',
        'pic' => 'nullable|string',
        'catatan' => 'nullable|string',
        ]);
        Tracking::create($request->all());
        return redirect()->route('tracking')->with('success', 'Sparepart berhasil ditambahkan.');
    }
    public function edit(string $id)
    {
        $trackings = Tracking::findOrFail($id);
        return view('tracking.edit', compact('trackings'));
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
        'nama_sparepart' => 'required|string|max:255',
        'tanggal_update' => 'nullable|date',
        'jumlah_barang' => 'nullable|integer',
        'kategori_barang' => 'nullable|string',
        'status' => 'required|string',
        'satuan' => 'required|string', // Tambahkan ini
        'vendor_teknisi' => 'nullable|string',
        'pic' => 'nullable|string',
        'catatan' => 'nullable|string',
        ]);
        $tracking = Tracking::findOrFail($id);
        $tracking->update($request->all());
        return redirect()->route('tracking')->with('success', 'Sparepart berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $tracking = Tracking::findOrFail($id);
        $tracking->delete();
        return redirect()->route('tracking')->with('success', 'Sparepart Tracking berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        try {
            $ids = $request->input('ids', []);
            if (empty($ids)) {
                return response()->json(['success' => false, 'message' => 'Tidak ada data yang dipilih.']);
            }

            Tracking::whereIn('id', $ids)->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function export()
    {

        /*return Excel::download(new SparePartExport, 'sparepart.xlsx');*/
    }
}

