<?php

namespace Database\Factories;

use App\Models\Etudiant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Etudiant>
 */
class EtudiantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $noms = ['Alami', 'Bennani', 'Chraibi', 'Idrissi', 'Mansouri', 'Tazi', 'Kabbaj', 'Fassi', 'Guerrouj', 'Zaki', 'Lahlou', 'Amrani'];
        $prenomsM = ['Mohamed', 'Ahmed', 'Yassine', 'Omar', 'Hamza', 'Anas', 'Amine', 'Saad', 'Rayan', 'Youssef'];
        $prenomsF = ['Fatima', 'Zineb', 'Meriem', 'Salma', 'Khadija', 'Layla', 'Sara', 'Hiba', 'Imane', 'Ghita'];
        
        $sexe = $this->faker->randomElement(['M', 'F']);
        $prenom = ($sexe == 'M') ? $this->faker->randomElement($prenomsM) : $this->faker->randomElement($prenomsF);
        $nom = $this->faker->randomElement($noms);

        return [
            'cin_etudiant' => $this->faker->unique()->bothify('??######'),
            'massar_id' => $this->faker->unique()->bothify('?#########'),
            'nom' => $nom,
            'prenom' => $prenom,
            'date_naissance' => $this->faker->date('Y-m-d', '-15 years'),
            'lieu_naissance' => $this->faker->randomElement(['Casablanca', 'Rabat', 'Fès', 'Marrakech', 'Tanger']),
            'sexe' => $sexe,
            'adresse' => $this->faker->address(),
            'ville' => $this->faker->randomElement(['Casablanca', 'Rabat', 'Fès', 'Marrakech', 'Tanger']),
            'nom_parent' => $this->faker->randomElement($noms) . ' ' . $this->faker->randomElement($prenomsM),
            'telephone_parent' => $this->faker->numerify('06########'),
            'email_parent' => $this->faker->unique()->safeEmail(),
            'statut' => 'actif',
        ];
    }
}
