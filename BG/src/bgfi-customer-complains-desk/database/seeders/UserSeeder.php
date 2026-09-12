<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1 Admin user
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@bgfigroupe.com',
            'password' => bcrypt('admin_password'),
            'role' => 'admin',
        ]);

        // 3 Responsable users
        \App\Models\User::factory(3)->create([
            'role' => 'responsable',
            'service_id' => \App\Models\Service::inRandomOrder()->first()->id,
        ]);

        // 10 Agent users
        \App\Models\User::factory(10)->create([
            'role' => 'agent',
            'service_id' => \App\Models\Service::inRandomOrder()->first()->id,
        ]);
    }
}
