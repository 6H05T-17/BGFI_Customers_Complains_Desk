<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Agence;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::with('agence')->paginate(10);
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $agences = Agence::all();
        return view('clients.create', compact('agences'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:50',
            'prenoms' => 'required|string|max:255',
            'telephone' => 'required|string|max:50',
            'email' => 'required|email|max:255|unique:clients',
            'agence_id' => 'required|exists:agences,id',
        ]);

        Client::create($validated);

        return redirect()->route('clients.index')
            ->with('success', 'Client créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        $client->load('agence');
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        $agences = Agence::all();
        return view('clients.edit', compact('client', 'agences'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:50',
            'prenoms' => 'required|string|max:255',
            'telephone' => 'required|string|max:50',
            'email' => 'required|email|max:255|unique:clients,email,' . $client->id,
            'agence_id' => 'required|exists:agences,id',
        ]);

        $client->update($validated);

        return redirect()->route('clients.index')
            ->with('success', 'Client mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index')
            ->with('success', 'Client supprimé avec succès.');
    }

    /**
     * Affiche les clients supprimés (corbeille)
     */
    public function trashed()
    {
        $clients = Client::onlyTrashed()->with('agence')->get();
        return view('clients.trashed', compact('clients'));
    }

    /**
     * Restaure un client supprimé
     */
    public function restore($id)
    {
        $client = Client::withTrashed()->findOrFail($id);
        $client->restore();

        return redirect()->route('clients.trashed')
            ->with('success', 'Client restauré avec succès.');
    }

    /**
     * Supprime définitivement un client
     */
    public function forceDelete($id)
    {
        $client = Client::withTrashed()->findOrFail($id);
        $client->forceDelete();

        return redirect()->route('clients.trashed')
            ->with('success', 'Client définitivement supprimé.');
    }
}