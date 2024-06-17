@extends('templates.index')

@section('title', 'Mes Contacts')

@section('content')
    <h2 class="text-3xl font-extrabold text-blue-700 mb-6">Mes Contacts</h2>

    @if ($contacts->isEmpty())
        <p class="text-gray-700">Vous n'avez pas encore de contacts.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($contacts as $contact)
                <div
                    class="bg-gradient-to-tl from-gray-900 to-blue-400 bg-opacity-90 rounded-lg shadow-lg p-4 hover:shadow-xl transition-shadow duration-300 flex flex-col justify-between h-full min-h-[350px] relative transform transition duration-500 hover:scale-105">
                    <div>
                        <h3 class="text-2xl font-bold text-blue-700 mb-4">{{ $contact->first_name }}
                            {{ $contact->last_name }}</h3>
                        <p class="text-white font-semibold mb-2">Email: {{ $contact->email }}</p>
                        <p class="text-blue-50 font-semibold mb-2">Téléphone: {{ $contact->phone }}</p>
                        <p class="text-blue-50 font-semibold mb-2">Adresse: {{ $contact->address }}</p>
                        <p class="text-blue-50 font-semibold mb-2">Date de Naissance: {{ $contact->date_of_birth }}</p>
                        <p class="text-blue-50 font-semibold mb-2">Catégories:</p>
                        <ul class="list-disc list-inside text-gray-300 mb-4">
                            @foreach ($contact->categories as $category)
                                <li>{{ $category->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mt-auto flex justify-between items-center">
                        <div class="flex space-x-2">
                            <a href="{{ route('contacts.show', $contact->id) }}"
                                class="text-white bg-blue-500 hover:bg-blue-700 rounded-full px-4 py-2 transition-colors duration-300">Voir</a>
                            <a href="{{ route('contacts.edit', $contact->id) }}"
                                class="text-white bg-blue-500 hover:bg-blue-700 rounded-full px-4 py-2 transition-colors duration-300">Modifier</a>
                            <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST"
                                class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-white bg-blue-500 hover:bg-blue-700 rounded-full px-4 py-2 transition-colors duration-300">Supprimer</button>
                            </form>
                        </div>
                    </div>
                    <form action="{{ route('favorites.add', $contact->id) }}" method="POST"
                        class="inline-block absolute top-4 right-4">
                        @csrf
                        <button class="favorite-btn" data-id="{{ $contact->id }}">
                            <i
                                class="{{ Auth::user()->favorites->contains($contact->id) ? 'fas fa-star text-yellow-500' : 'far fa-star text-gray-400' }}"></i>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif

    <div class="mt-6">
        {{ $contacts->links() }}
    </div>
@endsection
