<?php

namespace App\Http\Controllers;

use App\Models\Description;
use App\Models\Location;
use Illuminate\Http\Request;

class DescriptionController extends Controller
{
    public function store(Request $request, $locationId)
    {
        $location = Location::findOrFail($locationId);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
        ]);

        $description = $location->description()->create($validated);

        return response()->json($description, 201);
    }

    public function update(Request $request, Description $description)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
        ]);

        $description->update($validated);

        return response()->json($description, 200);
    }

    public function destroy(Description $description)
    {
        $description->delete();
        return response()->json(null, 204);
    }
}
