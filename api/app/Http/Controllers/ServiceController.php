<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Location;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function index()
    {
        $services = Service::all();
        return response()->json($services, 200);
    }

    public function store(Request $request) //, $locationId
    {
        // $location = Location::findOrFail($locationId);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // $service = $location->services()->create($validated);
        $service = Service::create($validated);
        return response()->json($service, 201);
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $service->update($validated);

        return response()->json($service, 200);
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return response()->json(null, 204);
    }
}
