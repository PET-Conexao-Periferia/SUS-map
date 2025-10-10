<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Location;
use App\Services\CampaignService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CampaignController extends Controller
{
    protected $campaignService;
    
    public function __construct(CampaignService $campaignService)
    {
        $this->campaignService = $campaignService;
    }

    /**
     * Display a listing of active campaigns.
     */
    public function index()
    {
        $campaigns = $this->campaignService->getAllActiveCampaigns();
        return response()->json($campaigns);
    }

    /**
     * Store a newly created campaign.
     */
    public function store(Request $request)
    {
        $validator = $this->campaignService->validateCampaignData($request->all());
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $campaign = $this->campaignService->createCampaign($request->all());
        return response()->json($campaign, 201);
    }

    /**
     * Display the specified campaign.
     */
    public function show(Campaign $campaign)
    {
        return response()->json($this->campaignService->getCampaign($campaign->id));
    }
    
    /**
     * Update the specified campaign.
     */
    public function update(Request $request, Campaign $campaign)
    {
        $validator = $this->campaignService->validateCampaignData($request->all());
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $updatedCampaign = $this->campaignService->updateCampaign($campaign, $request->all());
        return response()->json($updatedCampaign);
    }

    /**
     * Remove the specified campaign.
     */
    public function destroy(Campaign $campaign)
    {
        $this->campaignService->deleteCampaign($campaign);
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
            
            return response()->json($formattedLocations);
        } catch (\Exception $e) {
            \Log::error('Erro em getLocations: ' . $e->getMessage());
            return response()->json([], 500);
        }
    }
}