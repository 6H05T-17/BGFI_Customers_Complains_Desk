<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Boutons de navigation -->
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('reclamations.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Retour à la liste
            </a>
            <a href="{{ route('reclamations.edit', $reclamation) }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-pen-fill me-1"></i> Modifier la réclamation
            </a>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- 1. Informations Générales -->
                <div class="col-span-2 border-b pb-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations Générales</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-medium">Numéro</p>
                            <p class="text-gray-900 font-bold">{{ $reclamation->numero }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-medium">Date de création</p>
                            <p class="text-gray-900">{{ $reclamation->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-medium">Canal</p>
                            <p class="text-gray-900">{{ $reclamation->canal }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-medium">Statut</p>
                            <span
                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $reclamation->statut }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- 2. Client & Agence -->
                <div class="border-b pb-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Client Concerné</h3>

                    @if ($reclamation->client)
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-900 font-medium text-lg">{{ $reclamation->client->nom }}
                                    {{ $reclamation->client->prenoms }}</p>
                                <p class="text-gray-600 text-sm mt-1">{{ $reclamation->client->email }}</p>
                                <p class="text-gray-600 text-sm">Tél: {{ $reclamation->client->telephone }}</p>
                            </div>
                            @if ($reclamation->client->trashed())
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full"
                                    style="background-color: #facc15 !important; color: black !important;">
                                    En corbeille
                                </span>
                            @endif
                        </div>
                        <div class="mt-3 p-2 bg-gray-50 rounded border border-gray-200 inline-block">
                            <p class="text-xs text-gray-500 uppercase">Agence de rattachement</p>
                            <p class="text-gray-800 font-medium">{{ $reclamation->client->agence->name }}</p>
                        </div>
                    @else
                        <p style="color: #dc2626 !important;" class="italic text-sm">
                            ⚠ Client supprimé définitivement
                        </p>
                    @endif
                </div>

                <!-- 3. Catégorie & Service -->
                <div class="border-b pb-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Catégorie & Service</h3>
                    <div class="mb-3">
                        <p class="text-xs text-gray-500 uppercase">Catégorie</p>
                        <p class="text-gray-900 font-medium">{{ $reclamation->categorie->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase">Service concerné</p>
                        <p class="text-gray-900 font-medium">{{ $reclamation->service->name }}</p>
                    </div>
                </div>

                <!-- 4. Priorité & Délai -->
                <div class="col-span-2 border-b pb-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Priorité & Délai (SLA)</h3>

                    <div class="flex items-center gap-4">
                        @if ($reclamation->priorite)
                            <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full"
                                style="background-color: #dbeafe !important; color: #1e40af !important;">
                                {{ $reclamation->priorite->name }}
                            </span>
                        @else
                            <span class="text-gray-400 italic">Non définie</span>
                        @endif
                        <span class="text-gray-600 text-sm">
                            Délai imparti : <span
                                class="font-medium text-gray-900">{{ $reclamation->priorite->delay }}</span>
                        </span>
                    </div>
                    @if ($reclamation->date_limite)
                        <p class="text-sm text-gray-600 mt-3">
                            Date limite de traitement : <span
                                class="font-bold text-gray-900">{{ \Carbon\Carbon::parse($reclamation->date_limite)->format('d/m/Y') }}</span>
                        </p>
                    @endif
                </div>

                <!-- 5. Description -->
                <div class="col-span-2">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Description de la Réclamation</h3>
                    <div
                        class="bg-gray-50 p-4 rounded-md border border-gray-200 text-gray-700 whitespace-pre-wrap leading-relaxed">
                        {{ $reclamation->description }}
                    </div>
                </div>

                <!-- 6. Agents assignés -->
                <div class="col-span-2 border-b pb-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Équipe assignée</h3>
                    @if ($reclamation->assignedUsers->count() > 0)
                        <div class="flex flex-wrap gap-2">
                            @foreach ($reclamation->assignedUsers as $user)
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full"
                                    style="background-color: #e0e7ff !important; color: #3730a3 !important;">
                                    {{ $user->name }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 italic text-sm">Aucun agent n'est encore assigné à cette réclamation.
                        </p>
                    @endif
                </div>

                <!-- 7. Historique des modifications -->
                <div class="col-span-2 mt-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                        Historique des modifications
                    </h3>
                    @if ($reclamation->historiques->count() > 0)
                        <div class="bg-gray-50 rounded-md border border-gray-200 overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Utilisateur</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Action</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Ancienne valeur</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Nouvelle valeur</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($reclamation->historiques->sortByDesc('date') as $historique)
                                        <tr>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                                {{ \Carbon\Carbon::parse($historique->date)->format('d/m/Y H:i') }}
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                                {{ $historique->user->name ?? 'Système' }}
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700 font-medium">
                                                {{ $historique->action }}
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-red-600">
                                                {{ $historique->old_val }}
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-green-600">
                                                {{ $historique->new_val }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500 italic text-sm">Aucune modification n'a encore été enregistrée pour
                            cette réclamation.</p>
                    @endif
                </div>

                <!-- 8. Section Commentaires et Actions -->
                <div class="col-span-2 mt-8 border-t pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Commentaires et Actions</h3>

                    <!-- Liste existante -->
                    <div class="space-y-4 mb-6">
                        @forelse($reclamation->commentaires as $commentaire)
                            <div
                                class="bg-gray-50 p-4 rounded-lg border-l-4 {{ $commentaire->type === 'action' ? 'border-blue-500' : 'border-green-500' }}">
                                <div class="flex justify-between items-start mb-2">
                                    <span
                                        class="text-xs font-bold uppercase {{ $commentaire->type === 'action' ? 'text-blue-600' : 'text-green-600' }}">
                                        {{ $commentaire->type === 'action' ? 'Action réalisée' : 'Commentaire' }}
                                    </span>
                                    <span class="text-xs text-gray-500">
                                        {{ $commentaire->user->name ?? 'Utilisateur inconnu' }} -
                                        {{ $commentaire->created_at->format('d/m/Y H:i') }}
                                    </span>
                                </div>
                                <p class="text-gray-800 text-sm">{{ $commentaire->contenu }}</p>
                            </div>
                        @empty
                            <p class="text-gray-500 italic text-sm">Aucun commentaire ou action pour le moment.</p>
                        @endforelse
                    </div>
                    <!-- Formulaire d'ajout -->
                    <form action="{{ route('reclamations.commentaires.store', $reclamation) }}" method="POST"
                        class="bg-white p-4 rounded-lg shadow-sm border">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Type d'ajout</label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="type" value="commentaire" checked
                                        class="form-radio text-green-600">
                                    <span class="ml-2 text-sm text-gray-700">Commentaire</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="type" value="action"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2 text-sm text-gray-700">Action réalisée</span>
                                </label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="contenu" class="block text-sm font-medium text-gray-700 mb-1">Contenu</label>
                            <textarea id="contenu" name="contenu" rows="3"
                                class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required></textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-white text-gray-800 px-4 py-2 rounded text-sm hover:bg-gray-100 border border-gray-300">
                                Ajouter
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
