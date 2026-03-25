<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Classe;
use App\Models\AnneeScolaire;
use App\Models\Enseignant;
use App\Models\Niveau;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $annee = AnneeScolaire::where('is_active', true)->first();
        $enseignant = Enseignant::first();
        $niveaux = Niveau::with('filieres')->get();

        foreach ($niveaux as $niveau) {
            if ($niveau->filieres->isNotEmpty()) {
                foreach ($niveau->filieres as $filiere) {
                    Classe::create([
                        'libelle' => $niveau->libelle . ' - ' . $filiere->libelle . ' 1',
                        'niveau_id' => $niveau->id,
                        'filiere_id' => $filiere->id,
                        'annee_scolaire_id' => $annee->id,
                        'capacite' => 30,
                        'titulaire_id' => $enseignant->id,
                    ]);
                }
            } else {
                Classe::create([
                    'libelle' => $niveau->libelle . ' 1',
                    'niveau_id' => $niveau->id,
                    'annee_scolaire_id' => $annee->id,
                    'capacite' => 30,
                    'titulaire_id' => $enseignant->id,
                ]);
            }
        }
    }
}
