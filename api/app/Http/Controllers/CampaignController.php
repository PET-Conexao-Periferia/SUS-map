<?php
// filepath: c:\Users\joyce\OneDrive\Área de Trabalho\PET\MapaSus\SUS-map\api\app\Http\Controllers\CampaignController.php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CampaignController extends Controller
{
    /**
     * Display a listing of active campaigns.
     */
    public function index()
    {
        $campaigns = Campaign::with('locations')->get();
    
    // Log para debug
        \Log::info('Campanhas encontradas: ' . $campaigns->count());
    
        return response()->json($campaigns);
    }

    /**
     * Store a newly created campaign.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'startTime' => 'required|date',
            'endTime' => 'required|date|after_or_equal:startTime',
            'locationIds' => 'required|array',
            'locationIds.*' => 'exists:locations,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $campaign = Campaign::create([
            'name' => $request->name,
            'description' => $request->description,
            'startTime' => $request->startTime,
            'endTime' => $request->endTime,
        ]);

        // Associa os locais à campanha
        if ($request->has('locationIds')) {
            $campaign->locations()->attach($request->locationIds);
        }

        return response()->json($campaign->load('locations'), 201);
    }

    /**
     * Display the specified campaign.
     */
    public function show(Campaign $campaign)
    {
        return response()->json($campaign->load(['locations.description']));
    }
    
    /**
     * Update the specified campaign.
     */
    public function update(Request $request, Campaign $campaign)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'startTime' => 'required|date',
            'endTime' => 'required|date|after_or_equal:startTime',
            'locationIds' => 'required|array',
            'locationIds.*' => 'exists:locations,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $campaign->update([
            'name' => $request->name,
            'description' => $request->description,
            'startTime' => $request->startTime,
            'endTime' => $request->endTime,
        ]);

        // Atualiza os locais associados
        if ($request->has('locationIds')) {
            $campaign->locations()->sync($request->locationIds);
        }

        return response()->json($campaign->load('locations'));
    }

    /**
     * Remove the specified campaign.
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();
        return response()->json(null, 204);
    }
    
    /**
     * Get all locations for campaign selection
     */
    public function getLocations()
{
    try {
        $locations = Location::with('description')->get();
        
        $formattedLocations = [];
        foreach ($locations as $location) {
            $formattedLocations[] = [
                'id' => $location->id,
                'name' => $location->description ? $location->description->name : 'Sem nome',
                'address' => $location->description ? $location->description->contact : 'Sem endereço',
                'latitude' => $location->latitude,
                'longitude' => $location->longitude,
                'photo' => $location->photo,
            ];
        }
        
        \Log::info('Locais formatados: ' . json_encode($formattedLocations));
        return response()->json($formattedLocations);
    } catch (\Exception $e) {
        \Log::error('Erro em getLocations: ' . $e->getMessage());
        return response()->json([], 500);
    }
}
}