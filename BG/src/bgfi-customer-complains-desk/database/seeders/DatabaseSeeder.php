<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{
    // Ordre important : on remplit les tables de référence d'abord
    $this->call([
        AgenceSeeder::class,
        ServiceSeeder::class,
        CategorieSeeder::class,
        PrioriteSeeder::class,
        ClientSeeder::class,
        UserSeeder::class,
    ]);
}
}
