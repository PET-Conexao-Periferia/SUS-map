<?php

namespace App\Services;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CampaignService
{
    /**
     * Obter todas as campanhas ativas
     */
    public function getAllActiveCampaigns()
    {
        return Campaign::with('locations.description')
            ->where('endTime', '>=', now())
            ->get();
    }

    /**
     * Obter uma campanha específica
     */
    public function getCampaign($id)
    {
        return Campaign::with(['locations.description'])->findOrFail($id);
    }

    /**
     * Criar uma nova campanha
     */
    public function createCampaign(array $data)
    {
        $campaign = Campaign::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'startTime' => $data['startTime'],
            'endTime' => $data['endTime'],
        ]);

        // Associa os locais à campanha
        if (isset($data['locationIds'])) {
            $campaign->locations()->attach($data['locationIds']);
        }

        return $campaign->load('locations');
    }

    /**
     * Atualizar uma campanha existente
     */
    public function updateCampaign(Campaign $campaign, array $data)
    {
        $campaign->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'startTime' => $data['startTime'],
            'endTime' => $data['endTime'],
        ]);

        // Atualiza os locais associados
        //if (isset($data['locationIds'])) {
         //   $campaign->locations()->sync($data['locationIds']);
       // }

      //  return $campaign->load('locations');
    }

    /**
     * Excluir uma campanha
     */
    public function deleteCampaign(Campaign $campaign)
    {
        return $campaign->delete();
    }

    /**
     * Validar dados da campanha
     */
    public function validateCampaignData(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'startTime' => 'required|date',
            'endTime' => 'required|date|after_or_equal:startTime',
            //'locationIds' => 'required|array',
            //'locationIds.*' => 'exists:locations,id'
        ]);
    }
}
