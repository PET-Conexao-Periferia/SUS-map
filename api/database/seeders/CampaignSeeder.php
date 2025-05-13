<?php
// filepath: c:\Users\joyce\OneDrive\Área de Trabalho\PET\MapaSus\SUS-map\api\database\seeders\CampaignSeeder.php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Location;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    public function run()
    {
        // Certifique-se de que existem locais para usar
        $locations = Location::all();
        
        if ($locations->isEmpty()) {
            // Criar alguns locais se não existirem
            $this->call(LocationSeeder::class);
            $locations = Location::all();
        }

        // Criar campanhas
        $campaigns = [
            [
                'name' => 'Vacinação contra Influenza',
                'description' => 'Campanha anual de vacinação contra a gripe. Disponível para todas as idades, com prioridade para idosos e crianças.',
                'startTime' => now(),
                'endTime' => now()->addMonths(2),
            ],
            [
                'name' => 'Prevenção de Diabetes',
                'description' => 'Campanha de conscientização sobre diabetes, com testes gratuitos de glicemia e orientações nutricionais.',
                'startTime' => now()->addDays(5),
                'endTime' => now()->addMonths(1),
            ],
            [
                'name' => 'Outubro Rosa',
                'description' => 'Campanha de conscientização sobre o câncer de mama, com exames gratuitos e palestras informativas.',
                'startTime' => now()->addMonth(),
                'endTime' => now()->addMonths(2),
            ],
            [
                'name' => 'Saúde Mental',
                'description' => 'Campanha com foco em saúde mental, oferecendo consultas com psicólogos e psiquiatras, além de atividades de bem-estar.',
                'startTime' => now()->addDays(10),
                'endTime' => now()->addMonths(3),
            ],
        ];

        foreach ($campaigns as $campaignData) {
            // Usa updateOrCreate para evitar duplicação em execuções múltiplas
            $campaign = Campaign::updateOrCreate(
                ['name' => $campaignData['name']],
                $campaignData
            );
            
            // Associar de 2 a 4 locais aleatórios a cada campanha
            $campaign->locations()->sync(
                $locations->random(rand(2, 4))->pluck('id')->toArray()
            );
        }
    }
}