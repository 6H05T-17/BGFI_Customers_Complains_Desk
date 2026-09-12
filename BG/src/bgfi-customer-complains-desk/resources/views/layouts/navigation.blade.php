<nav x-data="{ open: false }" class="bg-bgfi-blue border-b-2 border-gray-200 text-transform: uppercase no-underline">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <!-- Primary Navigation Menu -->
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                    <h6 class="ml-2 text-bgfi-bronze font-bold">BGFI Customers Complains Desk</h6>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('clients.index')" :active="request()->routeIs('clients.*')">
                        {{ __('Clients') }}
                    </x-nav-link>
                    <x-nav-link :href="route('reclamations.index')" :active="request()->routeIs('reclamations.*')">
                        {{ __('Réclamations') }}
                    </x-nav-link>
                    @if(Auth::user()->role === 'admin')
                        <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                            {{ __('Catégories') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Notifications & Profile -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">

                <!-- Notifications Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-link text-gray-500 p-0 position-relative border-0" type="button" id="dropdownNotif" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-bell-fill fs-5"></i>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownNotif" style="width: 480px; max-height: 1200px; overflow-y: auto;">
                        <li><h6 class="dropdown-header bg-light">Notifications</h6></li>
                        @forelse(auth()->user()->notifications()->take(5)->get() as $notification)
                            <li>
                                <a class="dropdown-item py-2 {{ $notification->read_at ? '' : 'bg-blue-50 border-start border-3 border-primary' }}" 
                                   href="{{ route('reclamations.show', $notification->data['reclamation_id'] ?? '#') }}"
                                   onclick="markNotificationAsRead(event, '{{ $notification->id }}', '{{ route('reclamations.show', $notification->data['reclamation_id'] ?? '#') }}')">
                                    <div class="fw-bold small text-dark">{{ $notification->data['action'] ?? 'Notification' }}</div>
                                    <div class="text-muted" style="font-size: 0.75rem;">{{ $notification->data['message'] ?? '' }}</div>
                                    <div class="text-muted mt-1" style="font-size: 0.7rem;">
                                        <i class="bi bi-clock"></i> {{ $notification->created_at->diffForHumans() }}
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li><span class="dropdown-item-text text-muted text-center py-3">Aucune notification pour le moment.</span></li>
                        @endforelse
                    </ul>
                </div>
            
                <!-- Settings Dropdown (Profil) -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div class="flex items-center">
                                @if(Auth::user()->role === 'admin')
                                    <i class="bi bi-person-fill-lock text-gray-500 me-2 fs-5" title="Administrateur"></i>
                                @elseif(Auth::user()->role === 'responsable')
                                    <i class="bi bi-person-fill-add text-gray-500 me-2 fs-5" title="Responsable"></i>
                                @else
                                    <i class="bi bi-person-fill text-gray-500 me-2 fs-5" title="Agent"></i>
                                @endif
                                <div>{{ Auth::user()->name }}</div>
                            </div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Administration') }}
                        </div>
                        @if(Auth::user()->role === 'admin')
                            <x-dropdown-link :href="route('priorites.index')">
                                {{ __('Gestion des SLA') }}
                            </x-dropdown-link>
                            <div class="border-t border-gray-200"></div>
                        @endif
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Déconnexion') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>


            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1 text-white">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('clients.index')" :active="request()->routeIs('clients.*')">
                {{ __('Clients') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('reclamations.index')" :active="request()->routeIs('reclamations.*')">
                {{ __('Réclamations') }}
            </x-responsive-nav-link>
        </div>
        
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 no-underline">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            
            <div class="mt-3 space-y-1">
                @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('priorites.index')">
                    {{ __('Gestion des SLA') }}
                </x-responsive-nav-link>
                @endif
                @if(Auth::user()->role === 'admin')
                    <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                        {{ __('Catégories') }}
                    </x-responsive-nav-link>
                @endif
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>

    <script>
    function markNotificationAsRead(event, id, url) {
        event.preventDefault(); // Empêche le lien de naviguer immédiatement

        fetch(`/notifications/${id}/read`, {
            method: 'GET',
            headers: { 'Accept': 'application/json' }
        }).finally(() => {
            // Une fois la requête envoyée (succès ou échec), on navigue vers la page
            window.location.href = url;
        });
    }
    </script>
</nav>
