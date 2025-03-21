<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Machine;
use App\Models\Location;
use App\Models\Shift;

class DataController extends Controller
{
    public function getMachines(Request $request)
    {
        $searchTerm = $request->input('term');
        $machines = Machine::where('machine_name', 'LIKE', "%{$searchTerm}%")->get();

        $results = [];
        foreach ($machines as $machine) {
            $results[] = [
                'id' => $machine->machine_name,
                'text' => $machine->machine_name,
            ];
        }

        return response()->json($results);
    }

    public function getLocations(Request $request)
    {
        $searchTerm = $request->input('term');
        $location = Location::where('location_name', 'LIKE', "%{$searchTerm}%")->get();

        $results = [];
        foreach ($location as $location) {
            $results[] = [
                'id' => $location->location_name,
                'text' => $location->location_name,
            ];
        }

        return response()->json($results);
    }

    public function getShifts(Request $request)
    {
        $searchTerm = $request->input('term');
        $shifts = Shift::where('shift_name', 'LIKE', "%{$searchTerm}%")->get();

        $results = [];
        foreach ($shifts as $shift) {
            $results[] = [
                'id' => $shift->shift_name,
                'text' => $shift->shift_name,
            ];
        }

        return response()->json($results);
    }
}
