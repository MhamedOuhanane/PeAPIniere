<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admine>
 */
class AdmineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => 1,
            'first_name' => "M'hamed",
            'last_name' => "Ouhanane",
            'email' => "mhmdeouhnane60@gmail.com",
            'password' => "mhmdemhmde1234",
            'role_id' => 1,
         ];
    }
}
