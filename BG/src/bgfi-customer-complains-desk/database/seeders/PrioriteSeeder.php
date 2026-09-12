<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Priorite;

class PrioriteSeeder extends Seeder
{
    public function run(): void
    {
        $priorites = [
            ['name' => 'Critique', 'delay' => '24 heures'],
            ['name' => 'Haute', 'delay' => '48 heures'],
            ['name' => 'Moyenne', 'delay' => '5 jours'],
            ['name' => 'Faible', 'delay' => '10 jours'],
        ];

        foreach ($priorites as $priorite) {
            Priorite::create($priorite);
        }
    }
}