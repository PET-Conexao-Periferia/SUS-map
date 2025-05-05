<?php

namespace App\Http\Controllers;

use App\Http\Requests\Location\IndexLocationRequest;
use App\Http\Requests\Location\StoreLocationRequest;
use App\Http\Requests\Location\UpdateLocationRequest;
use Illuminate\Http\Request;
use \App\Models\Location;
use Illuminate\Support\Facades\Storage;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(indexLocationRequest $request)
    {
        $validated = $request->validated();

        //formula utilizada: Distância = raiz quadrada de (x2 - x1)² + (y2 - y1)²
        $locations = Location::selectRaw(
            '*, SQRT(POW(latitude - ?, 2) + POW(longitude - ?, 2)) as distance',
            [$validated['latitude'], $validated['longitude']]
        )
            ->orderBy('distance')
            ->paginate();

        return response($locations, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocationRequest $request)
    {
        $validated = $request->validated();

        if(isset($validated['photo'])) {
            $photoPath = $validated['photo']->store('photos', 'public');
            $validated['photo'] = $photoPath;
        }

        $location = Location::create($validated);

        if(isset($validated['description'])) {
            $location->description()->create($validated['description']);
        }

        if(isset($validated['services'])) {
                $location->services()->createMany($validated['services']);
        }

        response($location, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        $location->load('campaigns', 'description', 'services');
        response($location, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationRequest $request, Location $location)
    {
        $validated = $request->validated();
        if(isset($validated['photo'])) {
            $photoPath = $validated['photo']->store('photos', 'public');
            $validated['photo'] = $photoPath;
            Storage::delete('public/' . $location->photo);
        }
        $location->update($validated);
        response($location, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $location->delete();
        return response(null, 204);
    }
}
