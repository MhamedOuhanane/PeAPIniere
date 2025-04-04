<?php

namespace Database\Factories;

use App\Models\Categorie;
use App\Models\Plante;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plante>
 */
class PlanteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->sentence(3);
        (new Plante)->getSlugOptions()->generateSlugsFrom($name);
        return [
            'name' => $name,
            'description' => $this->faker->paragraph(),
            'prix' => $this->faker->randomFloat(2, 20, 200),
            'categorie_id' => $this->faker->randomElement(Categorie::pluck('id')->toArray()),
        ];
    }
}
