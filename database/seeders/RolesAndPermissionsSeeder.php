<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'manage etablissement',
            'manage annee scolaire',
            'manage niveaux',
            'manage filieres',
            'manage classes',
            'manage matieres',
            'manage enseignants',
            'manage etudiants',
            'view dashboard',
            'saisie absences',
            'manage justifications',
            'view rapports',
            'manage parametres',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create roles and assign permissions
        $adminRole = Role::firstOrCreate(['name' => 'ADMIN', 'guard_name' => 'web']);
        $adminRole->givePermissionTo(Permission::all());

        Role::firstOrCreate(['name' => 'DIRECTEUR', 'guard_name' => 'web'])->givePermissionTo([
            'view dashboard',
            'view rapports',
            'manage etudiants',
            'manage classes',
        ]);

        Role::firstOrCreate(['name' => 'ENSEIGNANT', 'guard_name' => 'web'])->givePermissionTo([
            'view dashboard',
            'saisie absences',
        ]);

        Role::firstOrCreate(['name' => 'SURVEILLANT', 'guard_name' => 'web'])->givePermissionTo([
            'view dashboard',
            'saisie absences',
            'manage justifications',
            'manage etudiants',
        ]);

        Role::firstOrCreate(['name' => 'PARENT', 'guard_name' => 'web'])->givePermissionTo([
            'view dashboard',
        ]);
    }
}
