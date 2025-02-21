<?php

namespace App\Http\Controllers;

use App\Models\ManualBook;
use Illuminate\Http\Request;

class ManualBookController extends Controller
{
    public function index()
    {
        $data = ManualBook::paginate(10);
        return view('testupload', compact('data'));
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:10240',
            'document_name' => 'required|string'
        ]);

        $file = $request->file('file');
        $document_name = $request->input('document_name');

        if (!str_ends_with(strtolower($document_name), '.pdf')) {
            $document_name .= '.pdf';
        }

        $document_name = time() . '-' . $document_name;

        if ($file) {
            $document_path = $file->storeAs('uploads', $document_name, 'public');

            $manualBook = new ManualBook();
            $manualBook->document_name = $request->input('document_name');
            $manualBook->document_path = $document_path;
            $manualBook->save();

            return redirect()->back()->with('success', 'File uploaded successfully!');
        } else {
            return redirect()->back()->with('error', 'No file selected!');
        }
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
