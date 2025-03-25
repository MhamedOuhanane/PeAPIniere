<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $Admine = Role::firstOrCreate(['name' => 'admine', 'guard_name' => 'admin']);
        $Employe = Role::firstOrCreate(['name' => 'employe', 'guard_name' => 'employe']);
        $Client = Role::firstOrCreate(['name' => 'client', 'guard_name' => 'client']);
        return [
            'id' => $Client->id,
            'name' => $Client->name,
            'guard_name' => $Client->guard_name,
        ];
    }
}
