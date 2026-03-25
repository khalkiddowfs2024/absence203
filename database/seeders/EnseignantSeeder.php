<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Enseignant;
use Illuminate\Support\Facades\Hash;

class EnseignantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::create([
            'name' => 'Mohamed Alami',
            'email' => 'alami@antigravity.ma',
            'password' => Hash::make('password'),
            'role' => 'enseignant'
        ]);
        $user1->assignRole('ENSEIGNANT');

        Enseignant::create([
            'user_id' => $user1->id,
            'cin' => 'AB123456',
            'nom' => 'Alami',
            'prenom' => 'Mohamed',
            'specialite' => 'Mathématiques',
        ]);
    }
}
