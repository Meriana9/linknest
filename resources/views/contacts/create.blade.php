@extends('templates.index')

@section('content')
    <div class="container mx-auto flex flex-wrap pt-4">
        <main class="w-full md:w-3/4 p-4">
            <div class="container mx-auto pb-12">
                <div class="flex flex-wrap justify-center">
                    <div class="w-full">
                        <div class="bg-gradient-to-br from-gray-800 via-blue-300 to-blue-900 p-6 rounded-lg shadow-lg">
                            <h1 class="text-2xl font-bold mb-4 text-center">Ajouter un Contact</h1>

                            @if ($errors->any())
                                <div class="bg-red-200 text-red-700 p-4 rounded mb-4">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('contacts.store') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="categories" class="block mb-1">Catégories :</label>
                                    <select name="categories[]" id="categories" multiple
                                        class="w-full border rounded px-3 py-2 text-gray-700">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="first_name" class="block mb-1">Prénom:</label>
                                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}"
                                        class="w-full border rounded px-3 py-2 text-gray-700" required>
                                </div>
                                <div class="mb-4">
                                    <label for="last_name" class="block mb-1">Nom:</label>
                                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}"
                                        class="w-full border rounded px-3 py-2 text-gray-700" required>
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="block mb-1">Email:</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                        class="w-full border rounded px-3 py-2 text-gray-700">
                                </div>
                                <div class="mb-4">
                                    <label for="phone" class="block mb-1">Téléphone:</label>
                                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                        class="w-full border rounded px-3 py-2 text-gray-700">
                                </div>
                                <div class="mb-4">
                                    <label for="address" class="block mb-1">Adresse:</label>
                                    <input type="text" id="address" name="address" value="{{ old('address') }}"
                                        class="w-full border rounded px-3 py-2 text-gray-700">
                                </div>
                                <div class="mb-4">
                                    <label for="city" class="block mb-1">ٍVille:</label>
                                    <input type="text" id="city" name="city" value="{{ old('city') }}"
                                        class="w-full border rounded px-3 py-2 text-gray-700">
                                </div>
                                <div class="mb-4">
                                    <label for="company" class="block mb-1">Société:</label>
                                    <input type="text" id="company" name="company" value="{{ old('company') }}"
                                        class="w-full border rounded px-3 py-2 text-gray-700">
                                </div>
                                <div class="mb-4">
                                    <label for="date_of_birth" class="block mb-1">Date de Naissance:</label>
                                    <input type="date" id="date_of_birth" name="date_of_birth"
                                        value="{{ old('date_of_birth') }}"
                                        class="w-full border rounded px-3 py-2 text-gray-700">
                                </div>
                                <div class="mb-4">
                                    <label for="notes" class="block mb-1">Notes:</label>
                                    <textarea id="notes" name="notes"
                                        class="w-full border rounded px-3 py-2 text-gray-700">{{ old('notes') }}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="profile_image" class="block mb-1">Image de Profil:</label>
                                    <input type="text" id="profile_image" name="profile_image"
                                        value="{{ old('profile_image') }}"
                                        class="w-full border rounded px-3 py-2 text-gray-700">
                                </div>
                                <div class="mb-4">
                                    <label for="last_contacted_at" class="block mb-1">Dernier Contact:</label>
                                    <input type="datetime-local" id="last_contacted_at" name="last_contacted_at"
                                        value="{{ old('last_contacted_at') }}"
                                        class="w-full border rounded px-3 py-2 text-gray-700">
                                </div>

                                <button type="submit"
                                    class="bg-gray-700 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded">Ajouter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@stop
