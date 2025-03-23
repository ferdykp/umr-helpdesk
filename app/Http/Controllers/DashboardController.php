<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;


class DashboardController extends Controller
{
    public function index()
    {
        $notes = Maintenance::latest()->take(5)->get(); // Ambil 5 catatan terbaru
        return view('dashboard.index', compact('notes'));
    }
}
