@extends('templates.index')

@section('title', 'Dashboard')

@section('content')

    <div class="container mx-auto flex flex-col min-h-screen ">
        @auth
            <div class="w-full sm:w-3/4 lg:w-1/2 pt-10">
                @php
                    $contacts = Auth::user()->contacts()->orderBy('created_at', 'DESC')->limit(3)->get();
                @endphp

                @include('contacts._derniers', ['contacts' => $contacts])
            </div>
        @else
            <div class="flex items-center justify-center min-h-screen ">
                <div
                    class="w-full sm:w-3/4 lg:w-1/2 bg-gray-900 bg-opacity-90 p-8 rounded-lg shadow-2xl text-center bg-gradient-to-r from-gray-500 via-blue-900 to-blue-300">
                    <h2 class="text-4xl font-extrabold mb-6 text-white">Bienvenue sur LinkNest !</h2>
                    <p class="text-xl font-semibold text-gray-300 mb-6">Gérez vos contacts en toute simplicité. Organisez-les par
                        catégories, suivez vos interactions et profitez de fonctionnalités avancées.</p>
                    <div class="flex justify-center space-x-4">
                        <a href="{{ route('register') }}"
                            class="text-gray-800 bg-blue-300 hover:bg-blue-700 hover:text-white rounded-full px-4 py-4 text-lg transition-colors duration-300 inline-block">Rejoignez-nous
                            maintenant</a>
                        <a href="{{ route('login') }}"
                            class="text-white bg-gray-800 hover:bg-gray-400 rounded-full px-8 py-4 text-lg transition-colors duration-300 inline-block">Connectez-vous</a>
                    </div>
                </div>
            </div>

        @endauth
    </div>
@stop
