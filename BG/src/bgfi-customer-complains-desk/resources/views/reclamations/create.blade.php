<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nouvelle Réclamation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('reclamations.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Client -->
                        <div class="md:col-span-2">
                            <x-input-label for="client_id" :value="__('Client concerné')" />
                            <select id="client_id" name="client_id"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>
                                <option value="">Sélectionnez un client</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}"
                                        {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                        {{ $client->nom }} {{ $client->prenoms }} ({{ $client->email }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
                        </div>

                        <!-- Canal -->
                        <div>
                            <x-input-label for="canal" :value="__('Canal de réception')" />
                            <select id="canal" name="canal"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>
                                <option value="">Sélectionnez un canal</option>
                                <option value="Agence" {{ old('canal') == 'Agence' ? 'selected' : '' }}>Agence</option>
                                <option value="Téléphone" {{ old('canal') == 'Téléphone' ? 'selected' : '' }}>Téléphone
                                </option>
                                <option value="Email" {{ old('canal') == 'Email' ? 'selected' : '' }}>Email</option>
                                <option value="Application mobile"
                                    {{ old('canal') == 'Application mobile' ? 'selected' : '' }}>Application mobile
                                </option>
                            </select>
                            <x-input-error :messages="$errors->get('canal')" class="mt-2" />
                        </div>

                        <!-- Catégorie -->
                        <div>
                            <x-input-label for="categorie_id" :value="__('Catégorie')" />
                            <select id="categorie_id" name="categorie_id"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>
                                <option value="">Sélectionnez une catégorie</option>
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}"
                                        {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
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
                                <option value="">Sélectionnez une priorité</option>
                                @foreach ($priorites as $priorite)
                                    <option value="{{ $priorite->id }}"
                                        {{ old('priorite_id') == $priorite->id ? 'selected' : '' }}>
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
                                <option value="">Sélectionnez un service</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}"
                                        {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                        {{ $service->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('service_id')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <x-input-label for="description" :value="__('Description de la réclamation')" />
                            <textarea id="description" name="description" rows="5"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6 space-x-4">
                        <a href="{{ route('reclamations.index') }}"
                            class="text-sm text-gray-600 hover:text-gray-900 underline">
                            Annuler
                        </a>
                        <x-primary-button>
                            {{ __('Créer la réclamation') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
