<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    
    // Base de requête filtrée selon le rôle
    $baseQuery = \App\Models\Reclamation::query();
    if (in_array($user->role, ['agent', 'responsable'])) {
        $baseQuery->where('service_id', $user->service_id);
    }

    $stats = [
        // On clone la requête de base pour chaque calcul afin d'éviter les conflits
        'total' => (clone $baseQuery)->count(),
        'ouvertes' => (clone $baseQuery)->whereIn('statut', ['Nouvelle', 'Affectée', 'En cours de traitement', 'En attente client'])->count(),
        'cloturees' => (clone $baseQuery)->whereIn('statut', ['Résolue', 'Clôturée'])->count(),
        'en_retard' => (clone $baseQuery)->where('date_limite', '<', now())->whereNotIn('statut', ['Résolue', 'Clôturée'])->count(),
        
        'temps_moyen' => (clone $baseQuery)->whereIn('statut', ['Résolue', 'Clôturée'])
            ->selectRaw('AVG(TIMESTAMPDIFF(HOUR, created_at, updated_at)) as avg_hours')
            ->value('avg_hours'),

        'par_statut' => (clone $baseQuery)->selectRaw('statut, count(*) as count')->groupBy('statut')->pluck('count', 'statut'),
        'par_priorite' => (clone $baseQuery)->selectRaw('priorite_id, count(*) as count')->groupBy('priorite_id')->pluck('count', 'priorite_id'),
        
        // Correction du bug 'agences.nom' -> 'agences.name'
        'par_agence' => (clone $baseQuery)->join('clients', 'reclamations.client_id', '=', 'clients.id')
            ->join('agences', 'clients.agence_id', '=', 'agences.id')
            ->selectRaw('agences.name as name, count(*) as count')
            ->groupBy('agences.id', 'agences.name')
            ->pluck('count', 'name'),
            
        'par_service' => (clone $baseQuery)->join('services', 'reclamations.service_id', '=', 'services.id')
            ->selectRaw('services.name, count(*) as count')
            ->groupBy('services.id', 'services.name')
            ->pluck('count', 'name'),
    ];
    
    return view('dashboard', compact('stats'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/notifications/{id}/read', function ($id) {
    $notification = auth()->user()->notifications()->where('id', $id)->first();
    if ($notification) {
        $notification->markAsRead();
    }
    return response()->json(['success' => true]);
})->name('notifications.read');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\PrioriteController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\UserController;

Route::middleware(['auth', 'verified'])->group(function () {
    // Routes pour la corbeille (DOIVENT ÊTRE AVANT le resource)
    Route::get('clients/trashed', [ClientController::class, 'trashed'])->name('clients.trashed');
    Route::post('clients/{client}/restore', [ClientController::class, 'restore'])->name('clients.restore');
    Route::delete('clients/{client}/force-delete', [ClientController::class, 'forceDelete'])->name('clients.forceDelete');

    // Routes pour la corbeille des priorités (DOIVENT ÊTRE AVANT le resource)
    Route::get('priorites/trashed', [PrioriteController::class, 'trashed'])->name('priorites.trashed');
    Route::post('priorites/{priorite}/restore', [PrioriteController::class, 'restore'])->name('priorites.restore');
    Route::delete('priorites/{priorite}/force-delete', [PrioriteController::class, 'forceDelete'])->name('priorites.forceDelete');

    // Routes pour la corbeille des catégories
    Route::get('categories/trashed', [CategorieController::class, 'trashed'])->name('categories.trashed');
    Route::post('categories/{categorie}/restore', [CategorieController::class, 'restore'])->name('categories.restore');
    Route::delete('categories/{categorie}/force-delete', [CategorieController::class, 'forceDelete'])->name('categories.forceDelete');

    // Routes pour les commentaires sur les réclamations
    Route::post('/reclamations/{reclamation}/commentaires', [ReclamationController::class, 'storeCommentaire'])->name('reclamations.commentaires.store');
    Route::get('/reclamations-corbeille', [ReclamationController::class, 'corbeille'])->name('reclamations.corbeille');
    Route::get('reclamations/trashed', [ReclamationController::class, 'trashed'])->name('reclamations.trashed');
    Route::post('/reclamations/{id}/restore', [ReclamationController::class, 'restore'])->name('reclamations.restore');
    Route::post('/reclamations/{reclamation}/restaurer', [ReclamationController::class, 'restaurer'])->name('reclamations.restaurer');
    Route::get('/reclamations/{reclamation}/edit-form', [ReclamationController::class, 'getEditForm'])->name('reclamations.edit-form');
    Route::get('/reclamations/{reclamation}/show-detail', [ReclamationController::class, 'getShowDetail'])->name('reclamations.show-detail');

    // Route resource (après les routes personnalisées)
    Route::resource('clients', ClientController::class);
    Route::resource('priorites', PrioriteController::class);
    Route::resource('reclamations', ReclamationController::class);
    Route::resource('categories', CategorieController::class);
    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';
