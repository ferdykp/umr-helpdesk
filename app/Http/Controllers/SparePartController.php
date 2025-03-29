<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SparePart;
use App\Models\Location;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SparePartExport;


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
}
