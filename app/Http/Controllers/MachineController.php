<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Machine;
use Illuminate\Support\Facades\Auth;

class MachineController extends Controller
{

    public function index()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses.');
        };
        $machine = Machine::paginate(10);
        return view('machine.index', compact('machine'));
    }

    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses.');
        };
        $request->validate([
            'machine_name' => 'required',
        ]);

        Machine::create($request->all());

        return redirect()->route('machine')->with('success', 'Mesin ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses.');
        };
        $machine = Machine::findOrFail($id);

        $request->validate([
            'machine_name' => 'required',
        ]);

        $machine->update($request->all());

        return redirect()->route('machine')->with('success', 'Mesin berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses.');
        };
        $machine = Machine::findOrFail($id);
        $machine->delete();

        return redirect('machine')->with('success', 'Mesin berhasil dihapus.');
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

            Machine::whereIn('id', $ids)->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
