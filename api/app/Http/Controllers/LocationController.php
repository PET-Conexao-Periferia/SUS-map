<?php

namespace App\Http\Controllers;

use App\Http\Requests\Location\StoreLocationRequest;
use App\Http\Requests\Location\UpdateLocationRequest;
use Illuminate\Http\Request;
use \App\Models\Location;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response(Location::paginate(), 200);
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

        response($location, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
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
