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
        //logica será bruscamente alterada!
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

        if(isset($validated['description'])) {
            $location->description()->create($validated['description']);

            // if(isset($validated['description']['openingTimes'])) {
            //     $location->description()->openingTimes()->createMany($validated['description']['openingTimes']);
            // }
        }

        if(isset($validated['services'])) {
                $services = [
                    'with_id' => [],
                    'without_id' => []
                ];

                foreach($validated['services'] as $service) {
                    if(isset($service['id'])) {
                        $services['with_id'][] = $service;
                    } else {
                        $services['without_id'][] = $service;
                    }
                }
                $location->services()->createMany($services['without_id']);
                $location->services()->attach($services['with_id']);
            }
        response($location, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        $location->load('campaigns', 'description', 'services');
        $location->description()->with('openingTimes');
        $location->services()->with('openingTimes');
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
