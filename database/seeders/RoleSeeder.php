<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Admine = Role::firstOrCreate(['id' => 1, 'name' => 'admine', 'guard_name' => 'admin']);
        $Employe = Role::firstOrCreate(['id' => 2, 'name' => 'employe', 'guard_name' => 'employe']);
        $Client = Role::firstOrCreate(['id' => 3, 'name' => 'client', 'guard_name' => 'client']);
    }
}
