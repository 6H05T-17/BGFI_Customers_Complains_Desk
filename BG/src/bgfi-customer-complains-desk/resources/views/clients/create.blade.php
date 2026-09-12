<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un client') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('clients.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nom -->
                        <div>
                            <x-input-label for="nom" :value="__('Nom')" />
                            <x-text-input id="nom" class="block mt-1 w-full" type="text" name="nom"
                                :value="old('nom')" required autofocus />
                            <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                        </div>

                        <!-- Prénoms -->
                        <div>
                            <x-input-label for="prenoms" :value="__('Prénoms')" />
                            <x-text-input id="prenoms" class="block mt-1 w-full" type="text" name="prenoms"
                                :value="old('prenoms')" required />
                            <x-input-error :messages="$errors->get('prenoms')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Téléphone -->
                        <div>
                            <x-input-label for="telephone" :value="__('Téléphone')" />
                            <x-text-input id="telephone" class="block mt-1 w-full" type="text" name="telephone"
                                :value="old('telephone')" required />
                            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                        </div>

                        <!-- Agence -->
                        <div class="md:col-span-2">
                            <x-input-label for="agence_id" :value="__('Agence de rattachement')" />
                            <select id="agence_id" name="agence_id"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>
                                <option value="">Sélectionnez une agence</option>
                                @foreach ($agences as $agence)
                                    <option value="{{ $agence->id }}"
                                        {{ old('agence_id') == $agence->id ? 'selected' : '' }}>
                                        {{ $agence->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('agence_id')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6 space-x-4">
                        <a href="{{ route('clients.index') }}"
                            class="text-sm text-gray-600 hover:text-gray-900 underline">
                            Annuler
                        </a>
                        <x-primary-button>
                            {{ __('Enregistrer') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
