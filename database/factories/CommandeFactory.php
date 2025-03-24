<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Plante;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commande>
 */
class CommandeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quantity' => $this->faker->numberBetween(1, 100), 
            'status' => $this->faker->randomElement(['En Attente', 'En Préparation', 'Livrée']),
            'client_id' => $this->faker->randomElement(Client::pluck('id')->toArray()), 
            'plante_id' => Plante::inRandomOrder()->first()->id,
        ];
    }
}
