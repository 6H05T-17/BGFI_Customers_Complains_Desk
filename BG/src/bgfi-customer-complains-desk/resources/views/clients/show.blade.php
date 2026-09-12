<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fiche Client : ' . $client->nom . ' ' . $client->prenoms) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Boutons de navigation -->
            <div class="mb-6 flex justify-between items-center">
                <a href="{{ route('clients.index') }}" class="btn btn-sm btn-inline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Retour à la liste
                </a>
                <a href="{{ route('clients.edit', $client) }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-pen-fill me-1"></i> Modifier le client
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informations personnelles -->
                    <div class="border-b pb-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Informations Personnelles</h3>
                        <div class="space-y-2">
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-medium">Nom</p>
                                <p class="text-gray-900">{{ $client->nom }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-medium">Prénoms</p>
                                <p class="text-gray-900">{{ $client->prenoms }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-medium">Email</p>
                                <p class="text-gray-900">{{ $client->email }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-medium">Téléphone</p>
                                <p class="text-gray-900">{{ $client->telephone }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Agence de rattachement -->
                    <div class="border-b pb-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Agence de Rattachement</h3>
                        <div class="p-3 bg-gray-50 rounded border border-gray-200">
                            <p class="text-gray-900 font-medium text-lg">{{ $client->agence->name }}</p>
                        </div>
                    </div>

                    <!-- Métadonnées -->
                    <div class="col-span-2">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Métadonnées</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-medium">Créé le</p>
                                <p class="text-gray-900">{{ $client->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-medium">Dernière modification</p>
                                <p class="text-gray-900">{{ $client->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
