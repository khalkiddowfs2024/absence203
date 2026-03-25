<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Matiere;

class MatiereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $matieres = [
            ['libelle' => 'Mathématiques', 'code' => 'MATH', 'coefficient' => 5, 'volume_horaire_hebdo' => 5, 'type' => 'theorique'],
            ['libelle' => 'Français', 'code' => 'FR', 'coefficient' => 4, 'volume_horaire_hebdo' => 4, 'type' => 'theorique'],
            ['libelle' => 'Arabe', 'code' => 'AR', 'coefficient' => 4, 'volume_horaire_hebdo' => 4, 'type' => 'theorique'],
            ['libelle' => 'Physique-Chimie', 'code' => 'PC', 'coefficient' => 4, 'volume_horaire_hebdo' => 4, 'type' => 'theorique'],
            ['libelle' => 'Sciences de la Vie et de la Terre', 'code' => 'SVT', 'coefficient' => 3, 'volume_horaire_hebdo' => 3, 'type' => 'theorique'],
        ];

        foreach ($matieres as $matiereData) {
            Matiere::firstOrCreate(['code' => $matiereData['code']], $matiereData);
        }
    }
}
