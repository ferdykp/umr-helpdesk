<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tracking;

class TrackingController extends Controller
{
    public function index()
    {
        $trackings = Tracking::paginate(10);
        return view('dashboard.sparepartTracking', compact('trackings'));
    }
    public function create()
    {
        return view('createtracking');
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
        return view('partials.trackingEdit', compact('trackings'));
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

    public function export()
    {

        /*return Excel::download(new SparePartExport, 'sparepart.xlsx');*/
    }
}

