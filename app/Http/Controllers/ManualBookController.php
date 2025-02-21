<?php

namespace App\Http\Controllers;

use App\Models\ManualBook;
use Illuminate\Http\Request;

class ManualBookController extends Controller
{
    public function index()
    {
        $data = ManualBook::all()->paginate(10);
        return view('manualbook.index', compact('data'));
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf',
        ]);
        $data = ManualBook::import($request->file('file'));
        return redirect()->route('manualbook.index')->with('success', 'Data berhasil diimport.');
    }
    public function edit($id)
    {
        $data = ManualBook::findOrFail($id);
        return view('manualbook.edit', compact('data'));
    }
    public function update(Request $request, $id)
    {
        $data = ManualBook::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('manualbook.index')->with('success', 'Data berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $data = ManualBook::findOrFail($id);
        $data->delete();
        return redirect()->route('manualbook.index')->with('success', 'Data berhasil dihapus.');
    }
}
