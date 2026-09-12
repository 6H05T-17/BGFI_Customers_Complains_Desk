<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // attributes
            'nom' => fake()->lastName(),
            'prenoms' => fake()->firstName(),
            'telephone' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            // we take a random agence from the created ones
            'agence_id' => \App\Models\Agence::inRandomOrder()->first()->id,
        ];
    }
}
