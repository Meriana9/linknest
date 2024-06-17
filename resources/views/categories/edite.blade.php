{{-- @extends('templates.index')

@section('title', 'Modifier la Catégorie')

@section('content')
<h2 class="text-3xl font-bold mb-6">Modifier la Catégorie</h2>

<form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label for="name" class="block text-gray-700">Nom de la Catégorie</label>
        <input type="text" id="name" name="name" class="w-full p-2 rounded text-gray-700" value="{{ $category->name }}">
    </div>
    <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg">Enregistrer</button>
</form>
@endsection
 --}}
