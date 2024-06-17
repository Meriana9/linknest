@auth
    <!-- Aside -->
    <aside class="w-full md:w-1/4 pt-28">

        <!-- Catégories -->
        <div class="bg-gray-800 rounded-xl shadow-xl p-4 mb-4">
            <h2 class="font-bold text-lg mb-4 text-white">Catégories</h2>
            <div class="rounded-lg shadow-inner p-4">
                @include('categories.index', [
                    'categories' => \App\Models\Category::whereHas('contacts', function ($query) {
                        $query->where('user_id', Auth::id());
                    })->withCount(['contacts' => function ($query) {
                        $query->where('user_id', Auth::id());
                    }])->orderBy('name', 'ASC')->get(),
                ])
            </div>
        </div>

        <!-- Filtres Avancés -->
        <div class="bg-gray-800 rounded-xl shadow-xl p-4 mb-4">
            <h2 class="font-bold text-lg mb-4 text-white">Filtres Avancés</h2>
            <form method="GET" action="{{ route('contacts.index') }}">
                <div class="mb-2">
                    <label for="company" class="block text-white">Entreprise</label>
                    <input type="text" name="company" id="company" class="w-full p-2 rounded text-gray-700">
                </div>
                <div class="mb-2">
                    <label for="city" class="block text-white">Ville</label>
                    <input type="text" name="city" id="city" class="w-full p-2 rounded text-gray-700">
                </div>
                <div class="mb-2">
                    <label for="date_of_birth" class="block text-white">Date de Naissance</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="w-full p-2 rounded text-gray-700">
                </div>
                <button type="submit" class="mt-2 bg-blue-500 text-white p-2 rounded-lg w-full">Filtrer</button>
            </form>
        </div>

        <!-- Favoris -->
        <div class="bg-gray-800 rounded-xl shadow-xl p-4 mb-4">
            <h2 class="font-bold text-lg mb-4 text-white">Favoris</h2>
            <a href="{{ route('favorites.index') }}"
                class="text-blue-500 hover:underline">Voir mes favoris</a>
        </div>

    </aside>
@endauth
