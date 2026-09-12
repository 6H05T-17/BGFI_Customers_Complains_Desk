<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        // Vérification de sécurité
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Accès non autorisé. Réservé aux administrateurs.');
        }
        
        $categories = Categorie::orderBy('name')->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:categories,name',
        ]);

        Categorie::create($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Catégorie créée avec succès.');
    }

    public function edit(Categorie $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Categorie $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:categories,name,' . $category->id,
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Catégorie mise à jour avec succès.');
    }

    public function destroy(Categorie $category)
    {
        // On vérifie si la catégorie est utilisée (optionnel mais recommandé)
        if ($category->reclamations()->count() > 0) {
            return redirect()->route('categories.index')
                ->with('error', 'Impossible de supprimer cette catégorie car elle est utilisée par des réclamations.');
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Catégorie supprimée avec succès.');
    }

    public function trashed()
    {
        $categories = Categorie::onlyTrashed()->orderBy('name')->get();
        return view('categories.trashed', compact('categories'));
    }

    public function restore($id)
    {
        Categorie::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('categories.trashed')->with('success', 'Catégorie restaurée avec succès.');
    }

    public function forceDelete($id)
    {
        $categorie = Categorie::withTrashed()->findOrFail($id);
        // Optionnel : Vérifier si elle est utilisée avant de supprimer définitivement
        $categorie->forceDelete();
        return redirect()->route('categories.trashed')->with('success', 'Catégorie définitivement supprimée.');
    }
}