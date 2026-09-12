<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nouvelle Priorité SLA') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('priorites.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nom -->
                        <div>
                            <x-input-label for="name" :value="__('Nom de la priorité')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" required autofocus placeholder="Ex: Urgente" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            <p class="text-xs text-gray-500 mt-1">Nom unique identifiant cette priorité</p>
                        </div>

                        <!-- Délai -->
                        <div>
                            <x-input-label for="delay" :value="__('Délai de traitement (SLA)')" />
                            <x-text-input id="delay" class="block mt-1 w-full" type="text" name="delay"
                                :value="old('delay')" required placeholder="Ex: 12 heures, 3 jours" />
                            <x-input-error :messages="$errors->get('delay')" class="mt-2" />
                            <p class="text-xs text-gray-500 mt-1">Délai maximum pour traiter une réclamation de cette
                                priorité</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6 space-x-4">
                        <a href="{{ route('priorites.index') }}"
                            class="text-sm text-gray-600 hover:text-gray-900 underline">
                            Annuler
                        </a>
                        <x-primary-button>
                            {{ __('Créer la priorité') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
