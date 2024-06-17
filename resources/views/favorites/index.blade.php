@extends('templates.index')

@section('title', 'Mes Favoris')

@section('content')
<div class="container mx-auto pb-12">
    <h2 class="text-3xl font-bold mb-6 text-blue-500">Mes Favoris</h2>

    @if ($favorites->isEmpty())
        <p class="text-gray-700">Vous n'avez pas encore de favoris.</p>
    @else
        <div class="space-y-6">
            @foreach ($favorites as $favorite)
                <div class="bg-gradient-to-br from-gray-800 to-blue-300 rounded-lg shadow-lg p-6 flex items-center justify-between relative">
                    <div class="flex items-center">
                        <div class="w-24 h-24 rounded-full overflow-hidden mr-6">
                            <img class="w-full h-full object-cover"
                                src="{{ $favorite->profile_image ? asset('images/' . $favorite->profile_image) : asset('images/profile-default.png') }}"
                                alt="{{ $favorite->first_name }} {{ $favorite->last_name }}" />
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">{{ $favorite->first_name }} {{ $favorite->last_name }}</h3>
                            <p class="text-gray-300">Email: {{ $favorite->email }}</p>
                            <p class="text-gray-300">Téléphone: {{ $favorite->phone }}</p>
                            <p class="text-gray-300">Adresse: {{ $favorite->address }}</p>
                            <p class="text-gray-300">Date de Naissance: {{ $favorite->date_of_birth }}</p>
                            <div class="flex flex-wrap mt-2">
                                @foreach($favorite->categories as $category)
                                <span class="bg-blue-500 text-white text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ $category->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="flex space-x-2 absolute bottom-6 right-6">
                        <a href="{{ route('contacts.show', $favorite->id) }}"
                            class="text-gray-900 bg-white hover:bg-gray-300 rounded-full px-4 py-2 transition-colors duration-300">Voir</a>
                        <form action="{{ route('favorites.remove', $favorite->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-gray-900 bg-white hover:bg-gray-300 rounded-full px-4 py-2 transition-colors duration-300">Retirer des favoris</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="mt-6">
        {{ $favorites->links() }}
    </div>
</div>
@endsection
