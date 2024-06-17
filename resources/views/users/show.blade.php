@extends('templates.index')

@section('title')
    {{ $user->name }}
@stop

@section('content')
    <div class="bg-gray-700 rounded-lg shadow-lg p-4">
        <h2 class="font-bold text-2xl mb-2">{{ $user->name }}</h2>
        <p class="text-gray-300 mb-4">Email: {{ $user->email }}</p>
        <!-- Ajoutez d'autres informations sur l'utilisateur ici -->
    </div>
@stop
