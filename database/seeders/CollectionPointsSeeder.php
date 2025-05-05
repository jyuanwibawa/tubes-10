<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CollectionPoint;

class CollectionPointsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sites = [
            [
                'name' => 'TPA Sarimukti',
                'type' => 'TPA',
                'lat' => -6.8336,
                'lng' => 107.6695,
                'description' => 'Regional final waste disposal site serving Bandung'
            ],
            [
                'name' => 'TPA Jelekong',
                'type' => 'TPA',
                'lat' => -6.9715,
                'lng' => 107.5941,
                'description' => 'Final waste disposal site in south Bandung area'
            ],
            [
                'name' => 'TPS Ciroyom',
                'type' => 'TPS',
                'lat' => -6.9139,
                'lng' => 107.5918,
                'description' => 'Temporary waste collection point in Ciroyom'
            ],
            [
                'name' => 'TPS Balubur',
                'type' => 'TPS',
                'lat' => -6.9025,
                'lng' => 107.6086,
                'description' => 'Temporary waste collection near city center'
            ],
            [
                'name' => 'TPS Cicadas',
                'type' => 'TPS',
                'lat' => -6.9099,
                'lng' => 107.6422,
                'description' => 'Temporary waste collection in eastern Bandung'
            ],
            [
                'name' => 'TPS Soekarno-Hatta',
                'type' => 'TPS',
                'lat' => -6.9385,
                'lng' => 107.6548,
                'description' => 'Waste collection point along Soekarno-Hatta corridor'
            ],
            [
                'name' => 'TPS Cibeunying',
                'type' => 'TPS',
                'lat' => -6.8988,
                'lng' => 107.6295,
                'description' => 'Serves the Cibeunying district area'
            ],
            [
                'name' => 'TPS Cijerah',
                'type' => 'TPS',
                'lat' => -6.9342,
                'lng' => 107.5654,
                'description' => 'Collection point in western Bandung'
            ],
            [
                'name' => 'TPS Cibiru',
                'type' => 'TPS',
                'lat' => -6.9391,
                'lng' => 107.7102,
                'description' => 'Serves the eastern outskirts of Bandung'
            ],
            [
                'name' => 'TPS Gedebage',
                'type' => 'TPS',
                'lat' => -6.9417,
                'lng' => 107.6867,
                'description' => 'Major transfer station in southeastern Bandung'
            ],
            [
                'name' => 'TPS Leuwigajah',
                'type' => 'TPS',
                'lat' => -6.9047,
                'lng' => 107.5436,
                'description' => 'Collection point serving western industrial area'
            ],
            [
                'name' => 'TPS Pasir Impun',
                'type' => 'TPS',
                'lat' => -6.8902,
                'lng' => 107.6587,
                'description' => 'Serves the northeastern residential areas'
            ]
        ];

        foreach ($sites as $site) {
            CollectionPoint::create($site);
        }
    }
}