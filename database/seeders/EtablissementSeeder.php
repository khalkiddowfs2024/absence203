<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Etablissement;

class EtablissementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Etablissement::create([
            'nom' => 'Lycée Technique Al-Farabi',
            'adresse' => 'Avenue Mohammed V',
            'ville' => 'Casablanca',
            'telephone' => '0522001122',
            'directeur' => 'Ahmed Mansouri',
            'academie' => 'Grand Casablanca Settat',
        ]);
    }
}
