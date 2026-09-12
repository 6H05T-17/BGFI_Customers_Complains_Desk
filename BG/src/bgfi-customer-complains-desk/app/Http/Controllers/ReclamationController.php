<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Client;
use App\Models\Priorite;
use App\Models\Reclamation;
use App\Models\Service;
use App\Services\SlaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ReclamationController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = Reclamation::with(['client', 'service', 'categorie', 'priorite']);

        // Filtrage par rôle
        if ($user->role === 'agent') {
            $query->where('service_id', $user->service_id);
        } elseif ($user->role === 'responsable') {
            $query->where('service_id', $user->service_id);
        }

        // Filtres de recherche
        if ($request->filled('numero')) {
            $query->where('numero', 'like', '%' . $request->numero . '%');
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('priorite_id')) {
            $query->where('priorite_id', $request->priorite_id);
        }

        if ($request->filled('service_id')) {
            $query->where('service_id', $request->service_id);
        }

        if ($request->filled('date_debut')) {
            $query->whereDate('created_at', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->whereDate('created_at', '<=', $request->date_fin);
        }

        $reclamations = $query->orderBy('created_at', 'desc')->paginate(15);

        // Données pour les filtres
        $services = Service::all();
        $priorites = Priorite::all();
        $statuts = ['Nouvelle', 'Affectée', 'En cours de traitement', 'En attente client', 'Résolue', 'Clôturée'];

        return view('reclamations.index', compact('reclamations', 'services', 'priorites', 'statuts'));
    }

    public function create()
    {
        $clients = Client::orderBy('nom')->get();
        $categories = Categorie::all();
        $services = Service::all();
        $priorites = Priorite::all();

        return view('reclamations.create', compact('clients', 'categories', 'services', 'priorites'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'canal' => 'required|in:Agence,Téléphone,Email,Application mobile',
            'categorie_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'priorite_id' => 'required|exists:priorites,id',
            'service_id' => 'required|exists:services,id',
        ]);

        $validated['numero'] = 'REC-' . date('Ymd') . '-' . strtoupper(Str::random(4));
        $validated['statut'] = 'Nouvelle';
        $validated['date_creation'] = now();

        // Calcul dynamique du SLA via le nouveau service
        $priorite = Priorite::findOrFail($validated['priorite_id']);
        $slaService = new SlaService();
        $validated['date_limite'] = $slaService->calculateDeadline($priorite->delay);

        $validated['user_id'] = auth()->id();
        Reclamation::create($validated);

        return redirect()->route('reclamations.index')
            ->with('success', 'Réclamation créée avec succès sous le numéro : ' . $validated['numero']);
    }

    public function show(Reclamation $reclamation)
    {
        $user = auth()->user();

        // Restriction de sécurité : Agent et Responsable ne voient que les réclamations de leur service
        if (in_array($user->role, ['agent', 'responsable'])) {
            if ($reclamation->service_id !== $user->service_id) {
                abort(403, 'Accès refusé : cette réclamation ne concerne pas votre service.');
            }
        }

        // On charge tout : les relations de base + l'historique + l'utilisateur de l'historique
        $reclamation->load(['client.agence', 'categorie', 'service', 'priorite', 'historiques.user', 'assignedUsers']);

        return view('reclamations.show', compact('reclamation'));
    }

    public function edit(Reclamation $reclamation)
    {
        $user = auth()->user();
        // Restriction de sécurité : Un agent ne peut modifier que les réclamations auxquelles il est assigné
        $reclamation->load('assignedUsers');
        if ($user->role === 'agent' && !$reclamation->assignedUsers->contains($user->id)) {
            abort(403, 'Accès refusé : vous n\'êtes pas assigné à cette réclamation.');
        }
        $clients = Client::orderBy('nom')->get();
        $categories = Categorie::all();
        $services = Service::all();
        $priorites = Priorite::all();

        // Logique de filtrage pour l'assignation (Corrige le point 1 et prépare le point 3)
        $query = \App\Models\User::query();

        if ($user->role === 'admin') {
            // Admin peut assigner tout le monde sauf les autres admins
            $query->where('role', '!=', 'admin');
        } elseif ($user->role === 'responsable') {
            // Responsable ne voit que les agents de son propre service
            $query->where('role', 'agent')->where('service_id', $user->service_id);
        } else {
            // Agent : ne peut rien assigner (liste vide)
            $query->where('id', 0);
        }

        $agents = $query->orderBy('name')->get();

        return view('reclamations.edit', compact('reclamation', 'clients', 'categories', 'services', 'priorites', 'agents'));
    }

    public function update(Request $request, Reclamation $reclamation)
    {
        $validated = $request->validate([
            'canal' => 'required|in:Agence,Téléphone,Email,Application mobile',
            'categorie_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'priorite_id' => 'required|exists:priorites,id',
            'service_id' => 'required|exists:services,id',
            'statut' => 'required|in:Nouvelle,Affectée,En cours de traitement,En attente client,Résolue,Clôturée',
        ]);
        // Restriction de sécurité pour la mise à jour
        $reclamation->load('assignedUsers');
        if (auth()->user()->role === 'agent' && !$reclamation->assignedUsers->contains(auth()->id())) {
            abort(403, 'Accès refusé : vous n\'êtes pas assigné à cette réclamation.');
        }

        // Si requête AJAX et erreurs de validation → retour JSON
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['errors' => $validated], 422);
        }

        $changes = [];
        $userId = auth()->id();
        $now = now();

        // --- Détection des changements ---
        if ($reclamation->statut !== $validated['statut']) {
            $changes[] = ['id_reclam' => $reclamation->id, 'id_user' => $userId, 'date' => $now, 'old_val' => $reclamation->statut, 'new_val' => $validated['statut'], 'action' => 'Changement de statut'];
        }
        if ($reclamation->priorite_id !== $validated['priorite_id']) {
            $old = Priorite::find($reclamation->priorite_id)?->name ?? 'Inconnue';
            $new = Priorite::find($validated['priorite_id'])?->name ?? 'Inconnue';
            $changes[] = ['id_reclam' => $reclamation->id, 'id_user' => $userId, 'date' => $now, 'old_val' => $old, 'new_val' => $new, 'action' => 'Changement de priorité'];
        }
        if ($reclamation->service_id !== $validated['service_id']) {
            $old = Service::find($reclamation->service_id)?->name ?? 'Inconnu';
            $new = Service::find($validated['service_id'])?->name ?? 'Inconnu';
            $changes[] = ['id_reclam' => $reclamation->id, 'id_user' => $userId, 'date' => $now, 'old_val' => $old, 'new_val' => $new, 'action' => 'Changement de service'];
        }
        if ($reclamation->categorie_id !== $validated['categorie_id']) {
            $old = Categorie::find($reclamation->categorie_id)?->name ?? 'Inconnue';
            $new = Categorie::find($validated['categorie_id'])?->name ?? 'Inconnue';
            $changes[] = ['id_reclam' => $reclamation->id, 'id_user' => $userId, 'date' => $now, 'old_val' => $old, 'new_val' => $new, 'action' => 'Changement de catégorie'];
        }
        if ($reclamation->canal !== $validated['canal']) {
            $changes[] = ['id_reclam' => $reclamation->id, 'id_user' => $userId, 'date' => $now, 'old_val' => $reclamation->canal, 'new_val' => $validated['canal'], 'action' => 'Changement de canal'];
        }
        $oldAssignedIds = $reclamation->assignedUsers->pluck('id')->toArray();
        $newAssignedIds = $request->input('assigned_users', []);
        if ($oldAssignedIds != $newAssignedIds) {
            $oldNames = \App\Models\User::whereIn('id', $oldAssignedIds)->pluck('name')->implode(', ') ?: 'Aucun';
            $newNames = \App\Models\User::whereIn('id', $newAssignedIds)->pluck('name')->implode(', ') ?: 'Aucun';
            $changes[] = [
                'id_reclam' => $reclamation->id,
                'id_user' => $userId,
                'date' => $now,
                'old_val' => $oldNames,
                'new_val' => $newNames,
                'action' => 'Changement d\'équipe assignée',
            ];
        }

        // --- Notification aux nouveaux agents assignés ---
        $newlyAssignedIds = array_diff($newAssignedIds, $oldAssignedIds);
        if (!empty($newlyAssignedIds)) {
            $usersToNotify = \App\Models\User::whereIn('id', $newlyAssignedIds)->get();
            foreach ($usersToNotify as $user) {
                $user->notify(new \App\Notifications\ReclamationNotification(
                    $reclamation,
                    'Nouvelle assignation',
                    'Vous avez été assigné(e) à la réclamation ' . $reclamation->numero
                ));
            }
        }

        if ($reclamation->priorite_id !== $validated['priorite_id']) {
            $newPriorite = Priorite::find($validated['priorite_id']);
            $slaService = new \App\Services\SlaService();
            $validated['date_limite'] = $slaService->calculateDeadline($newPriorite->delay);
        }

        try {
            DB::transaction(function () use ($reclamation, $validated, $changes, $request) {
                $reclamation->update($validated);
                if ($request->has('assigned_users')) {
                    $reclamation->assignedUsers()->sync($request->input('assigned_users'));
                } else {
                    $reclamation->assignedUsers()->detach();
                }
                if (!empty($changes)) {
                    \App\Models\Historique::insert($changes);
                }
            });

            // Si requête AJAX → retour JSON (pas de redirection)
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'Réclamation mise à jour avec succès.']);
            }

            return redirect()->route('reclamations.show', $reclamation)
                ->with('success', 'Réclamation mise à jour et historisée avec succès.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour de la réclamation : ' . $e->getMessage());

            // Si requête AJAX → retour JSON d'erreur
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Une erreur est survenue.'], 500);
            }

            return redirect()->back()->with('error', 'Une erreur est survenue lors de la sauvegarde.');
        }
    }

    public function destroy(Reclamation $reclamation)
    {
        // Restriction de sécurité : Les agents n'ont pas le droit de supprimer des réclamations
        if (auth()->user()->role === 'agent') {
            abort(403, 'Accès refusé : les agents ne peuvent pas supprimer de réclamations.');
        }

        $reclamation->delete();
        return redirect()->route('reclamations.index')->with('success', 'Réclamation supprimée.');
    }

    public function storeCommentaire(Request $request, Reclamation $reclamation)
    {
        // dd($request->all());

        $validated = $request->validate([
            'type' => 'required|in:commentaire,action',
            'contenu' => 'required|string',
        ]);

        $reclamation->commentaires()->create([
            'user_id' => auth()->id(),
            'type' => $validated['type'],
            'contenu' => $validated['contenu'],
        ]);

        return redirect()->route('reclamations.show', $reclamation)
            ->with('success', 'Ajout enregistré avec succès.');
    }

    public function corbeille()
    {
        return $this->trashed();
    }

    public function trashed()
    {
        // Restriction de sécurité : Les agents n'ont pas accès à la corbeille
        if (auth()->user()->role === 'agent') {
            abort(403, 'Accès refusé : les agents ne peuvent pas accéder à la corbeille.');
        }

        $reclamations = Reclamation::onlyTrashed()
            ->with(['client', 'service', 'categorie', 'priorite'])
            ->orderBy('deleted_at', 'desc')
            ->paginate(15);

        return view('reclamations.corbeille', compact('reclamations'));
    }

    public function restaurer(Reclamation $reclamation)
    {
        return $this->restore($reclamation->id);
    }

    public function restore($id)
    {
        $reclamation = Reclamation::withTrashed()->findOrFail($id);

        // Restriction de sécurité : Les agents n'ont pas le droit de restaurer
        if (auth()->user()->role === 'agent') {
            abort(403, 'Accès refusé : les agents ne peuvent pas restaurer de réclamations.');
        }

        $reclamation->restore();

        return redirect()->route('reclamations.trashed')
            ->with('success', 'Réclamation restaurée avec succès.');
    }

    public function getShowDetail(Reclamation $reclamation)
    {
        $reclamation->load(['client.agence', 'categorie', 'service', 'priorite', 'historiques.user', 'commentaires.user']);

        // On retourne uniquement la vue partielle
        return view('reclamations.partials.show_detail', compact('reclamation'));
    }

    public function getEditForm(Reclamation $reclamation)
    {
        $user = auth()->user();
        $clients = Client::orderBy('nom')->get();
        $categories = Categorie::all();
        $services = Service::all();
        $priorites = Priorite::all();

        // Logique de filtrage pour l'assignation
        $query = \App\Models\User::query();
        if ($user->role === 'admin') {
            $query->where('role', '!=', 'admin');
        } elseif ($user->role === 'responsable') {
            $query->where('role', 'agent')->where('service_id', $user->service_id);
        } else {
            $query->where('id', 0);
        }
        $agents = $query->orderBy('name')->get();

        // On retourne uniquement la vue partielle
        return view('reclamations.partials.edit_form', compact('reclamation', 'clients', 'categories', 'services', 'priorites', 'agents'));
    }
}
