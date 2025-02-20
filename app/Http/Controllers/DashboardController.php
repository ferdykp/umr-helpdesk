<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        // dd(auth()->user());
        return view('dashboard.index');
    }
}
