<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            EtablissementSeeder::class,
            AnneeScolaireSeeder::class,
            NiveauSeeder::class,
            MatiereSeeder::class,
            UserSeeder::class,
            EnseignantSeeder::class,
            ClasseSeeder::class,
            EtudiantSeeder::class,
        ]);
    }
}
