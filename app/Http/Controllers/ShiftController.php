<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;

class ShiftController extends Controller
{

    public function index()
    {
        $shift = shift::paginate(10);
        return view('shift.index', compact('shift'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shift_name' => 'required',
        ]);

        shift::create($request->all());

        return redirect()->route('shift')->with('success', 'Mesin ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $shift = shift::findOrFail($id);

        $request->validate([
            'shift_name' => 'required',
        ]);

        $shift->update($request->all());

        return redirect()->route('shift')->with('success', 'Mesin berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $shift = shift::findOrFail($id);
        $shift->delete();

        return redirect('shift')->with('success', 'Mesin berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        try {
            $ids = $request->input('ids', []);
            if (empty($ids)) {
                return response()->json(['success' => false, 'message' => 'Tidak ada data yang dipilih.']);
            }

            shift::whereIn('id', $ids)->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
