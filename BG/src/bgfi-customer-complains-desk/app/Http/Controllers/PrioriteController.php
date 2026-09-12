<?php

namespace App\Http\Controllers;

use App\Models\Priorite;
use Illuminate\Http\Request;

class PrioriteController extends Controller
{
    public function index()
    {
        // Vérification de sécurité
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Accès non autorisé. Réservé aux administrateurs.');
        }
        // Affiche toutes les priorités non supprimées
        $priorites = Priorite::orderBy('name')->get();
        return view('priorites.index', compact('priorites'));
    }

    public function create()
    {
        return view('priorites.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:priorites,name',
            'delay' => 'required|string|max:50',
        ]);

        Priorite::create($validated);

        return redirect()->route('priorites.index')
            ->with('success', 'Priorité créée avec succès.');
    }

    public function show(Priorite $priorite)
    {
        return view('priorites.show', compact('priorite'));
    }

    public function edit(Priorite $priorite)
    {
        return view('priorites.edit', compact('priorite'));
    }

    public function update(Request $request, Priorite $priorite)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:priorites,name,' . $priorite->id,
            'delay' => 'required|string|max:50',
        ]);

        $priorite->update($validated);

        return redirect()->route('priorites.index')
            ->with('success', 'Priorité mise à jour avec succès.');
    }

    public function destroy(Priorite $priorite)
    {
        // Soft delete au lieu de hard delete
        $priorite->delete();

        return redirect()->route('priorites.index')
            ->with('success', 'Priorité mise en corbeille avec succès.');
    }

    /**
     * Affiche les priorités supprimées (corbeille)
     */
    public function trashed()
    {
        $priorites = Priorite::onlyTrashed()->orderBy('name')->get();
        return view('priorites.trashed', compact('priorites'));
    }

    /**
     * Restaure une priorité supprimée
     */
    public function restore($id)
    {
        $priorite = Priorite::withTrashed()->findOrFail($id);
        $priorite->restore();
        
        return redirect()->route('priorites.trashed')
            ->with('success', 'Priorité restaurée avec succès.');
    }

    /**
     * Supprime définitivement une priorité
     */
    public function forceDelete($id)
    {
        $priorite = Priorite::withTrashed()->findOrFail($id);
        
        // Vérifier si la priorité est utilisée par des réclamations
        if ($priorite->reclamations()->count() > 0) {
            return redirect()->route('priorites.trashed')
                ->with('error', 'Impossible de supprimer définitivement cette priorité car elle est utilisée par des réclamations.');
        }
        
        $priorite->forceDelete();
        
        return redirect()->route('priorites.trashed')
            ->with('success', 'Priorité définitivement supprimée.');
    }
}