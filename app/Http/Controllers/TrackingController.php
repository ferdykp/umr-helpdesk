<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tracking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class TrackingController extends Controller
{
    public function index()
    {
        $trackings = Tracking::paginate(10);
        return view('tracking.index', compact('trackings'));
    }
    public function create()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('tracking')->with('error', 'Anda tidak memiliki akses.');
        };
        return view('tracking.create');
    }
    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('tracking')->with('error', 'Anda tidak memiliki akses.');
        };
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
        return redirect()->route('tracking')->with('success', 'tracking berhasil ditambahkan.');
    }
    public function edit(string $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('tracking')->with('error', 'Anda tidak memiliki akses.');
        };
        $trackings = Tracking::findOrFail($id);
        return view('tracking.edit', compact('trackings'));
    }
    public function update(Request $request, string $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('tracking')->with('error', 'Anda tidak memiliki akses.');
        };
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
        return redirect()->route('tracking')->with('success', 'tracking berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('tracking')->with('error', 'Anda tidak memiliki akses.');
        };
        $tracking = Tracking::findOrFail($id);
        $tracking->delete();
        return redirect()->route('tracking')->with('success', 'tracking Tracking berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('tracking')->with('error', 'Anda tidak memiliki akses.');
        };
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

        /*return Excel::download(new trackingExport, 'sparepart.xlsx');*/
    }
    public function search(Request $request)
    {
        try {
            $query = $request->input('query');

            $tracking = Tracking::query();

            if (!empty($query)) {
                $tracking->where(function ($q) use ($query) {
                    foreach (Schema::getColumnListing('trackings') as $column) {
                        $q->orWhere($column, 'LIKE', "%$query%");
                    }
                });
            }

            $tracking = $tracking->paginate(10);

            if ($request->ajax()) {
                $data = $tracking;
                $html = view('tracking.table', [
                    'data' => $data,
                    'routePrefix' => 'tracking',
                ])->render();

                return response()->json(['html' => $html]);
            }

            return view('tracking.index', compact('tracking'));
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Tracking search error: ' . $e->getMessage());

            if ($request->ajax()) {
                $data = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10);
                $html = view('tracking.table', [
                    'data' => $data,
                    'routePrefix' => 'tracking',
                ])->render();

                return response()->json(['html' => $html]);
            }

            // Return empty results instead of an error
            $tracking = Tracking::where('id', 0)->paginate(10); // Empty result set
            return view('tracking.index', compact('tracking'))->with('error', 'An error occurred during search.');
        }
    }
}
