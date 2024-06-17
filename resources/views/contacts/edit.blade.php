@extends('templates.index')

@section('content')
    <div class="container mx-auto flex flex-wrap pb-12">
        <main class="w-full md:w-3/4 p-4">
            <div class="container mx-auto pb-12">
                <div class="flex flex-wrap justify-center">
                    <div class="w-full">
                        <div class="bg-gradient-to-tr from-gray-700 via-blue-300 to-blue-800 p-6 rounded-lg shadow-lg">
                            <h2 class="text-2xl font-bold mb-4 text-center text-white">
                                Modifier le contact "{{ $contact->first_name }} {{ $contact->last_name }}"
                            </h2>
                            <form method="POST" action="{{ route('contacts.update', ['contact' => $contact->id]) }}">
                                @csrf
                                @method('PUT')

                                <!-- Catégories -->
                                <div class="mb-4">
                                    <label for="categories" class="block mb-1 text-white">Catégories</label>
                                    <select id="categories" name="categories[]" multiple
                                        class="w-full border rounded px-3 py-2 text-gray-700">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ in_array($category->id, old('categories', $contact->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Prénom -->
                                <div class="mb-4">
                                    <label for="first_name" class="block mb-1 text-white">Prénom</label>
                                    <input type="text" id="first_name" name="first_name"
                                        value="{{ old('first_name', $contact->first_name) }}"
                                        class="w-full border rounded px-3 py-2 text-gray-700" required>
                                </div>

                                <!-- Nom de famille -->
                                <div class="mb-4">
                                    <label for="last_name" class="block mb-1 text-white">Nom de famille</label>
                                    <input type="text" id="last_name" name="last_name"
                                        value="{{ old('last_name', $contact->last_name) }}"
                                        class="w-full border rounded px-3 py-2 text-gray-700" required>
                                </div>

                                <!-- Email -->
                                <div class="mb-4">
                                    <label for="email" class="block mb-1 text-white">Email</label>
                                    <input type="email" id="email" name="email"
                                        value="{{ old('email', $contact->email) }}"
                                        class="w-full border rounded px-3 py-2 text-gray-700" required>
                                </div>

                                <!-- Téléphone -->
                                <div class="mb-4">
                                    <label for="phone" class="block mb-1 text-white">Téléphone</label>
                                    <input type="text" id="phone" name="phone"
                                        value="{{ old('phone', $contact->phone) }}"
                                        class="w-full border rounded px-3 py-2 text-gray-700">
                                </div>

                                <!-- Adresse -->
                                <div class="mb-4">
                                    <label for="address" class="block mb-1 text-white">Adresse</label>
                                    <input type="text" id="address" name="address"
                                        value="{{ old('address', $contact->address) }}"
                                        class="w-full border rounded px-3 py-2 text-gray-700">
                                </div>
                                <!-- Ville -->
                                <div class="mb-4">
                                    <label for="city" class="block mb-1 text-white">Ville</label>
                                    <input type="text" id="city" name="city"
                                        value="{{ old('city', $contact->city) }}"
                                        class="w-full border rounded px-3 py-2 text-gray-700">
                                </div>

                                <!-- Entreprise -->
                                <div class="mb-4">
                                    <label for="company" class="block mb-1 text-white">Entreprise</label>
                                    <input type="text" id="company" name="company"
                                        value="{{ old('company', $contact->company) }}"
                                        class="w-full border rounded px-3 py-2 text-gray-700">
                                </div>

                                <!-- Date de naissance -->
                                <div class="mb-4">
                                    <label for="date_of_birth" class="block mb-1 text-white">Date de naissance</label>
                                    <input type="date" id="date_of_birth" name="date_of_birth"
                                        value="{{ old('date_of_birth', $contact->date_of_birth) }}"
                                        class="w-full border rounded px-3 py-2 text-gray-700">
                                </div>

                                <!-- Notes -->
                                <div class="mb-4">
                                    <label for="notes" class="block mb-1 text-white">Notes</label>
                                    <textarea id="notes" name="notes" class="w-full border rounded px-3 py-2 text-gray-700">{{ old('notes', $contact->notes) }}</textarea>
                                </div>

                                <!-- Profile Image -->
                                <div class="mb-4">
                                    <label for="profile_image" class="block mb-1 text-white">Profile Image</label>
                                    <input type="text" id="profile_image" name="profile_image"
                                        value="{{ old('profile_image', $contact->profile_image) }}"
                                        class="w-full border rounded px-3 py-2 text-gray-700">
                                </div>

                                <!-- Last Contacted At -->
                                <div class="mb-4">
                                    <label for="last_contacted_at" class="block mb-1 text-white">Last Contacted At</label>
                                    <input type="date" id="last_contacted_at" name="last_contacted_at"
                                        value="{{ old('last_contacted_at', $contact->last_contacted_at) }}"
                                        class="w-full border rounded px-3 py-2 text-gray-700">
                                </div>

                                <div class="mt-4">
                                    <button type="submit"
                                        class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-lg">Enregistrer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
