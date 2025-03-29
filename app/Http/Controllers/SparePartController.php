<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SparePart;
use App\Models\Location;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SparePartExport;
use illuminate\Support\Facades\Schema;


class SparePartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sparepart = Sparepart::paginate(10);
        return view('sparepart.index', compact('sparepart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('sparepart')->with('error', 'Anda tidak memiliki akses.');
        };

        $location = Location::all();
        /*dd($location);*/
        return view('sparepart.create', compact('location'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('sparepart')->with('error', 'Anda tidak memiliki akses.');
        };
        $request->validate([
            'nama_sparepart' => 'required',
            'kategori' => 'required',
            'stok' => 'required',
            'update_stok' => 'required',
            'lokasi_penyimpanan' => 'required',
            'status' => 'required',
            'catatan' => 'nullable',
        ]);
        SparePart::create($request->all());
        return redirect()->route('sparepart')->with('success', 'Sparepart berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     $sparepart = SparePart::findOrFail($id);
    //     return view('show-sparepart', compact('sparepart'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('sparepart')->with('error', 'Anda tidak memiliki akses.');
        };
        $sparepart = SparePart::findOrFail($id);
        // return view('edit-sparepart', compact('sparepart'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('sparepart')->with('error', 'Anda tidak memiliki akses.');
        };
        $request->validate([
            'nama_sparepart' => 'required',
            'kategori' => 'required',
            'stok' => 'required',
            'update_stok' => 'required',
            'lokasi_penyimpanan' => 'required',
            'status' => 'required',
            'catatan' => 'nullable',
        ]);
        $sparepart = SparePart::findOrFail($id);
        $sparepart->update($request->all());
        return redirect()->route('sparepart')->with('success', 'Sparepart berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('sparepart')->with('error', 'Anda tidak memiliki akses.');
        };
        $sparepart = SparePart::findOrFail($id);
        $sparepart->delete();
        return redirect()->route('sparepart')->with('success', 'Sparepart berhasil dihapus.');
    }

    public function export()
    {
        // return Excel::download(new SparePartExport, 'sparepart.xlsx');
    }
    public function search(Request $request)
    {
        try {
            $query = $request->input('query');

            $sparepart = SparePart::query();

            if (!empty($query)) {
                $sparepart->where(function ($q) use ($query) {
                    foreach (\Schema::getColumnListing('sparepart') as $column) {
                        $q->orWhere($column, 'LIKE', "%$query%");
                    }
                });
            }

            $sparepart = $sparepart->paginate(10);

            if ($request->ajax()) {
                $data = $sparepart;
                $html = view('sparepart.table', [
                    'data' => $data,
                    'routePrefix' => 'sparepart',
                ])->render();

                return response()->json(['html' => $html]);
            }

            return view('sparepart.index', compact('sparepart'));
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Spare part search error: ' . $e->getMessage());

            if ($request->ajax()) {
                $data = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10);
                $html = view('sparepart.table', [
                    'data' => $data,
                    'routePrefix' => 'sparepart',
                ])->render();

                return response()->json(['html' => $html]);
            }

            // Return empty results instead of an error
            $sparepart = SparePart::where('id', 0)->paginate(10); // Empty result set
            return view('sparepart.index', compact('sparepart'))->with('error', 'An error occurred during search.');
        }
    }

    public function bulkDelete(Request $request)
    {
        try {
            $ids = $request->input('ids', []);
            if (empty($ids)) {
                return response()->json(['success' => false, 'message' => 'Tidak ada data yang dipilih.']);
            }

            SparePart::whereIn('id', $ids)->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
