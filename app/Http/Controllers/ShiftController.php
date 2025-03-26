<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;
use Illuminate\Support\Facades\Auth;

class ShiftController extends Controller
{

    public function index()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses.');
        };
        $shift = shift::paginate(10);
        return view('shift.index', compact('shift'));
    }

    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses.');
        };
        $request->validate([
            'shift_name' => 'required',
        ]);

        shift::create($request->all());

        return redirect()->route('shift')->with('success', 'Mesin ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses.');
        };
        $shift = shift::findOrFail($id);

        $request->validate([
            'shift_name' => 'required',
        ]);

        $shift->update($request->all());

        return redirect()->route('shift')->with('success', 'Mesin berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses.');
        };
        $shift = shift::findOrFail($id);
        $shift->delete();

        return redirect('shift')->with('success', 'Mesin berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses.');
        };
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
