<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Machine;

class MachineController extends Controller
{

    public function index()
    {
        $machine = Machine::paginate(10);
        return view('machine.index', compact('machine'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'machine_name' => 'required',
        ]);

        Machine::create($request->all());

        return redirect()->route('machine')->with('success', 'Mesin ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $machine = Machine::findOrFail($id);

        $request->validate([
            'machine_name' => 'required',
        ]);

        $machine->update($request->all());

        return redirect()->route('machine')->with('success', 'Mesin berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $machine = Machine::findOrFail($id);
        $machine->delete();

        return redirect('machine')->with('success', 'Mesin berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
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