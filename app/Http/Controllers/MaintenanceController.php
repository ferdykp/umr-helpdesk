<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Maintenance;


class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { {
            $notes = Maintenance::all();
            return view('components.maintenance', compact('notes'));
        }
    }

    public function dashboard()
    {
        $notes = Maintenance::latest()->take(5)->get(); // Ambil 5 catatan terbaru
        return view('dashboard.index', compact('notes'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'note' => 'required|string',
        ]);

        Maintenance::create($request->all());

        return redirect()->back()->with('success', 'Catatan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
