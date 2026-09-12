<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Corbeille - Priorités supprimées') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- Navigation -->
                <div class="mb-6 flex justify-between items-center">
                    <a href="{{ route('priorites.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Retour à la liste des priorités
                    </a>
                    <h3 class="text-lg font-medium text-gray-900">
                        Priorités en corbeille ({{ $priorites->count() }})
                    </h3>
                </div>

                @if ($priorites->count() > 0)
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Délai SLA
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Réclamations
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Supprimé le
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($priorites as $priorite)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $priorite->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $priorite->delay }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $priorite->reclamations()->count() }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $priorite->deleted_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <!-- Bouton Restaurer -->
                                        <form action="{{ route('priorites.restore', $priorite) }}" method="POST"
                                            class="inline restore-form">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success mr-3"
                                                data-priorite="{{ $priorite->name }}">
                                                <i class="bi bi-arrow-counterclockwise"></i> Restaurer
                                            </button>
                                        </form>

                                        {{-- Bouton Supprimer définitivement --}}
                                        {{--
                                        <form action="{{ route('priorites.forceDelete', $priorite) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 mr-3"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer DÉFINITIVEMENT cette priorité ? Cette action est irréversible.')">
                                                <i class="bi bi-trash3-fill"></i> Supprimer définitivement
                                            </button>
                                        </form>
                                        --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-500 text-center py-8">Aucune priorité en corbeille.</p>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.restore-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const prioriteName = this.querySelector('button').dataset.priorite;

                Swal.fire({
                    title: 'Confirmer la restauration',
                    text: `Voulez-vous vraiment restaurer la priorité ${prioriteName} ?`,
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
