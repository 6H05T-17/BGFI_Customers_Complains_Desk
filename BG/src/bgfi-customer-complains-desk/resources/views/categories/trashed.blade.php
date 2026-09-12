<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Corbeille - Catégories supprimées') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-6 flex justify-between items-center">
                    <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Retour à la liste des catégories
                    </a>
                    <h3 class="text-lg font-medium text-gray-900">
                        Catégories en corbeille ({{ $categories->count() }})
                    </h3>
                </div>

                @if ($categories->count() > 0)
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Supprimé le
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($categories as $categorie)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $categorie->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $categorie->deleted_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <form action="{{ route('categories.restore', $categorie) }}" method="POST"
                                            class="inline restore-form">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success mr-3"
                                                data-category="{{ $categorie->name }}">
                                                <i class="bi bi-arrow-counterclockwise"></i> Restaurer
                                            </button>
                                        </form>

                                        <form action="{{ route('categories.forceDelete', $categorie) }}" method="POST"
                                            class="inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                data-category="{{ $categorie->name }}">
                                                <i class="bi bi-trash3-fill"></i> Supprimer définitivement
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-500 text-center py-8">Aucune catégorie en corbeille.</p>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.restore-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const categoryName = this.querySelector('button').dataset.category;

                Swal.fire({
                    title: 'Confirmer la restauration',
                    text: `Voulez-vous vraiment restaurer la catégorie ${categoryName} ?`,
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

        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const categoryName = this.querySelector('button').dataset.category;

                Swal.fire({
                    title: 'Suppression définitive',
                    text: `Voulez-vous vraiment supprimer définitivement la catégorie ${categoryName} ?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#002D62',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Oui, supprimer définitivement',
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
