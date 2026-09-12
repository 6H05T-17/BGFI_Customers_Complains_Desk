<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Fix list of services
        $services = ['Monetique', 'Crédit', 'Epargne', 'Compte courant', 'Assurance', 'Investissement', 'Service Client', 'Ressources Humaines', 'Informatique', 'Marketing', 'Ventes', 'Logistique'];
        return [
            'name' => fake()->randomElement($services),
        ];
    }
}
