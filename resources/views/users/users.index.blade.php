@extends('templates.index')

@section('title')
    Users
@stop

@section('content')
    <h2 class="text-2xl font-bold mb-4">Users</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($users as $user)
            <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg relative">
                <div class="p-4">
                    <h3 class="text-xl font-bold">{{ $user->name }}</h3>
                    <p class="text mb-2 text-gray-400">{{ $user->email }}</p>
                    <!-- Ajoutez d'autres informations sur l'utilisateur ici -->
                </div>
            </div>
        @endforeach
    </div>
@stop
