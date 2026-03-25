<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Etudiant;
use App\Models\Classe;
use App\Models\AnneeScolaire;

class EtudiantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = Classe::all();
        $annee = AnneeScolaire::where('is_active', true)->first();

        foreach ($classes as $classe) {
            Etudiant::factory()->count(25)->create([
                'classe_id' => $classe->id,
                'annee_scolaire_id' => $annee->id,
            ]);
        }
    }
}
