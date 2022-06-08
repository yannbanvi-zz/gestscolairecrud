<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Etudiant>
 */
class EtudiantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "nom" => $this->faker->name(),
            "prenom" => $this->faker->firstName(),
            "sexe" => ["M", "F"][rand(0, 1)],
            "age" => rand(10, 25),
            "niveau_scolaire_id" => rand(1, 4)
        ];
    }
}
