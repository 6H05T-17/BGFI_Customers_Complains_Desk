<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Corbeille des Réclamations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="mb-6 flex justify-between items-center">
                    <a href="{{ route('reclamations.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Retour à la liste des réclamations
                    </a>
                    <h3 class="text-lg font-medium text-gray-900">
                        Réclamations en corbeille ({{ $reclamations->count() }})
                    </h3>
                </div>

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Numéro</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Service</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Supprimé le</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($reclamations as $reclamation)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $reclamation->numero }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $reclamation->client->nom ?? 'Client supprimé' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $reclamation->service->name ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $reclamation->deleted_at->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <form action="{{ route('reclamations.restore', $reclamation->id) }}" method="POST"
                                        class="inline restore-form">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-success mr-3"
                                            data-reclamation="{{ $reclamation->numero }}">
                                            <i class="bi bi-arrow-counterclockwise"></i> Restaurer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">La corbeille est vide.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $reclamations->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.restore-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const reclamationNum = this.querySelector('button').dataset.reclamation;

                Swal.fire({
                    title: 'Confirmer la restauration',
                    text: `Voulez-vous vraiment restaurer la réclamation ${reclamationNum} ?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#002D62',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Oui, restaurer',
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
