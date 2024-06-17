@extends('templates.index')

@section('title', 'Recherche de Contacts')

@section('content')
    <div class="container">
        <h1 class="text-3xl font-extrabold text-blue-500 mt-14">Résultats de la recherche</h1>
        <div class="row mt-4">
            @if ($contacts->isEmpty())
                <p class="text-gray-400 font-bold">Aucun résultat trouvé pour la recherche "{{ $query }}"</p>
            @else
                <p class="text-gray-400 mb-12 mt-3 font-bold">Vous avez trouvé ({{ $contactsCount }}) contacts pour la
                    recherche "{{ $query }}"</p>
                <div class="grid grid-row-1 md:grid-row-2 lg:grid-row-3 gap-6">
                    @foreach ($contacts as $contact)
                        <div>
                            <a href="{{ route('contacts.show', $contact->id) }}">
                                <h6 class="text-blue-300 font-bold">{{ $contact->first_name }} {{ $contact->last_name }}</h6>
                            </a>
                            <p class="">Email: {{ $contact->email }}</p>
                            <p class="">Téléphone: {{ $contact->phone }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
