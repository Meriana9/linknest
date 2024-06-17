<!-- resources/views/contacts/import.blade.php -->

@extends('templates.index')

@section('title', 'Import Contacts')

@section('content')
    <div class="container mx-auto">
        <h2 class="text-2xl font-bold mb-4">Importer des Contacts</h2>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contacts.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="file" class="block mb-1 text-white">Fichier Excel</label>
                <input type="file" name="file" id="file" class="w-full border rounded px-3 py-2 text-gray-700">
                @error('file')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-between">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-lg">Importer</button>
                <button type="button" onclick="resetFileInput()" class="bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg">Supprimer le fichier</button>
            </div>
        </form>
    </div>

    <script>
        function resetFileInput() {
            document.getElementById('file').value = '';
        }
    </script>
@endsection
