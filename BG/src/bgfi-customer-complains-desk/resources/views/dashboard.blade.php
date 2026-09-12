<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de Bord') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">

            <!-- Ligne 1 : Indicateurs opérationnels (Action immédiate) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <!-- Réclamations ouvertes -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 border-l-4 border-blue-500">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-medium">Ouvertes</p>
                            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['ouvertes'] }}</p>
                        </div>
                        <div class="text-blue-500 opacity-20">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>
                </div>

                <!-- En retard SLA -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 border-l-4 border-red-500">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-medium">En Retard</p>
                            <p class="text-2xl font-bold text-red-600 mt-1">{{ $stats['en_retard'] }}</p>
                        </div>
                        <div class="text-red-500 opacity-20">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>
                </div>

                <!-- Clôturées -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 border-l-4 border-green-500">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-medium">Clôturées</p>
                            <p class="text-2xl font-bold text-green-600 mt-1">{{ $stats['cloturees'] }}</p>
                        </div>
                        <div class="text-green-500 opacity-20">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ligne 2 : Indicateurs globaux (Vue d'ensemble) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                <!-- Total des réclamations -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <p class="text-xs text-gray-500 uppercase font-medium">Total des réclamations</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total'] }}</p>
                </div>

                <!-- Temps moyen de résolution -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <p class="text-xs text-gray-500 uppercase font-medium">Délai moyen de résolution</p>
                    <p class="text-3xl font-bold text-purple-600 mt-2">
                        @if($stats['temps_moyen'])
                            {{ number_format($stats['temps_moyen'], 1) }}h
                        @else
                            -
                        @endif
                    </p>
                </div>
            </div>

            <!-- Ligne 3 : Répartition par statut -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Répartition par statut -->
                <!-- Graphique Statut -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Répartition par Statut</h3>

                    @php
                        // Préparation des données pour Chart.js
                        $statutLabels = json_encode(array_keys($stats['par_statut']->toArray()));
                        $statutData = json_encode(array_values($stats['par_statut']->toArray()));
                    @endphp

                    <div class="relative" style="height: 300px;">
                        <canvas id="statutChart" data-labels="{{ $statutLabels }}"
                            data-data="{{ $statutData }}"></canvas>
                    </div>
                </div>

                <!-- Répartition par priorité -->
                <!-- Graphique Priorité -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Répartition par Priorité</h3>

                    @php
                        // Préparation des données pour Chart.js
                        $prioriteLabels = [];
                        $prioriteData = [];
                        foreach ($stats['par_priorite'] as $id => $count) {
                            $p = \App\Models\Priorite::find($id);
                            $prioriteLabels[] = $p ? $p->name : 'Inconnue';
                            $prioriteData[] = $count;
                        }
                        $prioriteLabelsJson = json_encode($prioriteLabels);
                        $prioriteDataJson = json_encode($prioriteData);
                    @endphp

                    <div class="relative" style="height: 300px;">
                        <canvas id="prioriteChart" data-labels="{{ $prioriteLabelsJson }}"
                            data-data="{{ $prioriteDataJson }}"></canvas>
                    </div>
                </div>
            </div>

            <!-- Ligne 4 : Répartition par Agence et Service -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <!-- Graphique par Agence -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Réclamations par Agence</h3>
                    
                    @php
                        $agenceLabels = json_encode(array_keys($stats['par_agence']->toArray()));
                        $agenceData = json_encode(array_values($stats['par_agence']->toArray()));
                    @endphp
                    
                    <div class="relative" style="height: 300px;">
                        <canvas id="agenceChart" data-labels="{{ $agenceLabels }}" data-data="{{ $agenceData }}"></canvas>
                    </div>
                </div>

                <!-- Graphique par Service -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Réclamations par Service</h3>
                    
                    @php
                        $serviceLabels = json_encode(array_keys($stats['par_service']->toArray()));
                        $serviceData = json_encode(array_values($stats['par_service']->toArray()));
                    @endphp
                    
                    <div class="relative" style="height: 300px;">
                        <canvas id="serviceChart" data-labels="{{ $serviceLabels }}" data-data="{{ $serviceData }}"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
