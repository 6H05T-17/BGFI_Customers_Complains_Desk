<?php

use App\Models\Agence;
use App\Models\Categorie;
use App\Models\Client;
use App\Models\Priorite;
use App\Models\Reclamation;
use App\Models\Service;
use App\Models\User;

test('admin can soft delete and restore a reclamation', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $agence = new Agence();
    $agence->name = 'Agence Test';
    $agence->save();

    $client = new Client();
    $client->nom = 'Dupont';
    $client->prenoms = 'Alice';
    $client->telephone = '0123456789';
    $client->email = 'alice.dupont@example.com';
    $client->agence_id = $agence->id;
    $client->save();

    $service = new Service();
    $service->name = 'Support client';
    $service->save();

    $categorie = new Categorie();
    $categorie->name = 'Facturation';
    $categorie->save();

    $priorite = new Priorite();
    $priorite->name = 'Urgente';
    $priorite->delay = '24h';
    $priorite->save();

    $reclamation = Reclamation::create([
        'numero' => 'REC-20260909-TEST',
        'date_creation' => now(),
        'client_id' => $client->id,
        'canal' => 'Email',
        'categorie_id' => $categorie->id,
        'description' => 'Réclamation de test pour la suppression soft delete',
        'priorite_id' => $priorite->id,
        'statut' => 'Nouvelle',
        'service_id' => $service->id,
        'date_limite' => now()->addDay(),
        'user_id' => $admin->id,
    ]);

    $this->actingAs($admin)
        ->delete(route('reclamations.destroy', $reclamation))
        ->assertRedirect(route('reclamations.index'));

    $this->assertSoftDeleted('reclamations', ['id' => $reclamation->id]);

    $this->actingAs($admin)
        ->post(route('reclamations.restore', $reclamation))
        ->assertRedirect(route('reclamations.trashed'));

    $this->assertDatabaseHas('reclamations', ['id' => $reclamation->id, 'deleted_at' => null]);
});
