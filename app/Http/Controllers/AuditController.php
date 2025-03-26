<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audit;

class AuditController extends Controller
{
    public function index()
    {
        $data =Audit::paginate(10);
        return view('audit.index', compact('data'));
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

            $audit = new Audit();
            $audit->document_name = $request->input('document_name');
            $audit->document_path = $document_path;
            $audit->save();

            return redirect()->back()->with('success', 'File uploaded successfully!');
        } else {
            return redirect()->back()->with('error', 'No file selected!');
        }
    }

    public function show($id)
    {
        $data =Audit::findOrFail($id);
        return view('show', compact('data'));
    }

    public function edit($id)
    {
        $data =Audit::findOrFail($id);
        return view('audit.edit', compact('data'));
    }
    public function update(Request $request, $id)
    {
        $data =Audit::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('audit')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data =Audit::findOrFail($id);
        $data->delete();
        return redirect()->route('audit')->with('success', 'Audit Dokumen berhasil dihapus.');
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


    public function search(Request $request)
    {
        $query = $request->input('search');

        if (empty($query)) {
            return response()->json(['html' => '<div class="alert alert-warning">Masukkan kata kunci pencarian.</div>']);
        }

        $data =Audit::where('document_name', 'LIKE', "%{$query}%")->get();

        if ($data->isEmpty()) {
            return response()->json(['html' => '<div class="alert alert-info">No results found.</div>']);
        }

        // Add a unique prefix for search results to avoid ID conflicts
        $searchPrefix = 'search-' . time() . '-';

        // Render the partial view with the search results and prefix
        $html = view('audit.auditList', compact('data', 'searchPrefix'))->render();

        return response()->json(['html' => $html]);
    }
}
