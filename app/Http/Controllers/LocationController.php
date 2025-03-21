<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{

    public function index()
    {
        $location = location::paginate(10);
        return view('location.index', compact('location'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'location_name' => 'required',
        ]);

        location::create($request->all());

        return redirect()->route('location')->with('success', 'Mesin ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $location = location::findOrFail($id);

        $request->validate([
            'location_name' => 'required',
        ]);

        $location->update($request->all());

        return redirect()->route('location')->with('success', 'Mesin berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $location = location::findOrFail($id);
        $location->delete();

        return redirect('location')->with('success', 'Mesin berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        try {
            $ids = $request->input('ids', []);
            if (empty($ids)) {
                return response()->json(['success' => false, 'message' => 'Tidak ada data yang dipilih.']);
            }

            location::whereIn('id', $ids)->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
