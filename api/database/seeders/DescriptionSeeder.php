<?php
// filepath: c:\Users\joyce\OneDrive\Área de Trabalho\PET\MapaSus\SUS-map\api\database\seeders\DescriptionSeeder.php

namespace Database\Seeders;

use App\Models\Description;
use App\Models\Location;
use App\Models\OpeningTimes;
use Illuminate\Database\Seeder;

class DescriptionSeeder extends Seeder
{
    public function run()
    {
        // Certificar que temos horários de funcionamento
        $openingTimeId = $this->ensureOpeningTimeExists();
        
        // Obter todos os locations para associar descriptions
        $locations = Location::all();
        
        if ($locations->count() < 5) {
            $this->call(LocationSeeder::class);
            $locations = Location::all();
        }
        
        $names = [
            'UBS Centro',
            'Hospital Municipal',
            'UBS Bairro Norte',
            'Posto de Saúde Sul',
            'Centro de Especialidades',
        ];
        
        $addresses = [
            'Rua Principal, 123 - Centro',
            'Av. Saúde, 500 - Centro',
            'Rua das Flores, 45 - Bairro Norte',
            'Av. Brasil, 789 - Bairro Sul',
            'Rua dos Médicos, 100 - Jardim Paulista',
        ];
        
        foreach ($locations as $index => $location) {
            Description::create([
                'name' => $names[$index] ?? 'Unidade de Saúde ' . ($index + 1),
                'contact' => $addresses[$index] ?? 'Endereço não informado',
                'id_location' => $location->id,
                'id_openingTimes' => $openingTimeId
            ]);
        }
    }
    
    /**
     * Garantir que exista pelo menos um horário de funcionamento
     */
    private function ensureOpeningTimeExists(): int
    {
        $openingTime = OpeningTimes::first();
        
        if (!$openingTime) {
            // Criar horários de funcionamento para os dias da semana
            $days = ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
            $openingTimeId = 0;
            
            foreach ($days as $index => $day) {
                // Para sábado, horário diferente
                $endTime = $day === 'Sábado' ? '12:00:00' : '18:00:00';
                
                $newOpeningTime = OpeningTimes::create([
                    'day' => $day,
                    'startTime' => '2023-01-01 08:00:00', // Data fictícia com o horário
                    'endTime' => '2023-01-01 ' . $endTime,  // Data fictícia com o horário
                ]);
                
                // Pega o ID do primeiro horário criado para retornar
                if ($index === 0) {
                    $openingTimeId = $newOpeningTime->id;
                }
            }
            
            return $openingTimeId;
        }
        
        return $openingTime->id;
    }
}