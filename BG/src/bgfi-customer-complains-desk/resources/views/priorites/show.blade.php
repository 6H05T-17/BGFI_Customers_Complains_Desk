<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détail de la Priorité : ' . $priorite->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Boutons de navigation -->
            <div class="mb-6 flex justify-between items-center">
                <a href="{{ route('priorites.index') }}" class="btn btn-sm btn-inline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Retour à la liste
                </a>
                <a href="{{ route('priorites.edit', $priorite) }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-pen-fill me-1"></i> Modifier
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informations -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Informations</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-medium">Nom</p>
                                <p class="text-gray-900 text-lg font-medium">{{ $priorite->name }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-medium">Délai SLA</p>
                                <p class="text-gray-900">{{ $priorite->delay }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-medium">Créée le</p>
                                <p class="text-gray-900">{{ $priorite->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-medium">Dernière modification</p>
                                <p class="text-gray-900">{{ $priorite->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Réclamations associées -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">
                            Réclamations associées ({{ $priorite->reclamations->count() }})
                        </h3>
                        @if ($priorite->reclamations->count() > 0)
                            <div class="bg-gray-50 rounded border border-gray-200 p-4 max-h-64 overflow-y-auto">
                                <ul class="space-y-2">
                                    @foreach ($priorite->reclamations as $reclamation)
                                        <li class="text-sm">
                                            <a href="{{ route('reclamations.show', $reclamation) }}"
                                                class="text-blue-600 hover:text-blue-900">
                                                {{ $reclamation->numero }}
                                            </a>
                                            <span class="text-gray-500">-
                                                {{ $reclamation->client->nom ?? 'Client supprimé' }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">
                                ⚠ Cette priorité ne peut pas être supprimée car elle est utilisée.
                            </p>
                        @else
                            <p class="text-gray-500 italic">Aucune réclamation n'utilise cette priorité.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
