<!-- resources/views/categories/show.blade.php -->
@extends('templates.index')

@section('title', $category->name)

@section('content')
<h1>{{ $category->name }}</h1>
@if ($contacts->isEmpty())
    <p>Aucun contact trouvé dans cette catégorie.</p>
@else
    @foreach ($contacts as $contact)
        <div class="contact">
            <h3>{{ $contact->first_name }} {{ $contact->last_name }}</h3>
            <p>{{ $contact->email }}</p>
            <p>{{ $contact->phone }}</p>
            <!-- Autres champs de contact -->
        </div>
    @endforeach
@endif

{{ $contacts->links() }}
@stop
