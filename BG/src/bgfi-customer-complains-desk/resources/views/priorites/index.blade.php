<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des SLA (Priorités)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- En-tête avec boutons -->
                <div class="mb-6 pb-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Liste des priorités
                        </h3>
                        <div class="space-x-2">
                            <a href="{{ route('priorites.trashed') }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-trash me-1"></i> Corbeille
                            </a>
                            <a href="{{ route('priorites.create') }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-plus-lg me-1"></i> Nouvelle Priorité
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tableau -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Délai SLA
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Réclamations
                                    associées</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($priorites as $priorite)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $priorite->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $priorite->delay }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $priorite->reclamations()->count() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('priorites.show', $priorite) }}"
                                            class="btn btn-sm btn-outline-secondary me-2"> <i
                                                class="bi bi-eye-fill"></i> Voir</a>
                                        <a href="{{ route('priorites.edit', $priorite) }}"
                                            class="btn btn-sm btn-outline-secondary me-2"> <i
                                                class="bi bi-pen-fill"></i> Modifier</a>
                                        <form action="{{ route('priorites.destroy', $priorite) }}" method="POST"
                                            class="inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                data-priorite="{{ $priorite->name }}">
                                                <i class="bi bi-trash3-fill"></i>
                                                Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                        Aucune priorité définie.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const prioriteName = this.querySelector('button').dataset.priorite;

                Swal.fire({
                    title: 'Confirmer la suppression',
                    text: `Voulez-vous vraiment mettre en corbeille la priorité ${prioriteName} ?`,
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
