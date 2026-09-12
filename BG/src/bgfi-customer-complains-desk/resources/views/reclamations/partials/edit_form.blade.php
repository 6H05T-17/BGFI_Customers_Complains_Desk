<form id="editReclamationForm" action="{{ route('reclamations.update', $reclamation) }}" method="POST" data-reclamation-id="{{ $reclamation->id }}">
    @csrf
    @method('PUT')
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Client (LECTURE SEULE) -->
        <div class="md:col-span-2">
            <x-input-label :value="__('Client concerné')" />
            <div class="mt-1 p-3 bg-gray-100 border border-gray-300 rounded-md">
                @if ($reclamation->client)
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-900 font-medium">
                                {{ $reclamation->client->nom }} {{ $reclamation->client->prenoms }}
                            </p>
                            <p class="text-gray-600 text-sm">{{ $reclamation->client->email }}</p>
                        </div>
                        @if ($reclamation->client->trashed())
                            <span class="px-2 py-1 text-xs font-semibold rounded-full"
                                style="background-color: #facc15 !important; color: black !important;">
                                En corbeille
                            </span>
                        @endif
                    </div>
                @else
                    <p class="text-red-600 italic" style="color: #dc2626 !important;">
                        ⚠ Client supprimé définitivement
                    </p>
                @endif
            </div>
            <p class="text-xs text-gray-500 mt-1">
                Le client associé à une réclamation ne peut pas être modifié pour garantir l'intégrité
                des données.
            </p>
        </div>
        
        <!-- Statut (NOUVEAU CHAMP POUR LE WORKFLOW) -->
        <div class="md:col-span-2 bg-gray-50 p-4 rounded-md border border-gray-200">
            <x-input-label for="statut" :value="__('Statut de la réclamation')" />
            <select id="statut" name="statut"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                required>
                <option value="Nouvelle"
                    {{ old('statut', $reclamation->statut) == 'Nouvelle' ? 'selected' : '' }}>Nouvelle
                </option>
                <option value="Affectée"
                    {{ old('statut', $reclamation->statut) == 'Affectée' ? 'selected' : '' }}>Affectée
                </option>
                <option value="En cours de traitement"
                    {{ old('statut', $reclamation->statut) == 'En cours de traitement' ? 'selected' : '' }}>
                    En cours de traitement</option>
                <option value="En attente client"
                    {{ old('statut', $reclamation->statut) == 'En attente client' ? 'selected' : '' }}>
                    En attente client</option>
                <option value="Résolue"
                    {{ old('statut', $reclamation->statut) == 'Résolue' ? 'selected' : '' }}>Résolue
                </option>
                <option value="Clôturée"
                    {{ old('statut', $reclamation->statut) == 'Clôturée' ? 'selected' : '' }}>Clôturée
                </option>
            </select>
            <x-input-error :messages="$errors->get('statut')" class="mt-2" />
        </div>
        
        <!-- Canal -->
        <div>
            <x-input-label for="canal" :value="__('Canal de réception')" />
            <select id="canal" name="canal"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                required>
                <option value="Agence"
                    {{ old('canal', $reclamation->canal) == 'Agence' ? 'selected' : '' }}>Agence
                </option>
                <option value="Téléphone"
                    {{ old('canal', $reclamation->canal) == 'Téléphone' ? 'selected' : '' }}>Téléphone
                </option>
                <option value="Email"
                    {{ old('canal', $reclamation->canal) == 'Email' ? 'selected' : '' }}>Email</option>
                <option value="Application mobile"
                    {{ old('canal', $reclamation->canal) == 'Application mobile' ? 'selected' : '' }}>
                    Application mobile</option>
            </select>
            <x-input-error :messages="$errors->get('canal')" class="mt-2" />
        </div>
        
        <!-- Catégorie -->
        <div>
            <x-input-label for="categorie_id" :value="__('Catégorie')" />
            <select id="categorie_id" name="categorie_id"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                required>
                @foreach ($categories as $categorie)
                    <option value="{{ $categorie->id }}"
                        {{ old('categorie_id', $reclamation->categorie_id) == $categorie->id ? 'selected' : '' }}>
                        {{ $categorie->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('categorie_id')" class="mt-2" />
        </div>
        
        <!-- Priorité -->
        <div>
            <x-input-label for="priorite_id" :value="__('Priorité')" />
            <select id="priorite_id" name="priorite_id"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                required>
                @foreach ($priorites as $priorite)
                    <option value="{{ $priorite->id }}"
                        {{ old('priorite_id', $reclamation->priorite_id) == $priorite->id ? 'selected' : '' }}>
                        {{ $priorite->name }} ({{ $priorite->delay }})
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('priorite_id')" class="mt-2" />
        </div>
        
        <!-- Service concerné -->
        <div>
            <x-input-label for="service_id" :value="__('Service concerné')" />
            <select id="service_id" name="service_id"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                required>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}"
                        {{ old('service_id', $reclamation->service_id) == $service->id ? 'selected' : '' }}>
                        {{ $service->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('service_id')" class="mt-2" />
        </div>
        
        <!-- Assignation des agents -->
        <div class="md:col-span-2 mt-6">
            <x-input-label for="assigned_users" :value="__('Agents assignés à cette réclamation')" />
            <select id="assigned_users" name="assigned_users[]" multiple
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                style="height: 150px;">
                @foreach ($agents as $agent)
                    <option value="{{ $agent->id }}"
                        {{ $reclamation->assignedUsers->contains($agent->id) ? 'selected' : '' }}>
                        {{ $agent->name }}
                    </option>
                @endforeach
            </select>
            <p class="text-xs text-gray-500 mt-1">
                Maintenez la touche <strong>Ctrl</strong> (ou <strong>Cmd</strong> sur Mac) enfoncée
                pour sélectionner plusieurs agents.
            </p>
        </div>
        
        <!-- Description -->
        <div class="md:col-span-2">
            <x-input-label for="description" :value="__('Description de la réclamation')" />
            <textarea id="description" name="description" rows="5"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                required>{{ old('description', $reclamation->description) }}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>
    </div>
    
    <div class="flex items-center justify-end mt-6 space-x-4">
        <a href="{{ route('reclamations.show', $reclamation) }}"
            class="text-sm text-gray-600 hover:text-gray-900 underline">
            Annuler
        </a>
        <x-primary-button>
            {{ __('Mettre à jour') }}
        </x-primary-button>
    </div>
</form>