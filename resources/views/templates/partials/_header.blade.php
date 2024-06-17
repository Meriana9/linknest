<header class="bg-gradient-to-r from-gray-800 via-blue-200 to-blue-900 shadow-xl relative top-8" x-data="{ open: false, userMenuOpen: false }">
    <nav class="container mx-auto px-2 mb-12 flex justify-between items-center">
        <div class="flex items-center">
            <a href="{{ route('pages.home') }}">
                <img src="{{ asset('images/logoemovebg.png') }}" alt="LinkNest Logo" class="h-32 absolute"
                    style="top: -36px" />
            </a>
            <a href="{{ route('pages.home') }}" class="text-white font-bold text-xl hidden">LinkNest</a>
        </div>

        <div class="hidden md:flex items-center space-x-4 pr-4 ">
            @if (Auth::check())
                <!-- Formulaire de recherche -->
                <form action="{{ route('contacts.search') }}" method="GET" class="relative pr-4">
                    <input type="text" name="search" placeholder="Chercher un contact..."
                        class="bg-gray-800 text-white pl-4 pr-10 py-2 rounded-full focus:outline-none"
                        value="{{ $query ?? '' }}">
                    <button type="submit" class="absolute right-0 top-0 mt-2 mr-2">
                        <i class="fa fa-search text-gray-400 pr-6"></i>
                    </button>
                </form>


                <div class="relative" x-data="{ userMenuOpen: false }">
                    <button @click="userMenuOpen = !userMenuOpen" class="text-white flex items-center">
                        <img src="{{ asset('images/user.webp') }}" alt="{{ Auth::user()->name }}" class="w-16" />
                    </button>

                    <div x-show="userMenuOpen" @click.away="userMenuOpen = false"
                        class="absolute right-0 mt-2 w-48 bg-gray-100 rounded-md shadow-lg pb-1 z-50">
                        <div class="text-gray-200 px-4 py-2 bg-gray-700 text-center">
                            Hello, {{ Auth::user()->name }}
                        </div>
                        <a href="{{ route('profile.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Mon Profil</a>
                        <a href="{{ route('contacts.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Mes Contacts</a>
                        <a href="{{ route('favorites.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Favoris</a>
                        <a href="{{ route('contacts.create') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Ajouter un Contact</a>
                        <a href="{{ route('categories.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Gérer les Catégories</a>

                        <a href="{{ route('contacts.import') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Importer des contacts</a>
                        <a href="{{ route('contacts.export') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Exporter mes contacts</a>
                        <a href="{{ route('calender.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Calendrier</a>
                        <a href="{{ route('dashboard.statistics') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Statistiques</a>
                        <a href="{{ route('analytics.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Analytique des Contacts</a>
                        <a href="{{ route('files.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Gestion des Fichiers</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Se
                                Déconnecter</button>
                        </form>
                    </div>
                </div>
            @else
                <a class="text-gray-300 font-semibold px-3 py-2 hover:text-gray-900" href="{{ route('register') }}">Se
                    connecter</a>
            @endif
        </div>

        <button @click="open = !open" class="text-white md:hidden">
            <i class="fa fa-bars"></i>
        </button>
    </nav>

    <!-- Menu pour mobile -->
    <div x-show="open" class="md:hidden p-8">
        <a class="block bg-gray-900 text-white px-4 py-2 hover:bg-gray-700"
            href="{{ route('contacts.index') }}">Contacts</a>
        <a class="block bg-gray-900 text-white px-4 py-2 hover:bg-gray-700" href="{{ route('profile.index') }}">Mon
            Profil</a>
        <a class="block bg-gray-900 text-white px-4 py-2 hover:bg-gray-700" href="{{ route('contacts.index') }}">Mes
            Contacts</a>
        <a class="block bg-gray-900 text-white px-4 py-2 hover:bg-gray-700"
            href="{{ route('favorites.index') }}">Favoris</a>
        <a class="block bg-gray-900 text-white px-4 py-2 hover:bg-gray-700"
            href="{{ route('contacts.create') }}">Ajouter un Contact</a>
        <a class="block bg-gray-900 text-white px-4 py-2 hover:bg-gray-700"
            href="{{ route('categories.index') }}">Gérer les Catégories</a>
        <a class="block bg-gray-900 text-white px-4 py-2 hover:bg-gray-700"
            href="{{ route('contacts.import') }}">Importer des contacts</a>
        <a class="block bg-gray-900 text-white px-4 py-2 hover:bg-gray-700"
            href="{{ route('contacts.export') }}">Exporter des contacts</a>
        <a class="block bg-gray-900 text-white px-4 py-2 hover:bg-gray-700"
            href="{{ route('calender.index') }}">Calendrier</a>
        <a class="block bg-gray-900 text-white px-4 py-2 hover:bg-gray-700"
            href="{{ route('dashboard.statistics') }}">Statistiques</a>
        <a href="{{ route('analytics.index') }}"
            class="block bg-gray-900 text-white px-4 py-2 hover:bg-gray-700">Analytique des Contacts</a>
        <a class="block bg-gray-900 text-white px-4 py-2 hover:bg-gray-700" href="{{ route('files.index') }}">Gestion
            des Fichiers</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="block bg-gray-900 text-white px-4 py-2 hover:bg-gray-700">Se
                Déconnecter</button>
        </form>
    </div>
</header>
