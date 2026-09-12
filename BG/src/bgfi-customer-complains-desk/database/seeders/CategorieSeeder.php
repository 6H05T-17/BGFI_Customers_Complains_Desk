<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // fix list of categories
        $categories = [
        'Carte bancaire', 'Application mobile', 'Virement', 'Crédit',
        'Compte bancaire', 'Frais bancaires', 'Distributeur automatique', 'Autres'
    ];

    foreach ($categories as $categorie) {
        \App\Models\Categorie::create(['name' => $categorie]);
    }
    }
}
