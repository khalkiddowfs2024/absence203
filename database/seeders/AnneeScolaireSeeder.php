<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AnneeScolaire;

class AnneeScolaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AnneeScolaire::create([
            'libelle' => '2025/2026',
            'date_debut' => '2025-09-01',
            'date_fin' => '2026-06-30',
            'is_active' => true,
        ]);

        AnneeScolaire::create([
            'libelle' => '2026/2027',
            'date_debut' => '2026-09-01',
            'date_fin' => '2027-06-30',
            'is_active' => false,
        ]);
    }
}
