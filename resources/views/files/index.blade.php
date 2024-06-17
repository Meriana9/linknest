@extends('templates.index')

@section('title', 'Gestion des Fichiers')

@section('content')
    <div class="container mx-auto">
        <h2 class="text-2xl font-bold mb-4">Gestion des Fichiers</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-gray-700 p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-bold mb-4 text-center">Importer des Contacts</h3>
                <a href="{{ route('contacts.import') }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-lg block text-center">
                    Importer vos contacts Excel
                </a>
            </div>
            <div class="bg-gray-700 p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-bold mb-4 text-center">Exporter des Contacts</h3>
                <a href="{{ route('contacts.export') }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-lg block text-center">
                    Exporter vos contacts
                </a>
            </div>
            <div class="bg-gray-700 p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-bold mb-4 text-center">Télécharger le Rapport PDF</h3>
                <a href="{{ route('reports.downloadPdf') }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-lg block text-center">
                    Télécharger vos contacts PDF
                </a>
            </div>
        </div>
    </div>
@endsection
@section('hideAside', true)
