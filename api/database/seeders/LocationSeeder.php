<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run()
    {
        $locations = [
            [
                'latitude' => '-23.5505',
                'longitude' => '-46.6333',
                'photo' => 'ubs_centro.jpg',
            ],
            [
                'latitude' => '-23.5605',
                'longitude' => '-46.6433',
                'photo' => 'hospital_municipal.jpg',
            ],
            [
                'latitude' => '-23.5405',
                'longitude' => '-46.6233',
                'photo' => 'ubs_norte.jpg',
            ],
            [
                'latitude' => '-23.5705',
                'longitude' => '-46.6533',
                'photo' => 'posto_sul.jpg',
            ],
            [
                'latitude' => '-23.5555',
                'longitude' => '-46.6383',
                'photo' => 'centro_especialidades.jpg',
            ],
        ];

        foreach ($locations as $locationData) {
            Location::create($locationData);
        }
    }
}