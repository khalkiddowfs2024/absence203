<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@antigravity.ma',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);
        $admin->assignRole('ADMIN');

        $directeur = User::create([
            'name' => 'Directeur User',
            'email' => 'directeur@antigravity.ma',
            'password' => Hash::make('password'),
            'role' => 'directeur'
        ]);
        $directeur->assignRole('DIRECTEUR');
    }
}
