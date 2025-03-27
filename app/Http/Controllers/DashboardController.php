<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;


class DashboardController extends Controller
{
    public function index()
    {
        $notes = Maintenance::where('status', 'belum selesai')->get();
        return view('dashboard.index', compact('notes'));
    }
}
