<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Niveau;

class NiveauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $college = Niveau::firstOrCreate(['libelle' => '1ère Année Collège'], ['cycle' => 'college', 'ordre' => 1]);
        $lycee = Niveau::firstOrCreate(['libelle' => 'Tronc Commun'], ['cycle' => 'lycee', 'ordre' => 4]);

        $filieres = [
            ['libelle' => 'Sciences'],
            ['libelle' => 'Lettres'],
            ['libelle' => 'Technique'],
        ];

        foreach ($filieres as $filiere) {
            $lycee->filieres()->firstOrCreate(['libelle' => $filiere['libelle']]);
        }
    }
}
