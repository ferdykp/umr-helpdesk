<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Schema;
use App\Exports\MachineExport;
use App\Libraries\DKAppCRUD;
use App\Models\Machine;
use Maatwebsite\Excel\Facades\Excel;

class MachineController extends Controller
{

    public function __construct()
    {
        $this->controllerId = 'machine';
    }

    public function index()
    {
        // $laporan = Laporan::all()->paginate(10);
        // return view('dashboard.machine');

        $crud = new DKAppCRUD();
        $crud->TableId($this->controllerId);
        $crud->UrlGet(route('machine.data'));
        $crud->Column(['#', 'Mesin', 'Lokasi', 'Aksi']);
        $crud->thClass(['text-center', 'text-center', 'text-center', 'text-center']);
        $data = $crud->render();
        return view('dashboard.machine2', compact('data'));
    }

    public function data()
    {
        $machines = machine::select(['idmachine', 'machine_name', 'machine_location']);
        return response()->json($machines->get());
    }
}
