<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des Réclamations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- En-tête avec bouton -->
                    <div class="mb-6 pb-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">
                                Liste des réclamations
                            </h3>
                            <div class="space-x-2">
                                <a href="{{ route('reclamations.corbeille') }}"
                                    class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-trash me-1"></i> Corbeille
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                                    data-bs-target="#filterModal">
                                    <i class="bi bi-funnel-fill me-1"></i> Filtres
                                </button>
                                <a href="{{ route('reclamations.create') }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-plus-lg me-1"></i> Nouvelle Réclamation
                                </a>
                            </div>

                            <!-- Modal de filtres -->
                            <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title" id="filterModalLabel"><i
                                                    class="bi bi-funnel-fill me-2"></i> Filtrer les réclamations</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('reclamations.index') }}" method="GET">
                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">Numéro</label>
                                                        <input type="text" name="numero"
                                                            value="{{ request('numero') }}" placeholder="Ex: REC-..."
                                                            class="form-control">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">Statut</label>
                                                        <select name="statut" class="form-select">
                                                            <option value="">Tous</option>
                                                            @foreach ($statuts as $statut)
                                                                <option value="{{ $statut }}"
                                                                    {{ request('statut') == $statut ? 'selected' : '' }}>
                                                                    {{ $statut }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">Priorité</label>
                                                        <select name="priorite_id" class="form-select">
                                                            <option value="">Toutes</option>
                                                            @foreach ($priorites as $priorite)
                                                                <option value="{{ $priorite->id }}"
                                                                    {{ request('priorite_id') == $priorite->id ? 'selected' : '' }}>
                                                                    {{ $priorite->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">Service</label>
                                                        <select name="service_id" class="form-select">
                                                            <option value="">Tous</option>
                                                            @foreach ($services as $service)
                                                                <option value="{{ $service->id }}"
                                                                    {{ request('service_id') == $service->id ? 'selected' : '' }}>
                                                                    {{ $service->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">Date début</label>
                                                        <input type="date" name="date_debut"
                                                            value="{{ request('date_debut') }}" class="form-control">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">Date fin</label>
                                                        <input type="date" name="date_fin"
                                                            value="{{ request('date_fin') }}" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <a href="{{ route('reclamations.index') }}"
                                                    class="btn btn-secondary">Effacer</a>
                                                <button type="button" class="btn btn-outline-dark"
                                                    data-bs-dismiss="modal">Fermer</button>
                                                <button type="submit" class="btn btn-primary">Rechercher</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tableau -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Numéro
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Catégorie
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Priorité
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Service
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Échéance
                                        SLA
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($reclamations as $reclamation)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $reclamation->numero }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            @if ($reclamation->client)
                                                {{ $reclamation->client->nom }} {{ $reclamation->client->prenoms }}
                                            @else
                                                <span class="text-red-500 italic">Client supprimé</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $reclamation->categorie->name }}
                                        </td>

                                        <!-- Priorité -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if ($reclamation->priorite)
                                                <span
                                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    {{ $reclamation->priorite->name }}
                                                </span>
                                            @else
                                                <span class="text-gray-400 italic">Non définie</span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $reclamation->statut }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $reclamation->service->name }}
                                        </td>

                                        <!-- Colonne Échéance SLA -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            @if ($reclamation->date_limite)
                                                @php
                                                    $limite = \Carbon\Carbon::parse($reclamation->date_limite);
                                                    $now = now();
                                                    $diff = $now->diffInSeconds($limite, false);
                                                @endphp
                                                @if (in_array($reclamation->statut, ['Résolue', 'Clôturée']))
                                                    <span class="badge rounded-pill bg-success fs-24 px-3 py-2">
                                                        <i class="bi bi-check-circle-fill me-1"></i> Terminé
                                                    </span>
                                                @elseif($diff < 0)
                                                    @php $joursRetard = abs(intval($diff / 86400)); @endphp
                                                    <span class="badge bg-danger fs-24 px-3 py-2">
                                                        <i class="bi bi-exclamation-triangle-fill me-1"></i> En retard
                                                        ({{ $joursRetard }}j)
                                                    </span>
                                                @elseif($diff < 86400)
                                                    @php $heuresRestantes = intval($diff / 3600); @endphp
                                                    <span class="badge bg-warning text-dark fs-24 px-3 py-2">
                                                        <i class="bi bi-clock-history me-1"></i> Urgent
                                                        ({{ $heuresRestantes }}h)
                                                    </span>
                                                @else
                                                    @php $joursRestants = intval($diff / 86400); @endphp
                                                    <span class="badge bg-secondary text-white fs-24 px-3 py-2">
                                                        <i class="bi bi-clock-fill me-1"></i>
                                                        {{ $limite->format('d/m/Y') }} ({{ $joursRestants }}j)
                                                    </span>
                                                @endif
                                            @else
                                                <span class="badge bg-secondary fs-24 px-3 py-2">Non défini</span>
                                            @endif
                                        </td>

                                        <!-- Actions -->
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('reclamations.show', $reclamation) }}"
                                                class="btn btn-sm btn-outline-secondary me-2"> <i
                                                    class="bi bi-eye-fill"></i> Voir</a>
                                            <a href="{{ route('reclamations.edit', $reclamation) }}"
                                                class="btn btn-sm btn-outline-secondary me-2"> <i
                                                    class="bi bi-pen-fill"></i> Modifier</a>
                                            <form action="{{ route('reclamations.destroy', $reclamation) }}"
                                                method="POST" class="inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    data-reclamation="{{ $reclamation->numero }}">
                                                    <i class="bi bi-trash3-fill"></i>
                                                    Supprimer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                            Aucune réclamation trouvée.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $reclamations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const reclamationNum = this.querySelector('button').dataset.reclamation;

                Swal.fire({
                    title: 'Confirmer la suppression',
                    text: `Voulez-vous vraiment mettre en corbeille la réclamation ${reclamationNum} ?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#002D62',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Oui, supprimer',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });
    </script>

</x-app-layout>
