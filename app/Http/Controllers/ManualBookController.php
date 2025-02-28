<?php

namespace App\Http\Controllers;

use App\Models\ManualBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\Http\Controllers\redirect;
use Illuminate\Support\Facades\Log;


class ManualBookController extends Controller
{
    public function index()
    {
        $data = ManualBook::paginate(10);
        return view('dashboard.manualbook', compact('data'));
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:10240',
            'document_name' => 'required|string',
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

    public function show($id)
    {
        $data = ManualBook::findOrFail($id);
        return view('show', compact('data'));
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
        return redirect()->route('dashboard.manualbook')->with('success', 'Manual Book berhasil dihapus.');
    }

    public function download($filename)
    {
        $documen_path = 'app/public/uploads/' . $filename; // Sesuaikan dengan path penyimpanan
        if (Storage::exists($documen_path)) {
            return Storage::download($documen_path);
        } else {
            return response()->json(['error' => 'File not found!'], 404);
        }
    }

    // public function search(Request $request)
    // {
    //     $query = $request->input('search');

    //     if ($request->ajax()) {
    //         $data = ManualBook::where('document_name', 'LIKE', "%{$query}%")
    //             ->paginate(10);

    //         return view('partials.manualbookList', compact('data'))->render();
    //     }
    // }

    public function search(Request $request)
    {
        Log::info("Menerima pencarian: " . $request->input('search'));

        $query = $request->input('search');

        if (empty($query)) {
            return response()->json(['html' => '<div class="alert alert-warning">Masukkan kata kunci pencarian.</div>']);
        }

        $data = ManualBook::where('document_name', 'LIKE', "%{$query}%")->get();

        Log::info("Hasil query: ", ['data' => $data]);

        if ($data->isEmpty()) {
            return response()->json(['html' => '<div class="alert alert-info">No results found.</div>']);
        }

        return response()->json(['data' => $data]);
    }
}
