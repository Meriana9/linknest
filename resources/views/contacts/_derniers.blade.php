@extends('templates.index')

@section('title', 'Mes Contacts')

@section('content')
<!-- resources/views/contacts/_derniers_contacts.blade.php -->
<h2 class="text-3xl font-bold mb-4 text-blue-700">Derniers contacts ajoutés</h2>

@if ($contacts->isEmpty())
    <p class="text-gray-600 text-xl">Aucun contact récent ajouté.</p>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($contacts as $contact)
            <div class="bg-gradient-to-bl from-gray-700 via-blue-300 to-slate-500 rounded-lg shadow-lg p-4 hover:shadow-xl flex flex-col justify-between h-full min-h-[350px] relative transform transition duration-500 hover:scale-105">
                <div class="">
                    <h3 class="text-2xl font-bold text-blue-700 mb-4">{{ $contact->first_name }} {{ $contact->last_name }}</h3>
                    <p class="text-gray-100 font-semibold mb-2">Email: {{ $contact->email }}</p>
                    <p class="text-gray-100 font-semibold mb-2">Téléphone: {{ $contact->phone }}</p>
                    <p class="text-gray-100 font-semibold mb-2">Adresse: {{ $contact->address }}</p>
                    <p class="text-gray-100 font-semibold mb-4">Date de Naissance: {{ $contact->date_of_birth }}</p>
                </div>
                <div class="mt-auto flex justify-between items-center">
                    <div class="flex space-x-2">
                        <a href="{{ route('contacts.show', $contact->id) }}"
                           class="text-gray-900 bg-white hover:bg-gray-300 rounded-full px-4 py-2 transition-colors duration-300">Voir</a>
                        <a href="{{ route('contacts.edit', $contact->id) }}"
                           class="text-gray-900 bg-white hover:bg-gray-300 rounded-full px-4 py-2 transition-colors duration-300">Modifier</a>
                        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-gray-900 bg-white hover:bg-gray-300 rounded-full px-4 py-2 transition-colors duration-300">Supprimer</button>
                        </form>
                    </div>
                </div>
                <form action="{{ route('favorites.add', $contact->id) }}" method="POST" class="inline-block absolute top-4 right-4">
                    @csrf
                    <button class="favorite-btn" data-id="{{ $contact->id }}">
                        <i class="{{ Auth::user()->favorites->contains($contact->id) ? 'fas fa-star text-yellow-500' : 'far fa-star text-gray-300' }}"></i>
                    </button>
                </form>
            </div>
        @endforeach
    </div>
@endif
@endsection
